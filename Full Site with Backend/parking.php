<?php require 'loggedInCheck.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!--Set the viewport content (necessary to get CSS to display correctly on mobile), and attach the CSS in the header.-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/all.css">

		<script>

			//Add the newly submitted review to the current page
			function insertReviewResponse() {
				if (this.status == 200) {
					response = JSON.parse(this.response);
					if (response.status == false) {
						document.getElementById("errorplaceholder").innerHTML = "<b>Error:</b> " + response.message;
					} else {
						document.getElementById("errorplaceholder").innerHTML = "Thank you!";
			   			document.getElementById("reviewform").innerHTML = "<p>Rating: " + response.rating + "</p>" + "<p>Review: " + response.review + "</p>";
					}
				}
			}

			//Open an XMLHttpRequest and submit the review
			function submitReviewForm() {
				request = new XMLHttpRequest();
				request.open("POST", "submit_review.php");
				request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request.onload = insertReviewResponse;
				request.send("rating=" + encodeURIComponent(document.getElementById("rating").value) + "&review=" + encodeURIComponent(document.getElementById("review").value));
			}
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
			<h2 id="title" class="h2"></h2><br>
			<img src="images/rating.png" class="rating-img"></img>&nbsp &nbsp &nbsp &nbsp &nbsp 8/10
			<br><br>

			<!--display a sample (hardcoded) image of the parking spot
			<img class="spot-photo" src="images/scenic-parking-lot.jpg"></img>-->

			<!--the ratings div consists of a series of headers-->
			<div id="ratings" class="ratings">
				<h3>Reviews</h3>
				
		<?php
		try {

				$pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$parking_id = htmlspecialchars($_GET["id"]);

				//Get all reviews attached to the current parking spot
				$result = $pdo->query("SELECT * FROM reviews WHERE `id` = '$id'");

				//Add a new HTML element for each review and render them to the page
				foreach ($result as $review) { 

                   $customer = $parking['customer'];
				   $value = $parking['value'];
				   $description = $parking['description'];

				   ?><h5><?=$parking['value']?><br><u><?=$parking['customer']?>: </u><?=$parking['description']?></h5><?php               
				}

		} catch (PDOException $e) {
				echo $e->getMessage();
		}
		?>
		
			</div>
			<div id="reviewform" style="position:fixed;left:55%;top:57%;">
				Rating:<input id="rating" name="rating" type="number" min="1" max="5"></input><br>
				Review:<input id="review" name="review" type="text"></input>
				<button onclick="submitReviewForm()">submit</button>
				<!--<textarea id="errorplaceholder"></textarea>-->
			</div>
			<h4 id="title2" class="h4"></h4>
			<script>
				
			//Get variables from the url 
			function getUrlVars() {
				var vars = {};
				var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
					vars[key] = value;
				});
				return vars;
			}

			//URL variables will be used to plot the map
			window.lat = parseFloat(getUrlVars()["lat"]);
			window.lng = parseFloat(getUrlVars()["lng"]);

			document.getElementById("title").innerHTML = decodeURI(getUrlVars()["name"]);
			document.getElementById("title2").innerHTML = decodeURI(getUrlVars()["name"]);

			console.log(window.lat, window.lng, getUrlVars()["name"])
			</script>
			<div class="spot-photo" id="map"></div>
		</div>
		<script>
				// Initialize and add the map
				function initMap() {
	
					  //Create coordinate using lat and lng url variables
					  var spot = {lat: window.lat, lng: window.lng};
	
					  // The map, centered at the parking spot
					  var map = new google.maps.Map(
						  document.getElementById('map'), {zoom: 20, center: spot});
	
					  // Set a marker at the parking spot
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