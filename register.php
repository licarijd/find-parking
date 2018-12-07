<?php
    include('auth.php'); 
    if (isset ($_POST ['register'])) {
        if (checkIfNewUser($_POST['email-input'])){
            if (checkIfUniqueUsername($_POST['username-input'])){
                if (createNewUser($_POST['username-input'], $_POST['password-input'], $_POST['email-input'], $_POST['birthday-input'], $_POST['gender-input'])){
                    
                    session_start();
                    $_SESSION['isLoggedIn'] = true;
					$_SESSION['username'] = $_POST['username-input'];
                    header("Location: http://" . $_SERVER['HTTP_HOST']."/home.php");
                }
            } else {
                echo ("The username you entered is already tied to an existing account!");
            }
        } else {
                echo ("The email you entered is already tied to an existing account!");
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
		<!--Set the viewport content (necessary to get CSS to display correctly on mobile), and attach the CSS in the header.-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/all.css">
	</head>
	<!--The header contains 4 buttons - home, which will return users to home.html, account to access an account page, and saved/favorites pages for parking spots (I will add/modify these depending on assignment 2 requirements)-->

	<!--The document body specifies elements visible to the user-->
	<body class="background">

		<script>

		/*validation function checks if form input matches the regular expressions for the given value
		if form input does not match the regular expression for that input, a window alert will appear and
		the user will be prompted to re enter input*/

		function validate(form) {

			if (form.username){
				if(!(/^([a-zA-Z0-9]{4,20})+$/.test(form.username.value))){

					alert("Username must be between 4 and 20 characters, and consist of numbers and letters");
					return false;
				}
			}

			if (form.password){
				if(!(/^([a-zA-Z0-9]{8,20})+$/.test(form.password.value))){

					alert("Password must be between 8 and 20 characters, and consist of numbers and letters");
					return false;
				}
			}

			if (form.email){
				if(!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/.test(form.email.value))){

					alert("Please enter a valid email address");
					return false;
				}
			}

			if(form.birthday){
				if(!(/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/g.test(form.birthday.value))){

					alert("Please enter your date of birth in the form yyyy-mm-dd");
					return false;
				}
			}

			//localStorage.setItem("username", document.getElementById("username-input").value);

			//If each input passes regex tests, return true
			return true;
		}
		</script>

		<div class="box-register">

			<!--input form consists of 4 types of input (text, email, date to specify birthday, and radio buttons to allow gender selection)-->
			<form action="/register.php" method="post" onsubmit="return validate(this);">
				<h2 class="h2">Please choose a username and password</h2>
				<input type="text" class="input" id="username-input" placeholder="choose a username" name="username-input" autocomplete="off">
				</br>
				<input type="text" class="input" id="password-input" placeholder="choose a password" name="password-input" autocomplete="off">
				</br>
				<input type="email" class="input" id="email-input" placeholder="enter your email" name="email-input" autocomplete="off">
				<br><br>
				<p class="h2">Birthday:</p>
				<input type="date" class="input-2" id="birthday-input" name="birthday-input" value="2018-07-22" min="1900-01-01" max="2018-12-31" />
			   	<br><br>
			   	<p class="h2">Gender:</p>
			   	<div class="gender" name="gender">
					<input type="radio" name="gender-input" id="gender-input" value="male" checked> Male<br>
					<input type="radio" name="female" value="female"> Female<br>
					<input type="radio" name="gender" value="other"> Other
				</div>
				<br>
				<input class="input-button" id="register" name="register" type="submit" value="GO"/>
			</form>
			<br>
		</div>
	</body>
	<!--For now, the fotter will contain a contact link to a support email address-->
	<footer class="footer">
			<p class="footer-text">Contact us: <a href="rentals@findparking.com">
					rentals@findparking.com</a></p>
	</footer>
</html>