<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Jobs\SendForgotPasswordEmail;
use App\Jobs\SendCustomerRegistrationConfirmationEmail;

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

use App\Transformers\DoctorAccountTransformer;
use App\Repositories\AclUserRepository;
use App\Repositories\DoctorAccountRepository;

use Image;
use Validator;
use DB;
use Sentinel;
use Activation;

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
     * CustomerAccountController constructor.
     * @param DoctorAccountRepository $doctorAccountRepository
     * @param AclUserRepository $aclUserRepository
     * @param Application $application
     */
    public function __construct(DoctorAccountRepository $doctorAccountRepository,
                                AclUserRepository $aclUserRepository,
                                Application $application                               
                                )
    {
        $this->DoctorAccountRepository = $doctorAccountRepository;
        $this->AclUserRepository = $aclUserRepository;
        $this->Application = $application;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
         try {
            $identity = trim($credentials['email']);
            $user = $this->AclUserRepository->findByEmailOrPhone($identity, $identity);

            if(!$user) {
                return response()->json(['error' => 'email or phone number not found'], 401);
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
            $doctorAccount = $this->DoctorAccountRepository->findByAttributes(['user_id' => $user->id]);
            if ( empty($doctorAccount) ) {
                $doctorAccount = $this->DoctorAccountRepository->create([
                   'user_id' => $user->id
                ]);
            }
            
            return response()->json([
                'data' => [
                    'id' => $doctorAccount->user_id,
                    'email' => $doctorAccount->email,
                    'phone' => $doctorAccount->phone,
                    'first_name' => $doctorAccount->first_name,
                    'last_name' => $doctorAccount->last_name,
                    'photo' => $doctorAccount->user->photo,
                    'invite_code' => $doctorAccount->invite_code,
                    'invitation_code' => $doctorAccount->invitation_code,
                    'invitation_uri' => $doctorAccount->invitation_uri,
                    'social_login_type' => $doctorAccount->social_login_type,
                    'social_login_id' => $doctorAccount->social_login_id,
                    'current_credits' => $doctorAccount->current_credits,
                    'newsletter_subscribed' => $doctorAccount->newsletter_subscribed,
                    'salutation' => $user->salutation
                ],
                'token' => $token
            ]);

            //return response()->json(['data' => $credentials]);

        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
    }


}
