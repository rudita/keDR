<?php

namespace App\Http\Controllers;
use App\Repositories\SMSRepository;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Twilio\Jwt\ClientToken;

class SMSVerificationController extends Controller
{
    /**
     * @var code
     */
    protected $code;
    
    /**
     * @var smsVerifcation
     */
    protected $smsVerifcation;

    /**
     * DoctorAccountController constructor.
     * @param DoctorAccountRepository $doctorAccountRepository     
     * @param Application $application
     */

    public function __construct( smsVerifcation $smsVerifcation )
    {
        $this->smsVerifcation = $smsVerifcation;
    }

    public function store(Request $request)
    {
        $code = rand(1000, 9999); //generate random code
        $request['code'] = $code; //add code in $request body

        $this->smsVerifcation->store($request); //call store method of model

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

    public function verifyContact(Request $request)
    {
        
        $smsVerification = $this->SMSVerificationRepository->findByHandphone($request->Handphone);

        if($request->code == $smsVerification->code)
        {
            $this->SMSVerificationRepository->update($smsVerification, [
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

}
