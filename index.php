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
        case 'login':
            include 'includes/pages/auth/login.php';
            break;
        case 'register':
            include 'includes/pages/auth/register.php';
            break;
    }
}
include 'includes/fixed/footer.php';
