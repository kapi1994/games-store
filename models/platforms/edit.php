<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    require_once '../../config/connection.php';
    require '../functions.php';
    $platform = getPlatform('id', $id);
    echo json_encode($platform);
} else {
    http_response_code(404);
}
