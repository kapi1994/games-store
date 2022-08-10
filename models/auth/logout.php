<?php
session_start();
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user']->id;
    require '../functions.php';
    insertActivity($id, "Logout");
    unset($_SESSION['user']);
    session_destroy();
    header("Location: ../../index.php");
}
