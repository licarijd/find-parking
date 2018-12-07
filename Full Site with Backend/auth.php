<?php
try {
    
    function checkPassword($username, $password){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       //Check that an entry exists in the database which contains the username and password
        $count = $pdo->query("SELECT * FROM `users` WHERE `username` = '$username' and `passwordhash` = SHA2(CONCAT('$password', `salt`), 0)")->rowCount();

        debug_to_console($count);

        //If there is, return true - the user exists
        return $count === 1;
    }

    /*Make sure an entry does not exist in the database with the entered email.
    This is used by the register page, as we want each user to have a unique email address*/
    function checkIfNewUser($email){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $count = $pdo->query("SELECT * FROM `users` WHERE `email` = '$email'")->rowCount();

        debug_to_console($count);

        return $count === 0;
    }

    /*Make sure an entry does not exist in the database with the entered username.
    This is used by the register page, as we want each user to have a unique username*/
    function checkIfUniqueUsername($username){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $count = $pdo->query("SELECT * FROM `users` WHERE `username` = '$username'")->rowCount();

        debug_to_console($count);

       return $count === 0;
    }

    function createNewUser($username, $password, $email, $birthday, $gender){

        //Password is hashed using salt
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

        //Prepare an insert statement with 6 values for each of the user's attributes
        $stmnt = $pdo->prepare("INSERT INTO users (username, email, birthday, gender, salt, passwordhash) 
        VALUES(?,?,?,?,?,?)");

        //Execute the statement with the entries from the register form
        $stmnt -> execute([$username, $email, $birthday, $gender, $salt, 'SHA2(CONCAT('.$password.', 4b3403665fea6), 0)']);

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