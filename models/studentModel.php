<?php

require('../config/sqlConfig.php');

function studentRegister($data)
{
    try {
        global $conn;
        extract($data);
        $class = (int)$class;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql_insert = "INSERT INTO student(name, email, password, class, division) VALUES ('$name', '$email', '$hashedPassword', $class, '$division')";
        if ($conn->query($sql_insert)) {
            return true;
        } else {
            return false;
        }
    } catch (\Throwable $th) {
        return $th;
    }
}

function studentLogin($data)
{
    try {
        global $conn;
        extract($data);
        $sql_get = "SELECT * FROM student WHERE email = '$email' LIMIT 1";
        $result = $conn->query($sql_get);
        if ($result->num_rows == 1) {
            $res = mysqli_fetch_assoc($result);
            $inputPassword = $password;
            $storedHash = $res['password'];

            if (password_verify($inputPassword, $storedHash)) {
              return $email;
            } else {
               return false;
            }
        } else {
            return false;
        }
    } catch (\Throwable $th) {
        echo $th;
    }
}
