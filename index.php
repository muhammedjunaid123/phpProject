<?php
require('./controllers/studentController.php');

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$action = $_POST['action'] ?? null;
switch (true) {
    case $action == null && $requestUri == '/':
        registrationGet();
        break;
    case $action == null && $requestUri == '/registration':
        registrationGet();
        break;
    case $action == null && $requestUri == '/login':
        loginGet();
        break;
    case $action == null && $requestUri == '/home':
        loginGet();
        break;
    case $action == null && $requestUri == '/list':
        listGet();
        break;
    case $action == 'registration':
        registrationPost();
        break;
    case $action == 'login':
        loginPost();
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
