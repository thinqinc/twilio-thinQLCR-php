# Twilio Wrapper PHP Library For thinQ LCR integration

**This package is no longer maintainted. You should use the rest API instead**
--------------------------------------------------------------------------

#### Note that you will need a valid LCR Account with thinQ before using the libraries. For more information please contact your thinQ Sales representative at [http://www.thinq.com](http://www.thinq.com)

Example usage:

```php
<?php
 
 require_once __DIR__ . '/vendor/autoload.php';
 
 use TwilioWithThinQLCR\TwilioWrapper;
 
 $twilio_account_sid = "SDIFUSDO4IFSDF4OSDF2OIDJSFOISDF";
 $twilio_auth_token  = "adsf987asd9f876sad98f7as9d8fsa9";
 $thinQ_id = "12345";
 $thinQ_token = "daf98dsf9g876sd987fg6d78fsg897dsf6g";
 $from_number = "19198900000";
 $to_number = "11234567890";
 $twiML = "http://example.com/xml/twilio-custom.xml";
 
 $wrapperObj = new TwilioWrapper($twilio_account_sid, $twilio_auth_token, $thinQ_id, $thinQ_token);
 
 $newCall = $wrapperObj->call($from_number, $to_number, array('url'=>$twiML));
 
 echo "Call sid: " . $newCall->sid . PHP_EOL;
```


---

###### *Copyright (c) 2017 thinQ*
