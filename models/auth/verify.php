<?php
require_once '../../config/connection.php';
include '../functions.php';
if (!isset($_GET['token']) || !isset($_GET['id'])) {
    echo "Undefiend token and user";
} else {
    if (enableAccount($_GET['id'], $_GET['token'])) {
        session_start();
        $_SESSION['activateAcc'] = true;
        header('Location: ../../index.php?page=login');
    } else {
        echo 'Undefiend token and user';
    }
}
