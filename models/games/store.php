<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $genres = $_POST['selectedGenres'];
    $publisher = $_POST['publisher'];

    $errors = [];
    $re_name = '';
    $re_description = '';

    if ($name == '') {
        $errors[] = "Name isn't ok";
    }
    if ($description == "") {
        $errors[] = "Description isn't ok";
    }

    if (count($genres) == 0) {
        $errors[] = "Please choose at least one genre";
    }

    if ($publisher == "default") {
        $errors[] = "Please choose publisher";
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
            if (checkGameName($name)) {
                // echo json_encode('sa');
                echo json_encode("That name is allready taken");
                http_response_code(409);
            } else {
                // echo json_encode('da');
                $connection->beginTransaction();
                insertGame($name, $description, $publisher, $genres);
                $connection->commit();
                $games = getAllGames();
                $pages = gamePagination();
                echo json_encode([
                    'games' => $games,
                    'pages' => $pages
                ]);
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
