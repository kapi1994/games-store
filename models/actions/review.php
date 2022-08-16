<?php
session_start();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $game_edition_id = $_POST['game_edition_id'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];
    $user_id  = isset($_SESSION['user']) ? $_SESSION['user']->id : '';
    $errors = [];
    if ($rating == 'default') {
        $errors[] = "Please choose rating";
    }
    if ($message == "") {
        $errors[] = "Please enter message";
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

            $lastInsertReview = insertReview($rating, $message, $game_edition_id, $user_id);
            $lastReview = getLastReview($lastInsertReview, $user_id);
            echo json_encode($lastReview);
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
