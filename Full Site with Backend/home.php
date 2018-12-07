<?php require 'loggedInCheck.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!--Set the viewport content (necessary to get CSS to display correctly on mobile), and attach the CSS in the header.-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="css/all.css">
	</head>
	<!--The header contains 4 buttons - home, which will return users to home.html, account to access an account page, and saved/favorites pages for parking spots (I will add/modify these depending on assignment 2 requirements)-->

    <header class="header">
        <script>
            function home(){
                location.href = "home.php";
            }

            function logout(){
                location.href = "logout.php";
            }

            function search(){
                location.href = "search.php";
            }

            function submission(){
                location.href = "submission.php";
            }
        </script>
		<input class="home-button" onclick="home()" type="image" src="images/home.png"/>
		<input class="account-button" onclick="logout()" type="image" src="images/logout.png"/>
		<!--<input class="saved-button" type="image" src="images/saved.png"/>
		<input class="fav-button" type="image" src="images/fav.png"/>-->
	</header>
	<!--The document body specifies elements visible to the user-->
	<body class="background">
		<button class="input-button-large" onclick="search()" id="find-btn">Find Parking Spots</button></body>
		<button class="input-button-large" onclick="submission()" id="rent-btn">Rent Your Parking Spot Spots</button>
	</body>
	<!--For now, the fotter will contain a contact link to a support email address-->
	<footer class="footer">
			<p class="footer-text">Contact us: <a href="rentals@findparking.com">
					rentals@findparking.com</a></p>
	</footer>
</html>