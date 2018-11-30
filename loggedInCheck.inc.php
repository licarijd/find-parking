<?php
session_start();
if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: http://{$_SERVER['HTTP_HOST']}/login.php");
    exit();
}
?>