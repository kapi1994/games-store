<?php
session_start();
header("Content-type:application/json");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $cart_item_id = $_POST['cart_item_id'];
    $game_edition_id = $_POST['game_edition_id'];
    $user_id = $_SESSION['user']->id;
    try {
        require_once '../../config/connection.php';
        require '../functions.php';
        removeItemFromCartItems($cart_item_id, $game_edition_id);
        $games = getItemsFromCart($user_id);
        echo json_encode($games);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
