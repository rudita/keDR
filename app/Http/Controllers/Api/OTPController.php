<?php

namespace App\Http\Controllers;
use App\Repositories\OTPRepository;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Twilio\Jwt\ClientToken;

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

    public function __construct( OTP $OTP )
    {
        $this->OTP = $OTP;
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

}
