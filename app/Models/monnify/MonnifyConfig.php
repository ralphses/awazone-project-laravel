<?php

namespace App\Models\monnify;

use Illuminate\Support\Facades\Http;

class MonnifyConfig {


    public static function base64Secrete() : string {
        return MonnifyCredentials::BASIC_AUTHORIZATION_PREFIX . base64_encode(env('MONNIFY_KEY').":".env('MONNIFY_SECRETE'));
    }

    public static function getAccessToken() : string {

        $response = Http::withHeaders(["Authorization" => self::base64Secrete()])
            ->post(env("MONNIFY_BASE_URL") . MonnifyCredentials::LOGIN_URL);

        return $response->json()['responseBody']['accessToken'];
    }


}
