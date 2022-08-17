<?php
session_start();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user']->id;
    $game_edition_id = $_POST['game_edition_id'];
    $wihlist_item = $_POST['wishlist_item'];
    try {
        require_once '../../config/connection.php';
        require '../functions.php';
        removeItemFromWishlit($wihlist_item, $game_edition_id);
        $wishlisItems = getWishlistItems($user_id);
        echo json_encode($wishlisItems);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(404);
    }
} else {
    http_response_code(404);
}
