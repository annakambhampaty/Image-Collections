<?php session_start(); 
 $username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
$password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );?>
 <!DOCTYPE HTML>
<html>

<head>
	 	<link rel = "stylesheet" href= "style/main.css" type = "text/css">
		<title>Assignment 1</title>
		<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i%7CPlayfair+Display" rel="stylesheet">
		    <script src="js/main.js"></script>


</head>


<body>
 
 
 	 <?php
 	 	include "includes/header.php";



 	 ?>

	<div class="main_container">

		<div id = column1> 
			<p class = "para1"> Welcome to project 3!</p>

			<p class = "para1"> To view the album and images in the database, click on the <span class="nav_item"><a href="./second.php">album</a></span> page. </p>



			

		</div>

		<div id="column2">


		
		 <?php

			

			 if ( !isset($_SESSION[ 'logged_user' ])&& (empty( $username ) || empty( $password )) ) {

			 // 	echo"
			 // <form action='index.php' method='post'>
				// Username: <input type='text' name='username'> <br>
			 // 	Password: <input type='password' name='password'> <br>
			 // 	<input type='submit' value='Submit'>
			 // </form>";


		//	if(isset($_POST['username']) && isset($_POST['password'])) {

				echo"
			 <form action='index.php' method='post'>
				Username: <input type='text' name='username'> <br>
			 	Password: <input type='password' name='password'> <br>
			 	<input type='submit' value='Submit'>
			 </form>";

			}
				//$username= $_POST['username'];
				//$password =$_POST['password'];
				

				//$hashedPassword = password_hash("helloWorld",  PASSWORD_DEFAULT);
				//echo $password;

			//	$valid_password = password_verify( $password, $hashedPassword);
else{
				require_once 'config.php';
				$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

				$checker = true;

		
				 $result = $mysqli -> query("SELECT * FROM `login` WHERE 1");
				 while ( $row = $result->fetch_assoc() ) {

				 	$usernameCheck = $row["username"];		
				 	$passwordCheck = $row["password"];

				 	$valid_password = password_verify( $password, $passwordCheck);		
	   			
			 		if($usernameCheck!=$username){$checker=false;}
			 		if(!$valid_password){$checker=false;}
				
				 }
				if ($checker==true) {

					echo "<p>You are logged in!<p>";

					$_SESSION[ 'logged_user' ] = $username;

				} else {
						

						if(!isset($_SESSION[ 'logged_user' ])&& !isset($_POST['logout'])){

					echo "Wrong information";
				//	echo ‘<p>You did not login successfully.</p>’;
					echo "<p>Please <a href='./index.php'>login</a></p>";

				}

				}


}

		if(isset($_SESSION[ 'logged_user' ])) {

			 if(!isset($_POST['logout'])){
				echo"
			 <form action='index.php' method='post'>
			 	<input type='submit' value='logout' name='logout'>
			 </form>";
			}

			 if(isset($_POST['logout'])){
			 	unset($_SESSION[ 'logged_user' ]);
			 	unset($_SESSION);
			 	$_SESSION = array();
			 	session_destroy();
			 	echo "You are logged out!";
			 	echo "<p>Please <a href='./index.php'>login</a></p>";
			 }
			}
 	 	
		?>




		</div>

	</div>


</body>
</html>