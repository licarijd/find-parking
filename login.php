<?php
    include('auth.php'); 
    if (isset ($_POST ['login'])) {
        if (checkPassword($_POST['username-input'], $_POST['password-input'])){
            session_start();
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['username'] = $_POST['username-input'];
            header("Location: http://" . $_SERVER['HTTP_HOST']."/home.php");
        } else {
    
            echo ("Login failed");
            //header("Location: http://" . $_SERVER['HTTP_HOST']."/login.html");
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <!--Set the viewport content (necessary to get CSS to display correctly on mobile), and attach the CSS in the header.-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/all.css">
	</head>
	<!--The document body specifies elements visible to the user-->
	<body class="background">
		<!--<script>
			function setUsername(){
				localStorage.setItem("username", document.getElementById("username-input").value);
			}
		</script>-->
        <!--only username and password is required for login-->
		<form action="/login.php" method="post" class="box">
			<h2 class="h2">Enter your username and password</h2>
			<input type="text" class="input" id="username-input" name="username-input" placeholder="username" autocomplete="off">
			</br>
			<input type="text" class="input" id="password-input" name="password-input" placeholder="password" autocomplete="off">
			<br><br><br><br>
			<input type="submit" class="input-button" id="login" name="login" value="GO"></input>
		</form>
    </body>
	<!--For now, the fotter will contain a contact link to a support email address-->
	<footer class="footer">
			<p class="footer-text">Contact us: <a href="rentals@findparking.com">
					rentals@findparking.com</a></p>
	</footer>
</html>