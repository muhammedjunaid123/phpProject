<?php
echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_URI'] == '/') {
    header("location:/views/registration.php");
    exit;
}
