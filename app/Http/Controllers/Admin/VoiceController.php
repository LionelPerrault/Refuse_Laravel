<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\TwiML\VoiceResponse;




use App\Model\Settings;


class VoiceController extends Controller
{
    
    
    public function handleIncomingCall(Request $request)
    {
        $phone = $request->get('To');
        $settings = Settings::first()->toArray();
        $callerId = $settings['call_forward_number'];
        $response = new VoiceResponse();
        if ($phone == $callerId) {
            # Receiving an incoming call to the browser from an external phone
            $response = new VoiceResponse();
            $dial = $response->dial('');
            $dial->client('bulk-sms');
        } else if (!empty($phone) && strlen($phone) > 0) {
            $number = htmlspecialchars($phone);
            $dial = $response->dial('', ['callerId' => $callerId]);
            
            // wrap the phone number or client name in the appropriate TwiML verb
            // by checking if the number given has only digits and format symbols
            if (preg_match("/^[\d\+\-\(\) ]+$/", $number)) {
                $dial->number($number);
            } else {
                $dial->client($number);
            }
        } else {
            $response->say("Thanks for calling!");
        }
        return (string)$response;
    }

    public function generateAccessToken(Request $request)
    {
        
        $settings = Settings::first()->toArray();
        
        $TWILIO_ACCOUNT_SID = $settings['twilio_api_key'];
        $TWILIO_SECRET_KEY = $settings['call_secret_token'];
        $API_KEY = $settings['call_api_key'];
        $TWIML_APP_SID = $settings['twiml_app_sid'];
        
        $accessToken = new AccessToken($TWILIO_ACCOUNT_SID, $API_KEY, $TWILIO_SECRET_KEY, 3600, 'bulk-sms');
        
        
        $voiceGrant = new VoiceGrant();
        $voiceGrant->setOutgoingApplicationSid($TWIML_APP_SID); 
        $accessToken->addGrant($voiceGrant);
        $voiceGrant->setIncomingAllow(true);

        $token = $accessToken->toJWT();

        return response()->json(['token' => $token]);
        
    }
}