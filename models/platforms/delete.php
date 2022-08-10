<?php
header("Content-type:application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'] == 0 ? 1 : 0;
    $id = $_POST['id'];
    try {
        require_once '../../config/connection.php';
        require '../functions.php';

        softDeletePlatform($id, $status);
        $platform = getPlatformFullRow($id);
        echo json_encode($platform);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
