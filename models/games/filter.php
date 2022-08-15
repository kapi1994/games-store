<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $keyword  = isset($_GET['keyword']) ? $_GET['keyword'] : "";
    $order = isset($_GET['order']) ? $_GET['order'] : '';
    $limit = isset($_GET['page']) ? $_GET['page'] : '';
    // echo json_encode($order);
    require_once '../../config/connection.php';
    require '../functions.php';
    $games = getAllGames($keyword, $order, $limit);
    $gamesPagination = gamePagination($keyword);
    echo json_encode([
        'games' => $games,
        'pages' => $gamesPagination
    ]);
} else {
    http_response_code(404);
}
