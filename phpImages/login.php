<!DOCTYPE HTML>
<html>

<head>
	 	<link rel = "stylesheet" href= "style/main.css" type = "text/css">
		<title>Assignment 3</title>
		<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i%7CPlayfair+Display" rel="stylesheet">


</head>


<body>



	<div class="main_container">

	 	 <?php
 	 		include "includes/header.php";
 	 	?>

		<div id = column1> 

			<?php
				if ( ! isset( $_POST['username'] ) && ! isset( $_POST['password'] ) ) {
			?>
			<h2>Log in</h2>

			<form action="login.php" method="post">
				Username: <input type="text" name="username"> <br>
				Password: <input type="password" name="password"> <br>
				<input type="submit" value="Submit">
			</form>

			<?php
			} 
			elseif ($_POST['username'] == "smohlke"&& $_POST['password'] == "mypassword") {
			?>
				<p>You have accessed the secret content of this page.</p>
			
			}
 	

		</div>
		

		<div id = column2>

		</div>
</div>




</body>
</html>