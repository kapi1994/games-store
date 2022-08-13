<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description  = $_POST['description'];
    $genres = $_POST['selectedGenres'];
    $publisher = $_POST['publisher'];

    $id = $_POST['id'];

    $re_name = '';
    $re_description = '';

    $errors = [];

    if ($name == '') {
        $errors[] = "Name isn't ok";
    }
    if ($description == "") {
        $errors[] = "Description isn't ok";
    }

    if (count($genres) == 0) {
        $errors[] = "Please choose at least one genre";
    }

    if ($publisher == 'default') {
        $errors[] = "Choose publisher";
    }

    if (count($errors) >  0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            require '../functions.php';
            $game = checkGameName($name);
            if ($game && $game->name == $name && $game->id != $id) {
                echo json_encode("Name is allready taken");
                http_response_code(409);
            } else {
                $connection->beginTransaction();
                updateGame($name, $description, $publisher,  $id, $genres);
                $game = getGameFullRow($id);
                echo json_encode($game);
                $connection->commit();
            }
        } catch (PDOException $th) {
            $connection->rollBack();
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
