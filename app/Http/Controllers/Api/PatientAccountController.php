<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPController;
use App\Transformers\PatientAccountTransformer;
use App\Repositories\AclUserRepository;
use App\Repositories\PatientAccountRepository;
// use App\Repositories\OTPRepository;

use Cartalyst\Sentinel\Hashing\NativeHasher;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

use Image;
use Validator;
use DB;
use Sentinel;
use Activation;
use Hash;

class PatientAccountController extends Controller
{
    
    /**
     * @var PatientAccountRepository
     */
    protected $patientAccountRepository;

    /**
     * @var AclUserRepository
     */
    protected $aclUserRepository;

    // /**
    //  * @var OTPRepository
    //  */
    // protected $OTPRepository;

    /**
     * @var Application
     */
    protected $app;

    /**
     * DoctorAccountController constructor.
     * @param PatientAccountRepository $patientAccountRepository  
     * @param AclUserRepository $aclUserRepository   
     * @param OTPRepository $otpRepository  
     * @param Application $application
     */
    public function __construct(PatientAccountRepository $patientAccountRepository,   
                                AclUserRepository $aclUserRepository,     
                                // OTPRepository $otpRepository,                             
                                Application $application                               
                                )
    {
        $this->patientAccountRepository = $patientAccountRepository;   
        $this->aclUserRepository = $aclUserRepository;  
        // $this->otpRepository = $otpRepository;    
        $this->app = $application;
    }

    /**
     * @param Request $request
     * @return \Http\Response
     * @throws \Exception
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'      => 'required',                              
            'password'      => 'required',
            'patient_name'  => 'required'                       
        ]);

        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());             
        }

        $phone = str_replace('+', '', $request->username);

        $user = $this->aclUserRepository->findByUsername($request->username);        

        if ($user) {  
            return response()->json(['error' => 'Phone Number is already taken'], 401);
        }

        $credentials = [
            'username'    => $request->username,
            'password'    => $request->password,
        ];
       
        $userInput = [
            'username'    => $request->username,
            'password'    => bcrypt($request->password),
        ];

        $patientInput = [
            'patient_name'      => $request->patient_name,           
            'handphone'         => $phone                   
        ];

        try 
        {
            $patient = DB::transaction(function() use($patientInput, $userInput, $request) {
                $user = $this->aclUserRepository->create($userInput);                              

                $patientInput = array_merge($patientInput, ['user_id' => $user->id]);

                // $result = OTPController::store($user->username);

                $patientAccount = $this->patientAccountRepository->create($patientInput);               
                
                return $patientAccount;
            });                 

            return response()->json([
                'data'  => [
                    'message'                  => 'Registrasi Berhasil'
                ],
                'token' => JWTAuth::attempt($credentials),
            ],200);

        } catch ( \Exception $exception ) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
         try {
            $identity = trim($credentials['username']);
            $user = $this->aclUserRepository->findByUsername($identity);
          
            if(!$user) {
                return response()->json(['error' => 'Username not found'], 401);               
            }
           
            if (!$this->app['sentinel.hasher']->check($credentials['password'], $user->password)) {
                return response()->json(['error' => 'invalid password'], 401);
            }        
           
            if (! $token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

            $user = JWTAuth::toUser($token);
            if ( empty($user) ) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }

            $patient = $this->patientAccountRepository->findByPhoneNumber($identity);  
            
            return response()->json([
                'data' => [
                    'message' => 'login berhasil',
                    'patient_name' => $patient->patient_name,
                    'Handphone' => $patient->Handphone
                    
                ],
                'token' => $token 
                ],200);

        } catch (JWTException $e) {
            // throw new \Exception($exception->getMessage());
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {        
        $Id = $request->only('id');
        try
        {
            $user = $this->patientAccountRepository->findByPatientId($Id);

            return response()->json(['data' => [$user]],200);

        }catch (JWTException $exception) {
            throw new \Exception($exception->getMessage());
        }
        
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function Updateprofile(Request $request)
    {        
        $patient_id           = $request->input('patient_id', null);
        $patient_name         = $request->input('patient_name', null);        
        $handphone            = $request->input('handphone', null);
        $email                = $request->input('email', null);
        $birth_place          = $request->input('birth_place', null);
        $birth_date           = $request->input('birth_date', null);
        $gender               = $request->input('gender', null);  
        $Address              = $request->input('Address', null);        

        try
        {
            $user = $this->patientAccountRepository->findByPatientId($patient_id);

            $this->patientAccountRepository->update($user, [
                'patient_name'      => $patient_name,
                'handphone'         => $handphone,
                'email'             => $email,
                'birth_place'       => $birth_place,
                'birth_date'        => $birth_date,
                'gender'            => $gender,
                'Address'           => $Address,
            ]);

            return response()->json(['data' => [$user]],200);

        }catch (JWTException $exception) {
            throw new \Exception($exception->getMessage());
        }
        
    }

    public function logout(Request $request)
    {

        if ( !$this->user = JWTAuth::parseToken()->authenticate() ) {
            throw new AuthenticationException('Account not found');
        }

        $patientAccount = $this->patientAccountRepository->findByUserId($this->user->id);
        if (empty($patientAccount)) {
            throw new AuthenticationException('Account not found');
        }

        auth()->logout();
        Sentinel::logout(null, true);
        return response()->json(['data' => 'done']);
        
    }


}
