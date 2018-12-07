<?php
    //Unset the session variable isLoggedIn and redirect page
    session_start();
    unset($_SESSION['isLoggedIn']);
    header( 'Location: https://licarijd.comp4ww3.com' );
?>