<?php

require('./models/studentModel.php');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
    $token = $_COOKIE['token'];
    $data = JWT::decode($token, new Key($_ENV['jwtsecret'], 'HS256'));
    $student=getStudentDataEmail($data->email);
    $mark=getMark($student['id']);
    require('./views/home.php');
}
function listGet()
{
    $students = getAllStudent();
    require('./views/list.php');
}

function markListGet()
{
    $email = $_GET['email'];
    $data = getStudentDataEmail($email);
    $mark = getMark($data['id']);
    require('./views/markList.php');
}

function markListPost()
{
    $res = addMark($_POST);
}
