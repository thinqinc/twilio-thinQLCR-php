<?php
namespace TwilioWithThinQLCR;
//require_once __DIR__ . '/../../vendor/autoload.php'; // Loads the library
use Services_Twilio;

class TwilioWrapper
{
    private $client;
    private $twilio_account_sid;
    private $twilio_account_token;
    private $thinQ_id;
    private $thinQ_token;
    const THINQ_DOMAIN = "wap.thinq.com";
    const TWIML_RESOURCE_URL = "http://demo.twilio.com/docs/voice.xml";

    function __construct($twilio_account_sid, $twilio_account_token, $thinQ_id, $thinQ_token)
    {
        $this->twilio_account_sid = $twilio_account_sid;
        $this->twilio_account_token = $twilio_account_token;
        $this->thinQ_id = $thinQ_id;
        $this->thinQ_token = $thinQ_token;

        $this->client = new Services_Twilio($twilio_account_sid, $twilio_account_token);
    }

    public function isClientValid() {
        return $this->client != null && $this->client->account != null;
    }

    public function call($from, $to, $twiML = self::TWIML_RESOURCE_URL)
    {
        if (!$this->isClientValid()) {
            return "Invalid Twilio Account details.";
        }

        try {
            return $this->client->account->calls->create($from, "sip:" . $to . "@". self::THINQ_DOMAIN . '?thinQid='.$this->thinQ_id . '&thinQtoken='.$this->thinQ_token, $twiML);
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }
}