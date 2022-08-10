<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $errors  = [];
    $re_name = '';

    if ($name == "") {
        $errors[] = "Name isn't ok";
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
            if (checkNamePlatform($name)) {

                http_response_code(409);
                echo json_encode("Name for the platform is allready taken!");
            } else {
                insertPlatform($name);
                $platforms = platforms();
                $pages = platoformsPagination();
                echo json_encode([
                    'platforms' => $platforms,
                    'pages' => $pages
                ]);
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
