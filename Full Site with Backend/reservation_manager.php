<?php
try {
    
    function checkIfAvailable($id){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*Check that the spot does not exist in the reserved table. 
        If it is not reserved, it is available*/
        $count = $pdo->query("SELECT * FROM `reserved` WHERE `id` = '$id'")->rowCount();

        debug_to_console($count);

        return $count === 0;
    }

    function checkIfNewSpot($lat, $lng){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*Make sure the submitted spot is new by checking that no entry in the database
         has an identical latitude and longitude*/
        $latCount = $pdo->query("SELECT * FROM `parkings` WHERE `lat` = '$lat'")->rowCount();
        $lngCount = $pdo->query("SELECT * FROM `parkings` WHERE `lng` = '$lat'")->rowCount();

        $count = $latCount + $lngCount;

        debug_to_console($count);
        
        return $count === 0;
    }

    function reserve($parkingID, $user){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Reserve a spot by marking it as reserved and setting the renter
        $stmt = $pdo->prepare("UPDATE parkings SET reserved = 1 WHERE id = '$id'");
        $stmt->bindValue('$id', $parkingID);
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE parkings SET renter = '$user' WHERE id = '$id'");
        $stmt->bindValue('$id', $parkingID);
        $stmt->execute();
        
        return True;
    }

    function release($parkingID){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Release a spot by unsetting the reserved amrker and the renter
        $stmt = $pdo->prepare("UPDATE parkings SET reserved = 0 WHERE id = '$id'");
        $stmt->bindValue('$id', $parkingID);
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE parkings SET renter = 'none' WHERE id = '$id'");
        $stmt->bindValue('$id', $parkingID);
        $stmt->execute();
        
        return True;
    }

    function addParkingSpot(/*$owner, */$name, $description, $price, $lat, $lng){

        $pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        ////Prepare an insert statement with 5 values - one for each parking spot attribute
        $stmnt = $pdo->prepare("INSERT INTO parkings (/*owner*/name, description, price, lat, lng) 
        VALUES(/*'$owner', */?,?,?,?,?)");

        //Execute the statement with data from the submission form
        $stmnt -> execute([$name, $description, $price, $lat, $lng]);

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