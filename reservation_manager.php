<?php
try {
    
    function checkIfAvailable($id){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //$query = $pdo->query("SELECT * FROM `users` WHERE `username` = ':username' and `passwordhash` = SHA2(CONCAT(':password', `salt`), 0)");
        $count = $pdo->query("SELECT * FROM `reserved` WHERE `id` = '$id'")->rowCount();

        debug_to_console($count);

        //return $query->fetchColumn() === 1;
        return $count === 0;
    }

    function checkIfNewSpot($lat, $lng){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //$query = $pdo->query("SELECT * FROM `users` WHERE `username` = ':username' and `passwordhash` = SHA2(CONCAT(':password', `salt`), 0)");
        $latCount = $pdo->query("SELECT * FROM `parkings` WHERE `lat` = '$lat'")->rowCount();
        $lngCount = $pdo->query("SELECT * FROM `parkings` WHERE `lng` = '$lat'")->rowCount();

        $count = $latCount + $lngCount;

        debug_to_console($count);

        //return $query->fetchColumn() === 1;
        return $count === 0;
    }

    function reserve($parkingID, $user){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE parkings SET reserved = 1 WHERE id = '$id'");
        $stmt->bindValue('$id', $parkingID);
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE parkings SET renter = '$user' WHERE id = '$id'");
        $stmt->bindValue('$id', $parkingID);
        $stmt->execute();

        //return $query->fetchColumn() === 1;
        return True;
    }

    function release($parkingID){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE parkings SET reserved = 0 WHERE id = '$id'");
        $stmt->bindValue('$id', $parkingID);
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE parkings SET renter = 'none' WHERE id = '$id'");
        $stmt->bindValue('$id', $parkingID);
        $stmt->execute();

        //return $query->fetchColumn() === 1;
        return True;
    }

    function addParkingSpot(/*$owner, */$name, $description, $price, $lat, $lng){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //$query = $pdo->query("SELECT * FROM `users` WHERE `username` = ':username' and `passwordhash` = SHA2(CONCAT(':password', `salt`), 0)");
        $stmnt = $pdo->prepare("INSERT INTO parkings (/*owner*/name, description, price, lat, lng) 
        VALUES(/*'$owner', */?,?,?,?,?)");

        $stmnt -> execute([$name, $description, $price, $lat, $lng]);

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