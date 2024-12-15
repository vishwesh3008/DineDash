<?php
session_start();

if (isset($_SESSION['user']) && $_SESSION['user'] == 'cus') {
    header("Location: user_home.php");
    exit;
}

if (isset($_SESSION['user']) && $_SESSION['user'] == 'res') {
    header("Location: restaurant_home.php");
    exit;
}
?>