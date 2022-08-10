<?php
session_start();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email  = $_POST['email'];
    $password = $_POST['password'];
    $re_password = '';
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] =  "Email ins' t ok";
    }
    if ($password == "") {
        $errors[] = "Password isn't ok";
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            require '../functions.php';
            $user = login($email, $password);
            $_SESSION['user'] = $user;
            echo json_encode($user->role_id);
        } catch (PDOException $th) {
            echo json_Encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
