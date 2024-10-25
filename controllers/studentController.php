<?php

require('./models/studentModel.php');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

function registrationGet()
{
    if(jwtAuth()){
        header("location:/home");
    }
    require('./views/registration.php');
}
function registrationPost()
{
    if(jwtAuth()){
        header("location:/home");
    }
    if (studentRegister($_POST)) {
        header('location:/login');
    };
}
function loginGet()
{
    if(jwtAuth()){
        header("location:/home");
    }
    require('./views/login.php');
}
function loginPost()
{
    if(jwtAuth()){
        header("location:/home");
    }
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
     if(!jwtAuth()){
        header('location:/');
     }
    $data =jwtAuth();
    $student=getStudentDataEmail($data->email);
    $mark=getMark($student['id']);
    require('./views/home.php');
}
function listGet()
{
    if(!jwtAuth()){
        header('location:/');
     }
    $students = getAllStudent();
    require('./views/list.php');
}

function markListGet()
{
    if(!jwtAuth()){
        header('location:/');
     }
    $email = $_GET['email'];
    $data = getStudentDataEmail($email);
    $mark = getMark($data['id']);
    require('./views/markList.php');
}

function markListPost()
{
    if(!jwtAuth()){
        header('location:/');
     }
    $res = addMark($_POST);
}
