<?php
namespace App\Tracker\Messaging;
use Twilio\Rest\Client;

/**
 * Class TwilioSMSClient
 * @property Client client
 * @package App
 */
class TwilioSMSClient implements SMSServiceInterface
{

    protected $twilio_number;

    public function __construct()
    {
        // Use the REST API Client to make requests to the Twilio REST API

        // Your Account SID and Auth Token from twilio.com/console
        $sid = \Config::get('sms.TWILIO_SID');
        $token = \Config::get('sms.TWILIO_AUTH_TOKEN');;
        $this->client = new Client($sid, $token);

        $this->twilio_number = \Config::get('sms.TWILIO_NUMBER');
    }

    /**
     * @param string $number
     * @param string $message
     * @return mixed
     */
    public function send($number, $message)
    {
        \Log::info("Sending `{$message}` to `{$number}`");
        // Use the client to do fun stuff like send text messages!
        return $this->client->messages->create(
            // the number you'd like to send the message to
            '+1'.$number,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => $this->twilio_number,

                // the body of the text message you'd like to send
                'body' => $message
            )
        );
    }
}
