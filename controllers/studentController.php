<?php

require('./models/studentModel.php');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;


/**
 * Handles the registration page display for users.
 *
 * This function checks if the user is authenticated via JWT. 
 * If the user is authenticated, they are redirected to the home page.
 * If the user is not authenticated, the registration view is displayed.
 *
 * @return void
 * @throws \Exception If the registration view cannot be loaded.
 */

function registrationGet()
{
    try {

        if (jwtAuth()) {
            header("location:/home");
        }
        require('./views/registration.php');
    } catch (Exception $e) {
        error_log($e->getMessage());
        header('location:/error');
        exit;
    }
}

/**
 * Handles the POST request for user registration.
 *
 * This function checks if the user is already authenticated via JWT. 
 * If the user is authenticated, they are redirected to the home page.
 * If the user is not authenticated, it attempts to register a new student 
 * using the provided POST data. If registration is successful, the user 
 * is redirected to the login page. If an exception occurs, it is logged 
 * and the user is redirected to an error page.
 *
 * @throws Exception If registration fails or if there's an error during processing.
 */

function registrationPost()
{
    try {

        if (jwtAuth()) {
            header("location:/home");
        }
        if (studentRegister($_POST)) {
            header('location:/login');
        };
    } catch (Exception $e) {
        error_log($e->getMessage());
        header('location:/error');
        exit;
    }
}

/**
 * Displays the login page.
 *
 * This function checks if the user is already authenticated via JWT. 
 * If the user is authenticated, they are redirected to the home page. 
 * If not, it requires the login view. Any errors during the process 
 * will be caught and logged.
 *
 * @throws Exception If an error occurs while requiring the login view.
 */

function loginGet()
{
    try {
        if (jwtAuth()) {
            header("location:/home");
            exit;
        }
        require('./views/login.php');
    } catch (Exception $e) {
        error_log($e->getMessage());
        header('location:/error');
        exit;
    }
}

/**
 * Handles the login process for the user.
 *
 * This function checks if the user is already authenticated via JWT. 
 * If the user is authenticated, they are redirected to the home page. 
 * It then attempts to log in the user using the provided credentials. 
 * If the login is successful, a JWT is created and set as a cookie. 
 * If the user is not found, an error message is displayed.
 *
 * @throws Exception If an error occurs during the login process or while encoding the JWT.
 */
function loginPost()
{
    try {
        if (jwtAuth()) {
            header("location:/home");
            exit;
        }

        $data = studentLogin($_POST);
        if (!$data) {
            throw new Exception('user not found');
            return;
        }

        $payload = [
            "email" => $data
        ];
        $token = JWT::encode($payload, $_ENV['jwtsecret'], 'HS256');
        setcookie('token', $token, time() + (2 * 24 * 60 * 60), '/', "");
        header('location:/home');
        exit;
    } catch (Exception $e) {
        error_log($e->getMessage());
        header('location:/error');
        exit;
    }
}


/**
 * Displays the home page for authenticated users.
 *
 * This function checks if the user is authenticated via JWT. 
 * If the user is not authenticated, they are redirected to the login page. 
 * If authenticated, it retrieves the user's data and their associated marks 
 * to display on the home page.
 *
 * @throws Exception If an error occurs while retrieving student data or marks.
 */
function homeGet()
{
    try {
        if (!jwtAuth()) {
            header('location:/');
            exit;
        }
        $data = jwtAuth();
        $student = getStudentDataEmail($data->email);
        if (!$student) {
            throw new Exception("Student data not found for email: " . $data->email);
        }

        $mark = getMark($student['id']);
        if ($mark === false) {
            throw new Exception("Error retrieving marks for student ID: " . $student['id']);
        }

        require('./views/home.php');
    } catch (Exception $e) {
        error_log($e->getMessage());
        header('location:/error');
        exit;
    }
}

/**
 * Displays the list of students.
 *
 * This function checks if the user is authenticated via JWT. If not, 
 * it redirects the user to the home page. If authenticated, it retrieves 
 * the list of all students and renders the 'list.php' view. 
 * If any exceptions occur during the process, the error is logged and 
 * the user is redirected to an error page.
 *
 * @throws Exception If there is an error retrieving the student list.
 */
function listGet()
{
    try {
        if (!jwtAuth()) {
            header('location:/');
            exit;
        }

        $students = getAllStudent();
        require('./views/list.php');
    } catch (Exception $e) {
        error_log($e->getMessage());
        header('location:/error');
        exit;
    }
}


/**
 * Displays the mark list for a specific student.
 *
 * This function checks if the user is authenticated via JWT. If not, 
 * it redirects the user to the home page. It then retrieves the 
 * student's data based on the provided email and fetches their marks. 
 * If any exceptions occur during the process, the error is logged 
 * and the user is redirected to an error page.
 *
 * @throws Exception If there is an error retrieving the student data or marks.
 */
function markListGet()
{
    try {
        if (!jwtAuth()) {
            header('location:/');
            exit;
        }

        $email = $_GET['email'];
        $data = getStudentDataEmail($email);

        if (!$data) {
            error_log("No student found for email: " . htmlspecialchars($email));
            header('location:/error');
            exit;
        }
        $mark = getMark($data['id']);
        require('./views/markList.php');
    } catch (Exception $e) {
        error_log($e->getMessage());
        header('location:/error');
        exit;
    }
}

/**
 * Handles the submission of marks for a specific student.
 *
 * This function checks if the user is authenticated via JWT. If not, 
 * it redirects the user to the home page. It then attempts to add 
 * marks using the submitted form data. If any exceptions occur 
 * during the process, the error is logged and the user is redirected 
 * to an error page.
 *
 * @throws Exception If there is an error adding marks to the database.
 */
function markListPost()
{
    try {
        if (!jwtAuth()) {
            header('location:/');
            exit;
        }

        $res = addMark($_POST);
        if ($res) {
            header('location:/mark-success');
        } else {
            error_log("Failed to add marks for data: " . json_encode($_POST));
            header('location:/error');
        }
    } catch (Exception $e) {
     
        error_log($e->getMessage());
        // Redirect to the error page
        header('location:/error');
        exit; // Ensure the script stops after redirection
    }
}


/**
 * Updates the student data based on the submitted form.
 *
 * This function attempts to update a student's data using the 
 * submitted POST data. If the update is successful, the user 
 * is redirected to the home page. In case of an error, it logs 
 * the error message and redirects to an error page.
 *
 * @throws Exception If there is an error updating the student data.
 */
function updateStudentData()
{
    try {
        if (updateStudent($_POST)) {
            header('location:/home');
            exit; 
        } else {
            error_log("Failed to update student data for: " . json_encode($_POST));
            header('location:/error'); // Redirect to error page
            exit;
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        header('location:/error');
        exit; 
    }
}



/**
 * Loads the error page view.
 *
 * This function includes the error.php view file, which displays
 * an error message to the user. It is typically called when an 
 * exception is thrown or an error occurs in the application.
 */
function loadErrorPage()
{
    require('./views/error.php');
}

