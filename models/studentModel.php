<?php

require('./config/sqlConfig.php');
require('./middleWare/authMiddleWare.php');
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
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}

function studentLogin($data)
{
    try {
        global $conn;
        extract($data);
        $result = getStudentDataEmail($email);
        if (count($result) > 0) {
            $inputPassword = $password;
            $storedHash = $result['password'];

            if (password_verify($inputPassword, $storedHash)) {
                return $email;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}

function getAllStudent()
{
    try {
        global $conn;
        $sql_get_all = "SELECT * FROM student";
        $data = $conn->query($sql_get_all);
        return $data->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}

function getStudentDataEmail($email)
{
    try {
        global $conn;
        $sql_get = "SELECT * FROM student WHERE email = '$email' LIMIT 1";
        $result = $conn->query($sql_get);
        return mysqli_fetch_assoc($result);
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}
function addMark($data)
{
    try {
        global $conn;
        extract($data);
        if (empty($data['id'])) {
            $sql_insert = "INSERT INTO marks(std_id,mathematics,science,english,history) VALUES ($std_id, '$mathematics', '$science', '$english', '$history')";
        } else {
            $sql_insert = "UPDATE marks 
            SET mathematics = '$mathematics', science = '$science', english = '$english', history = '$history' 
            WHERE id = '$id'";
        }
        echo $sql_insert;
        if ($conn->query($sql_insert)) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}

function getMark($std_id)
{
    try {
        global $conn;
        $sql_get = "SELECT * FROM marks WHERE std_id = $std_id LIMIT 1";
        $result = $conn->query($sql_get);
        return mysqli_fetch_assoc($result);
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}

function updateStudent($data)
{
    try {
        global $conn;
        extract($data);
        $sql_update = "UPDATE student 
    SET name = '$name', 
        class = $class, 
        division = '$division' 
    WHERE email = '$email'";
        if ($conn->query($sql_update)) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}
