<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $id  = $_POST['id'];
    $errors = [];
    $re_name = '';
    if ($name == '') {
        $errors[] = "Name isn't ok";
    }
    if (count($errors)) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            require '../functions.php';
            $checkName = checkPublisherName('name', $name);

            if ($checkName && $checkName->name == $name && $checkName->id != $id) {
                echo json_encode("That name is allready taken");
                http_response_code(409);
            } else {
                updatePublisher($id, $name);
                $publisher  = getFullPublisherRow($id);
                echo json_encode($publisher);
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
