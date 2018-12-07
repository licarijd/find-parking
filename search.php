
<?php require 'loggedInCheck.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!--Set the viewport content (necessary to get CSS to display correctly on mobile), and attach the CSS in the header.-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/all.css">
		<script>
				function home(){
					location.href = "home.php";
				}
		
				function logout(){
					location.href = "logout.php";
				}
			</script>
	</head>
	<!--The header contains 4 buttons - home, which will return users to home.html, account to access an account page, and saved/favorites pages for parking spots (I will add/modify these depending on assignment 2 requirements)-->
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
	<!--The document body specifies elements visible to the user-->
	<body class="background">
		<div class="box-medium">
				<script>
					//Get location and set the latitude and longitude as cookies to be used by results.html
					function getLocation(){
						navigator.geolocation.getCurrentPosition(function(position) {
							console.log(position.coords.latitude, position.coords.longitude);

							localStorage.setItem("lat", position.coords.latitude);
							localStorage.setItem("lng", position.coords.longitude);
							localStorage.setItem("distance", document.getElementById("dist-input").value);
							
							location.href = "results.php";
						  });
						}
					</script>
			<!--regular text input is used to allow search cirteria to be entered-->
			<form>
				<h2 class="h2">Find Parking Spots for Rental</h2>
				<input type="text" class="input" id="dist-input" placeholder="Distance" autocomplete="off"></br>
				<input type="text" class="input" id="price-input" placeholder="Price" autocomplete="off"></br>
				<input type="text" class="input" id="rating-input" placeholder="Rating" autocomplete="off"></br>
				<br><br>
			</form>
			<button onclick="getLocation()" class="input-button" id="search-btn">Search</button>
		</div>
	</body>
	<!--For now, the fotter will contain a contact link to a support email address-->
	<footer class="footer">
			<p class="footer-text">Contact us: <a href="rentals@findparking.com">
					rentals@findparking.com</a></p>
	</footer>
</html>