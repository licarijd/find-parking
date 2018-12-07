<?php
session_start();

//If the user isn't logged in (check session variable isLoggedIn), redirect to login page
if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: http://{$_SERVER['HTTP_HOST']}/login.php");
    exit();
}
?>