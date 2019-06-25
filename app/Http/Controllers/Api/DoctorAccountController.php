<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transformers\DoctorAccountTransformer;
use App\Repositories\AclUserRepository;
use App\Repositories\DoctorAccountRepository;

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

class DoctorAccountController extends Controller
{
    
    /**
     * @var DoctorAccountRepository
     */
    protected $doctorAccountRepository;

    /**
     * @var AclUserRepository
     */
    protected $aclUserRepository;

    /**
     * @var Application
     */
    protected $app;

    /**
     * DoctorAccountController constructor.
     * @param DoctorAccountRepository $doctorAccountRepository  
     * @param AclUserRepository $aclUserRepository   
     * @param Application $application
     */
    public function __construct(DoctorAccountRepository $doctorAccountRepository,   
                                AclUserRepository $aclUserRepository,                             
                                Application $application                               
                                )
    {
        $this->doctorAccountRepository = $doctorAccountRepository;   
        $this->aclUserRepository = $aclUserRepository;    
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
            'doctor_name' => 'required',
            'handphone' => 'required',
            'specialist_id' => 'required',
            'username' => 'required',
            'password' => 'required'                        
        ]);

        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->errors()->first());             
        }

        $phone = str_replace('+', '', $request->handphone);

        $user = $this->aclUserRepository->findByUsername($request->username);        

        if ($user) {  
            return response()->json(['error' => 'IDI Number is already taken'], 401);
        }

        $credentials = [
            'username'    => $request->username,
            'password'      => bcrypt($request->password),
        ];
       
        $doctorInput = [
            'doctor_name'       => $request->doctor_name,
            'specialist_id'     => $request->specialist_id,
            'idi_number'        => $request->username, 
            'handphone'         => $phone,                    
        ];

        try 
        {
            $doctor = DB::transaction(function() use($doctorInput, $credentials, $request) {
                $user = $this->aclUserRepository->create($credentials);

                $doctorInput = array_merge($doctorInput, ['user_id' => $user->id]);

                $doctorAccount = $this->doctorAccountRepository->create($doctorInput);
                
                return $doctorAccount;
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
                return response()->json(['error' => 'IDI number not found'], 401);               
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

            $doctor = $this->doctorAccountRepository->findByIdiNumber($identity);  
            
            return response()->json([
                'data' => [
                    'message' => 'login berhasil',
                    'doctor_name' => $doctor->doctor_name,
                    'idi_number' => $doctor->idi_number
                    
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
            $user = $this->doctorAccountRepository->findByDoctorId($Id);

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
        $doctor_id      = $request->input('doctor_id', null);
        $doctor_name    = $request->input('doctor_name', null);
        $idi_number     = $request->input('idi_number', null);
        $handphone      = $request->input('handphone', null);
        $email          = $request->input('email', null);
        $specialist_id  = $request->input('specialist_id', null);
        $about          = $request->input('about', null);                

        try
        {
            $user = $this->doctorAccountRepository->findByDoctorId($doctor_id);

            $this->doctorAccountRepository->update($user, [
                'doctor_name'   => $doctor_name,
                'specialist_id' => $specialist_id,
                'email'         => $email,                
                'about'         => $about,
            ]);

            return response()->json(['data' => $user],200);           

        }catch (JWTException $exception) {
            throw new \Exception($exception->getMessage());
        }
        
    }

    public function logout(Request $request)
    {

        if ( !$this->user = JWTAuth::parseToken()->authenticate() ) {
            throw new AuthenticationException('Account not found');
        }

        $doctorAccount = $this->doctorAccountRepository->findByUserId($this->user->id);
        if (empty($doctorAccount)) {
            throw new AuthenticationException('Account not found');
        }

        auth()->logout();
        Sentinel::logout(null, true);
        return response()->json(['data' => 'done']);
    }
    


}
