<?php

require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
$conn = new mysqli($_ENV['host'], $_ENV['userName'], $_ENV['password'], $_ENV['db']);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
