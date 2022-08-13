<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET['id'];
    require_once '../../config/connection.php';
    require '../functions.php';
    $gameEdition = getGameEdition($id);
    echo json_encode($gameEdition);
} else {
    http_response_code(500);
}
