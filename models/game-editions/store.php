<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $platform = $_POST['platform'];
    $price = $_POST['price'];
    $relase_date = $_POST['release_date'];
    $cover = $_FILES['image_cover'];
    $game_id = $_POST['game_id'];

    // $image_name = $cover['name'];
    $image_size = $cover['size'];
    $image_type = $cover['type'];
    $image_tmp = $cover['tmp_name'];
    $allowed_type = ['image/jpg', 'image/jpeg', 'image/png'];

    $errors = [];
    $re_errors = [];

    if ($platform == 'default') {
        $errors[] = "Please choose platform";
    }

    if ($price == "") {
        $errors[] = "Please fill price";
    }

    if ($relase_date == "") {
        $errors[]  = "Please choose release date";
    }

    if ($image_size >  3 * 1024 * 1024) {
        $errors[] = "Image size must be less than 3mb";
    }

    if (!in_array($image_type, $allowed_type)) {
        $errors[]  = "Image type is not allowed";
    }


    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        require_once '../../config/connection.php';
        require '../functions.php';

        try {
            $image_name = resizeImage($cover);
            insertGameEdition($platform, $game_id, $relase_date, $price, $image_name);
            $gameEditions = getGameEditions($game_id);
            echo json_encode($gameEditions);
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
