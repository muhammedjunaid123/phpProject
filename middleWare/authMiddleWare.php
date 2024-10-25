<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function jwtAuth()
{
    try {
        if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
            $data = JWT::decode($token, new Key($_ENV['jwtsecret'], 'HS256'));
            return $data;
        } else {
            throw new Exception("Unauthorized!");
        }
    } catch (\Throwable $th) {
       return;
    }
}
