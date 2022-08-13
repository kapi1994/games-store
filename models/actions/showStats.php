<?php
header("Content-type:applicaiton/json");
require_once '../../config/connection.php';
require '../functions.php';

$file =  fopen("../../data/logs.txt", 'r');
$fileData = file('../../data/logs.txt');
fclose($file);

$stats = [];
$pages = ['home' => 0, 'games' => 0, 'contact' => 0, 'author' => 0];
$pages24 = ['home' => 0, 'games' => 0, 'contact' => 0, 'author' => 0];

$total = 0;
$total24 = 0;

// echo json_encode($fileData);


echo json_encode([
    'totalOrders' => totalOrders(),
    'registretedUsers' => totalRegistetedUsers()
]);
