<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Transformers\DoctorAccountTransformer;
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
     * @var Application
     */
    protected $app;

    /**
     * DoctorAccountController constructor.
     * @param DoctorAccountRepository $doctorAccountRepository     
     * @param Application $application
     */
    public function __construct(DoctorAccountRepository $doctorAccountRepository,                                
                                Application $application                               
                                )
    {
        $this->DoctorAccountRepository = $doctorAccountRepository;       
        $this->Application = $application;
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
            'specialist_id' => 'required',
            'idi_number' => 'required|unique:doctor_accounts',
            'handphone' => 'required|unique:doctor_accounts',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Data cannot be null or must be unique!'], 401);
        }

        $phone = str_replace('+', '', $request->handphone);

        $user = $this->DoctorAccountRepository->findByIdiNumber($request->idi_number);

        if ($user) {  
            return response()->json(['error' => 'IDI Number is already taken'], 401);
        }

        $credentials = [
            'idi_number'    => $request->idi_number,
            'password'      => $request->password,
        ];

        $userInput = [
            'doctor_name'       => $request->doctor_name,
            'specialist_id'     => $request->specialist_id,
            'handphone'         => $phone,
            'idi_number'        => $request->idi_number,            
            'password'          => bcrypt($request->password),
            'api_token'         => bcrypt($phone),
            'web_token'         => bcrypt($phone),
            'about'             => '',
            'account_verified'  => ''
        ];


        try {
            $doctor = $this->DoctorAccountRepository->create($userInput);          

            return response()->json([
                'data'  => [
                    'message'                  => 'registrasi berhasil'   
                ]
            ],200);



        } catch ( \Exception $e ) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('idi_number', 'password');
         try {
            $identity = trim($credentials['idi_number']);
            $user = $this->DoctorAccountRepository->findByIdiNumber($identity);
          
            if(!$user) {
                return response()->json(['error' => 'IDI number not found'], 401);               
            }

            if(!hash::Check(trim($credentials['password']),$user->password)){
                return response()->json(['error' => 'invalid password'], 401);
            }                 
           
            return response()->json([
                'data' => [
                    'message' => 'login berhasil',
                    'doctor_name' => $user->doctor_name,
                    'idi_number' => $user->idi_number
                ]
                 
                ],200);

        } catch (JWTException $e) {
            throw new \Exception($exception->getMessage());
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
            $user = $this->DoctorAccountRepository->findById($Id);

            return response()->json(['data' => [$user]],200);

        }catch (JWTException $e) {
            throw new \Exception($exception->getMessage());
        }
        
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function Updateprofile(Request $request)
    {        
        $Id             = $request->input('id', null);
        $doctor_name    = $request->input('doctor_name', null);
        $specialist_id  = $request->input('specialist_id', null);
        $handphone      = $request->input('handphone', null);
        $idi_number     = $request->input('idi_number', null);
        $about          = $request->input('about', null);        

        try
        {
            $user = $this->DoctorAccountRepository->findById($Id);

            $this->DoctorAccountRepository->update($user, [
                'doctor_name'   => $doctor_name,
                'specialist_id' => $specialist_id,
                'handphone'     => $handphone,
                'idi_number'    => $idi_number,
                'about'         => $about,
            ]);

            return response()->json(['data' => [$user]],200);

            //return response()->json(['data' => [$Id, $doctor_name, $specialist_id, $handphone, $idi_number, $about]],200);

        }catch (JWTException $e) {
            throw new \Exception($exception->getMessage());
        }
        
    }


}
