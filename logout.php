<?php
    session_start();
    unset($_SESSION['isLoggedIn']);
    header( 'Location: https://licarijd.comp4ww3.com' );
?>