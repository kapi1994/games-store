<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    require_once '../../config/connection.php';
    require '../functions.php';
    $publisher = getPublisher('id', $id);
    echo json_encode($publisher);
} else {
    http_response_code(404);
}
