<?php require 'loggedInCheck.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!--Set the viewport content (necessary to get CSS to display correctly on mobile), and attach the CSS in the header.-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/all.css">

		<script>
			function getUrlVars() {
				var vars = {};
				var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
					vars[key] = value;
				});
				return vars;
			}
			window.lat = parseFloat(getUrlVars()["lat"]);
			window.lng = parseFloat(getUrlVars()["lng"]);
			console.log(window.lat, window.lng)
		</script>
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
		<div class="box-xl">	
			<h2 class="h2">Scenic trail area 1 corner</h2><br>
			<img src="images/rating.png" class="rating-img"></img>&nbsp &nbsp &nbsp &nbsp &nbsp 8/10
			<br><br>

			<!--display a sample (hardcoded) image of the parking spot
			<img class="spot-photo" src="images/scenic-parking-lot.jpg"></img>-->

			<!--the ratings div consists of a series of headers-->
			<div id="ratings" class="ratings">
				<h3>Reviews</h3>
				<h5><u>larryQ: </u>Well sized spot, good for larger vehicles <br> as well.</h5>
				<h5><u>dShawn_95: </u>A bit too close to the trees during  <br> summer.</h5>
				<h5><u>BigBertha: </u>Worked for me</h5>
			</div>
			<h4 class="h4">Corner spot in Pinewood's Scenic Trail</h4>
			<div class="spot-photo" id="map"></div>
		</div>

		<script>
				// Initialize and add the map
				function initMap() {
					  // The location of Uluru
	
					  var spot = {lat: window.lat, lng: window.lng};
	
					  // The map, centered at Uluru
					  var map = new google.maps.Map(
						  document.getElementById('map'), {zoom: 20, center: spot});
	
					  // The marker, positioned at Uluru
					  var marker = new google.maps.Marker({position: spot, map: map});
				}
			</script>

		<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbP4svkwQIWh2S5TujdpOKLPI9plVj2s0&callback=initMap">
		</script>
	</body>
	<!--For now, the fotter will contain a contact link to a support email address-->
	<footer class="footer">
			<p class="footer-text">Contact us: <a href="rentals@findparking.com">
					rentals@findparking.com</a></p>
	</footer>
</html>