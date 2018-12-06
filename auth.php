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

    function checkIfNewUser($email){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //$query = $pdo->query("SELECT * FROM `users` WHERE `username` = ':username' and `passwordhash` = SHA2(CONCAT(':password', `salt`), 0)");
        $count = $pdo->query("SELECT * FROM `users` WHERE `email` = '$email'")->rowCount();

        debug_to_console($count);

        //return $query->fetchColumn() === 1;
        return $count === 0;
    }

    function checkIfUniqueUsername($username){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //$query = $pdo->query("SELECT * FROM `users` WHERE `username` = ':username' and `passwordhash` = SHA2(CONCAT(':password', `salt`), 0)");
        $count = $pdo->query("SELECT * FROM `users` WHERE `username` = '$username'")->rowCount();

        debug_to_console($count);

        //return $query->fetchColumn() === 1;
        return $count === 0;
    }

    function createNewUser($username, $password, $email, $birthday, $gender){

        $salt = '4b3403665fea6';

        $paswordhash = 'SHA2(CONCAT('.$password.', 4b3403665fea6), 0)';

        debug_to_console($username);
        debug_to_console($email);
        debug_to_console($birthday);
        debug_to_console($gender);
        debug_to_console($salt);
        debug_to_console($password);
        debug_to_console('SHA2(CONCAT('.$password.', 4b3403665fea6), 0)');

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //$query = $pdo->query("SELECT * FROM `users` WHERE `username` = ':username' and `passwordhash` = SHA2(CONCAT(':password', `salt`), 0)");
        $stmnt = $pdo->prepare("INSERT INTO users (username, email, birthday, gender, salt, passwordhash) 
        VALUES(?,?,?,?,?,?)");

        //$stmnt -> bindParam($username, $email, $birthday, $gender, $salt, 'SHA2(CONCAT('.$password.', 4b3403665fea6), 0)');

        $stmnt -> execute([$username, $email, $birthday, $gender, $salt, 'SHA2(CONCAT('.$password.', 4b3403665fea6), 0)']);

        //return $query->fetchColumn() === 1;
        return True;
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