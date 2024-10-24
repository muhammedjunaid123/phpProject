<?php

require('../models/studentModel.php');

use \Firebase\JWT\JWT;

$url = $_SERVER['HTTP_REFERER'];
$url = explode('/', $url);
$index = count($url);
$ref = $url[$index - 1];
if ($ref == 'registration.php' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (studentRegister($_POST)) {
        header('location:/views/login.php');
    };
} elseif ($ref == 'login.php' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = studentLogin($_POST);
    if (!$data) {
        echo "not found";
        return;
    }
    $payload = [
        "email" => $data
    ];
    $token = JWT::encode($payload, $_ENV['jwtsecret'], 'HS256');
    setcookie('token', $token, time() + (2 * 24 * 60 * 60), '/', "");
    header('location:/views/home.php');
}
