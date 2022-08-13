<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'] == 0 ? 1 : 0;
    try {
        require_once '../../config/connection.php';
        require '../functions.php';
        softDeleteGame($id, $status);
        $game = getGameFullRow($id);
        echo json_encode($game);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
