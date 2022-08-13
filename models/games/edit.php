<?php
header("Content-type:application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    require_once '../../config/connection.php';
    require '../functions.php';
    $game = getGame($id);
    echo json_encode($game);
} else {
    http_response_code(404);
}
