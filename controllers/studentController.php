<?php

require('../models/studentModel.php');
$url = $_SERVER['HTTP_REFERER'];
$url = explode('/', $url);
$index = count($url);
$ref = $url[$index - 1];
if ($ref == 'registration.php' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (studentRegister($_POST)) {
        header('location:/views/login.php');
    };
} elseif ($ref == 'login.php' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    studentLogin($_POST);
}
