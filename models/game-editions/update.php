<?php
header("Content-type:applicaiton/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $platform = $_POST['platform'];
    $price = $_POST['price'];
    $relase_date = $_POST['release_date'];
    $game_id = $_POST['game_id'];
    $game_edition_id = $_POST['game_edition_id'];


    $errors = [];
    if ($platform == "default") {
        $errors[] = "Choose platform for the game";
    }

    if ($price <= 0) {
        $errors[] = "Price must be higher than 0";
    }

    if ($relase_date == "") {
        $errors[] = "Please choose date";
    }

    if (isset($_FILES['image_cover'])) {
        $image = $_FILES['image_cover'];
        $image_size = $image['size'];
        $type = $image['type'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if ($image_size > 3 * 1024 * 1024) {
            $errors[] = "Image size must be less than 3mb";
        }

        if (!in_array($type, $allowedTypes)) {
            $errors[] = "Image type isn't alloweed";
        }
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
            $image_name  = '';
            if (isset($_FILES['image_cover'])) {
                $image = $_FILES['image_cover'];
                $image_name = resizeImage($image);
            }

            updateGameEdition($platform, $relase_date, $price, $game_edition_id, $image_name);
            $game_edition = getGameEditionFullRow($game_edition_id);
            echo json_encode($game_edition);
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
