<?php

namespace App\Http\Controllers;
use App\Repositories\OTPRepository;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Twilio\Jwt\ClientToken;
use App\Repositories\AclUserRepository;

class OTPController extends Controller
{
    /**
     * @var code
     */
    protected $code;
    
    /**
     * @var OTP
     */
    protected $OTP;

    /**
     * @var AclUserRepository
     */
    protected $aclUserRepository;

    public function __construct( OTP $OTP,
                                AclUserRepository $aclUserRepository )
    {
        $this->OTP = $OTP;
        $this->aclUserRepository = $aclUserRepository;  
    }

    public function store(Request $request)
    {
        $code = rand(1000, 9999); //generate random code
        $request['code'] = $code; //add code in $request body

        $this->OTP->store($request); //call store method of model

        return $this->sendSms($request); // send and return its response
    }

    public function sendSms($request)
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        try
        {
            $client = new Client(['auth' => [$accountSid, $authToken]]);
            $result = $client->post('https://api.twilio.com/2010-04-01/Accounts/'.$accountSid.'/Messages.json',
                ['form_params' => [
                    'Body' => 'CODE: '. $request->code, //set message body
                    'To' => $request->handphone,
                    'From' => '+18577633292' ] //we get this number from twilio                    
                ]);

                return $result;
            }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function verifyOTP(Request $request)
    {
        
        $OTP = $this->OTPRepository->findByHandphone($request->Handphone);

        if($request->code == $OTP->code)
        {
            $this->OTPRepository->update($OTP, [
                'status' => 'verified'
            ]);

            return response()->json([
                'data' => [
                    'message' => 'Akun berhasil terverifikasi']                 
                ],200);
        }
        else
        {
            return response()->json([
                'data' => [
                    'error' => 'Code OTP tidak valid']                 
                ],401);
        }

    }

    public function forgotPassword(Request $request)
    {
        $handphone = $request->get('handphone', null);
        if (empty($handphone)) {
            throw new BadRequestHttpException('handphone cannot be empty');
        }

        $user = $this->aclUserRepository->findByUsername($handphone);

        if (empty($user)) {
            throw new BadRequestHttpException('handphone is not registered');
        }

        try {
            DB::transaction(function() use($user) {
                
                $password = generatePassword();
                $this->aclUserRepository->update($user, [
                    'password' => bcrypt($password)
                ]);
                
            });

            return response()->json(['data' => 'done']);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
