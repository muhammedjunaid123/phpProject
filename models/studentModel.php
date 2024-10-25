<?php

require('./config/sqlConfig.php');
require('./middleWare/authMiddleWare.php');

function studentRegister($data)
{
    try {
        global $conn;

        // Extract and sanitize inputs
        $name = htmlspecialchars(trim($data['name']));
        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $class = (int)$data['class'];
        $division = htmlspecialchars(trim($data['division']));

        if ($name === '') {
            throw new Exception("Invalid name format");
        }
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // Hash the password securely
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        // Use a prepared statement to prevent SQL injection
        $sql_insert = "INSERT INTO student (name, email, password, class, division) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert);

        // Bind parameters
        $stmt->bind_param("sssds", $name, $email, $hashedPassword, $class, $division);

        // Execute the statement
        if ($stmt->execute()) {
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
        if (!empty($result)) {
            $inputPassword = $password;
            $storedHash = $result['password'];

            // Verify the input password with the stored hash
            if (password_verify($inputPassword, $storedHash)) {
                return $email; // Login successful
            } else {
                throw new Exception("Incorrect password");
            }
        } else {
            throw new Exception("user not found");
        }
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}


function getAllStudent()
{
    try {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM student");
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $data;
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}

function getStudentDataEmail($email)
{
    try {
        global $conn;

        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT * FROM student WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email); // Bind the parameter as a string
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        // Close the statement
        $stmt->close();

        return $data ? $data : []; // Return an empty array if no data found
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
            // Prepare the INSERT statement
            $stmt = $conn->prepare("INSERT INTO marks (std_id, mathematics, science, english, history) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $std_id, $mathematics, $science, $english, $history);
        } else {
            // Prepare the UPDATE statement
            $stmt = $conn->prepare("UPDATE marks SET mathematics = ?, science = ?, english = ?, history = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $mathematics, $science, $english, $history, $id);
        }

        // Execute the prepared statement
        if ($stmt->execute()) {
            $stmt->close(); // Close the statement
            return true; // Return true on success
        } else {
            $stmt->close(); // Close the statement
            return false; // Return false on failure
        }
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}


function getMark($std_id)
{
    try {
        global $conn;

        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT * FROM marks WHERE std_id = ? LIMIT 1");
        $stmt->bind_param("i", $std_id); // Bind the parameter as an integer
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        // Close the statement
        $stmt->close();

        return $data ? $data : []; // Return an empty array if no data found
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}


function updateStudent($data)
{
    try {
        global $conn;
        extract($data);

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE student SET name = ?, class = ?, division = ? WHERE email = ?");
        $stmt->bind_param("siss", $name, $class, $division, $email); // Bind the parameters

        // Execute the prepared statement
        if ($stmt->execute()) {
            $stmt->close(); // Close the statement
            return true;
        } else {
            $stmt->close(); // Close the statement
            return false;
        }
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}

