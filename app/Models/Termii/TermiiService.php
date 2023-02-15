<?php

namespace App\Models\Termii;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class TermiiService
{

    public function sendSms($to, $from, $message): Response
    {

        return Http::retry(5, 10000)
            ->post(env('TERMII_BASE_URL').TermiiCredentials::SEND_SMS_URI,
                [
                    "to" => $to,
                    "from" => $from,
                    "sms" => $message,
                    "type" => env('TERMII_TYPE'),
                    "channel" => env('TERMII_CHANNEL'),
                    "api_key" => env('TERMII_API_KEY'),
                ]
            );

    }

}
