<?php
try {
    
    function checkPassword($username, $password){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //$query = $pdo->query("SELECT * FROM `users` WHERE `username` = ':username' and `passwordhash` = SHA2(CONCAT(':password', `salt`), 0)");
        $count = $pdo->query("SELECT * FROM `users` WHERE `username` = '$username' and `passwordhash` = SHA2(CONCAT('$password', `salt`), 0)")->rowCount();

        debug_to_console($count);

        //return $query->fetchColumn() === 1;
        return $count === 1;
    }

} catch (PDOException $e) {
    echo $e->getMessage();
}

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
?>