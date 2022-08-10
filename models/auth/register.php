<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];
    $re_first_last_name = '';
    $re_password = '';

    if ($first_name == '') {
        $errors[] = "First name isn't ok";
    }
    if ($last_name == "") {
        $errors[] = "Last name isn't ok";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email isn't ok";
    }

    if ($password == "") {
        $errors[]  = "Password isn't ok";
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
            if (checkEmail($email)) {
                echo json_encode("Email is allready taken!");
                http_response_code(409);
            } else {
                insertUser($first_name, $last_name, $email, $password);
                http_response_code(204);
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
