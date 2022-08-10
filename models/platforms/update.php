<?php
header("Contnet-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $re_name  = [];
    $errors = [];

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
            $checkName = getPlatform('name', $name);
            if ($checkName && $checkName->name == $name && $checkName->id != $id) {
                http_response_code(409);
                echo json_encode("This name is allready taken!");
            } else {
                updatePlatform($name, $id);
                $platform = getPlatformFullRow($id);
                echo json_encode($platform);
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
