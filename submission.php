<?php
    include('reservation_manager.php'); 
    if (isset ($_POST ['submission'])) {
        if (checkIfNewSpot($_POST['lat-input'], $_POST['lng-input'])){
            addParkingSpot(/*$owner, */$_POST['name-input'], $_POST['description-input'], $_POST['price-input'], $_POST['lat-input'], $_POST['lng-input']);
        } else {
                echo ("Spot is already registered");
        }
    //} else {
    
       // echo ("Register not posted!");
            //header("Location: http://" . $_SERVER['HTTP_HOST']."/login.html");
   // }
   } 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="css/all.css">
	</head>
	<header class="header">
		
    <input class="home-button" onclick="home()" type="image" src="images/home.png"/>
    <input class="account-button" onclick="logout()" type="image" src="images/logout.png"/>
        <script>
        function home(){
            location.href = "home.php";
        }

        function logout(){
            location.href = "logout.php";
        }
    </script>
	</header>
	<body class="background">

			<script>

					/*validation function checks if form input matches the regular expressions for the given value
					if form input does not match the regular expression for that input, a window alert will appear and
					the user will be prompted to re enter input*/
			
					function validate(form) {

						if (form.name){
							if(!(/^([a-zA-Z0-9]{3,20})+$/.test(form.name.value))){

								alert("Name must be between 3 and 20 characters, and can consist of numbers and letters");
								return false;
							}
						}

						if (form.description){
							if(!(/^(.{8,20})+$/.test(form.description.value))){

								alert("Description must be between 8 and 20 characters");
								return false;
							}
						}
			
						if (form.price){
							if(!/^\d+(?:\.\d{0,2})?$/.test(form.price.value)){
			
								alert("Please give a price in CAD");
								return false;
							}
						}
			
						if (form.lat){
							if(!/^\d{0,50}(?:\.\d{0,50})?$/.test(form.lat.value)){
			
								alert("Please give a latitude numerical value");
								return false;
							}
						}
			
						if (form.lng){
							if(!/^\d{0,50}(?:\.\d{0,50})?$/.test(form.lng.value)){
			
								alert("Please give a longitude numerical value");
								return false;
							}
						}

						//If each input passes regex tests, return true
						return true;
					}
					</script>

		<div class="box-large">
		<h2 class="h2">Submit Your Spot for Rental</h2>
		<form  action="/submission.php" method="post" onsubmit="return validate(this);"> 
			<input type="text" class="input" id="name-input" name="name-input" placeholder="Name" autocomplete="off">
			<input type="text" class="input" id="description-input" name="description-input" placeholder="Description" autocomplete="off">
			<input type="text" class="input" id="price-input" placeholder="Price (CAD)" name="price-input" autocomplete="off">
			<input type="text" class="input" id="lat-input" placeholder="Latitude" name="lat-input" autocomplete="off">
			<input type="text" class="input" id="lng-input" placeholder="Longitude" name="lng-input" autocomplete="off">
			<h4 class="h2">Please upload a picture of the spot:</h4>
			<input class="file-upload" type="file" name="pic" accept="image/*">
			<br><br>
			<input class="input-button" id="submission" name="submission" type="submit" value="GO"/>
		</form>
		</div>
	</body>
	<footer class="footer">
			<p class="footer-text">Contact us: <a href="rentals@findparking.com">
					rentals@findparking.com</a></p>
	</footer>
</html>