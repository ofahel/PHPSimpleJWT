<?php

/*
    Repo name: PHP Simple JWT
    Repo link: https://github.com/ofahel/PHPSimpleJWT
    Coded by: oFahel
*/

$JWT = new class
{
    public function validate($token, $secret_key)
    {

        $token_array = explode(".", $token);
        $jwt = json_decode(base64_decode($token_array[1]), true);
        if (!is_array($jwt))
            $jwt = json_decode(base64_decode($token_array[1] . '=='), true);

        if (isset($jwt['exp'])) {
            if ($jwt['exp'] < time())
                return false;
        }

        $valid = base64_encode(hash_hmac('sha256', $token_array[0] . '.' . $token_array[1], $secret_key, true));
        $valid = str_replace('/', '_', $valid);
        $valid = str_replace('+', '-', $valid);
        $valid = str_replace('=', '', $valid);

        if ($token_array[2] == $valid) {
            $valid = true;
        } else {
            $valid = false;
        }

        return $valid;
    }

    public function generate($payload, $secret_key)
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];

        $header = base64_encode(json_encode($header));

        $payload = base64_encode(json_encode($payload));

        $signature = base64_encode(hash_hmac('sha256', "$header.$payload", $secret_key, true));
        $signature = str_replace('/', '_', $signature);
        $signature = str_replace('+', '-', $signature);
        $signature = str_replace('=', '', $signature);

        return "$header.$payload.$signature";
    }

    public function decode($token, $secret_key)
    {
        $token_array = explode(".", $token);
        $header = $token_array[0];
        $payload = $token_array[1];
        $signature = $token_array[2];

        $valid = true;
        if (!$this->validate($token, $secret_key)) {
            $valid = false;
        };

        $jwt = json_decode(base64_decode($payload), true);
        if (!is_array($jwt))
            $jwt = json_decode(base64_decode($token_array[1] . '=='), true);

        return ($valid) ? $jwt : false;
    }
};
