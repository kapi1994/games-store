<?php
session_start();
require_once 'config/connection.php';
require 'models/functions.php';
include 'includes/fixed/head.php';
include 'includes/fixed/navigation.php';
$page = '';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'platforms':
            include "includes/pages/admin/platforms.php";
            break;
        case 'publishers':
            include 'includes/pages/admin/publishers.php';
            break;
        case 'games':
            include 'includes/pages/admin/games.php';
            break;
    }
}

include 'includes/fixed/footer.php';
