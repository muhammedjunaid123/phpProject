<?php

require('../config/sqlConfig.php');

function studentRegister($data)
{
    try {
        global $conn;
        extract($data);
        $data['class'] = (int)$data['class'];
        
        $sql_insert = "INSERT INTO student(name, email, password, class, division) VALUES ('$name', '$email', '$password', $class, '$division')";
        if ($conn->query($sql_insert)) {
            return true;
        } else {
            return false;
        }
    } catch (\Throwable $th) {
        return $th;
    }
}

function greet($name)
{
    return "Hello, " . $name . "!";
}
