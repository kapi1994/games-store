<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $limit = $_GET['limit'];
    require_once '../../config/connection.php';
    require '../functions.php';

    $platforms = platforms($limit);
    $pages = platoformsPagination();

    echo json_encode([
        'platforms' => $platforms,
        'pages' => $pages
    ]);
} else {
    http_response_code(404);
}
