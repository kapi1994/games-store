<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $re_first_last_name = '';
    $re_message = '';
    $errors = [];

    if ($first_name == "") {
        $errors[] = "First name isn't ok";
    }
    if ($last_name == "") {
        $errors[] = "Last name isn't ok";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "";
    }

    if ($message == "") {
        $errors[] = "Message isn't ok";
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        $from = $email;
        $usernameFrom  = $first_name . ' ' . $last_name;
        $to = 'games.store.a13@gmail.com';
        $usernameTo = "Admin";
        $messageHTML = "<div><h1>From:" . $from . ", " . $usernameFrom . "</h1> <br/><p>" . $message . "</p></div>";
        $subject = "Contact";

        include 'sendEmail.php';
        http_response_code(201);
        echo json_encode("Message is sent");
    }
} else {
    http_response_code(404);
}
