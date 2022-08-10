<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $limit = $_GET['limit'];

    require_once '../../config/connection.php';
    require '../functions.php';

    $publishers = getAllPublishers($limit);
    $publisherPages = publisherPagination();

    echo json_encode([
        'publishers' => $publishers,
        'pages' => $publisherPages
    ]);
} else {
    http_response_code(404);
}
