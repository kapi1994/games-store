<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $re_name = '';
    $errors = [];
    if ($name == "") {
        $errors[] = "Publisher name isn't ok";
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
            if (checkPublisherName('name', $name)) {
                echo json_encode('name is allready taken');
                http_response_code(409);
            } else {
                insertPublisher($name);
                $publishers = getAllPublishers();
                $publisherPages = publisherPagination();
                echo json_encode([
                    'publishers' => $publishers,
                    'pages' => $publisherPages
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
