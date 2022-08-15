<?php
session_start();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = [];

    $rePassword = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email isn't ok";
    }

    if (!preg_match_all($rePassword, $password)) {
        $errors[] = " Password isn't ok";
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            require '../functions.php';
            $checkUserEmail = checkEmail($email);
            if (!$checkUserEmail) {
                echo json_encode("There isn't a user with that email");
                http_response_code(500);
            } else {
                $tmp_id = $checkUserEmail->id;
                // echo json_encode($tmp_id);
                if (dissabledAccount($tmp_id)) {
                    echo json_encode("Your account has been disabled, please check your mail.");
                    http_response_code(500);
                } else {
                    //     // echo json_encode('nije');
                    $user = login($email, $password);
                    // echo json_encode($user);
                    if (!$user) {
                        insertActivity($tmp_id, "Invalid password");
                        http_response_code(500);
                        if (!insertThreeTimesInFive($tmp_id)) {
                            echo json_encode("Incorrect password");
                            http_response_code(500);
                        } else {
                            insertActivity($tmp_id, "Dissabled account");
                            echo json_encode("You dissabled account! We are send you mail to reactivate");
                            http_response_code(500);
                        }
                    } else {
                        insertActivity($user->id, "Login");
                        $role_id = $user->role_id;
                        $_SESSION['user'] = $user;
                        echo json_encode($role_id);
                    }
                }
            }
        } catch (PDOException $th) {
            http_response_code(500);
            echo json_encode($th->getMessage());
        }
    }
} else {
    http_response_code(404);
}
