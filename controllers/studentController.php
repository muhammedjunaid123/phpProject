<?php

require('./models/studentModel.php');

use \Firebase\JWT\JWT;

function registrationGet()
{
    require('./views/registration.php');
}
function registrationPost()
{
    if (studentRegister($_POST)) {
        header('location:/login');
    };
}
function loginGet()
{
    require('./views/login.php');
}
function loginPost()
{
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
    header('location:/home');
}

function homeGet()
{
    require('./views/home.php');
}
function listGet()
{
    $students = getAllStudent();
   
    require('./views/list.php');
}
