<?php
namespace TwilioWithThinQLCR;

//require_once __DIR__ . '/../../vendor/autoload.php'; // Loads the library

use Twilio\Rest\Api\V2010\Account\CallInstance;
use Twilio\Rest\Client;

class TwilioWrapper
{
    private $client;
    private $twilio_account_sid;
    private $twilio_account_token;
    private $thinQ_id;
    private $thinQ_token;
    const THINQ_DOMAIN = "wap.thinq.com";
    const TWIML_RESOURCE_URL = "http://demo.twilio.com/docs/voice.xml";

    /**
     * TwilioWrapper constructor.
     * @param string $twilio_account_sid
     * @param string $twilio_account_token
     * @param string $thinQ_id
     * @param string $thinQ_token
     */
    function __construct($twilio_account_sid, $twilio_account_token, $thinQ_id, $thinQ_token)
    {
        $this->twilio_account_sid = $twilio_account_sid;
        $this->twilio_account_token = $twilio_account_token;
        $this->thinQ_id = $thinQ_id;
        $this->thinQ_token = $thinQ_token;

        $this->client = new Client($twilio_account_sid, $twilio_account_token);
    }

    /**
     * @return bool
     */
    public function isClientValid()
    {
        return $this->client != null && $this->client->account != null;
    }

    /**
     * @param string $from Phone number calling from
     * @param string $to Destination phone number
     * @param array $options Optional arguments
     * @return CallInstance|String New call instance or error message
     */
    public function call($from, $to, $options)
    {
        if (!$this->isClientValid()) {
            return "Invalid Twilio Account details.";
        }

        try {
            $call = $this->client->calls->create(
                "sip:" . $to . "@". self::THINQ_DOMAIN . '?thinQid='.$this->thinQ_id . '&thinQtoken='.$this->thinQ_token,
                $from,
                $options
            );
            return $call;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}