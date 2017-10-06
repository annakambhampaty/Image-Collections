<!DOCTYPE HTML>
<html>

<head>
	 	<link rel = "stylesheet" href= "style/main.css" type = "text/css">
		<title>Assignment 1</title>
		<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i%7CPlayfair+Display" rel="stylesheet">


</head>


<body>
 	 
 	 <?php
 	 	include "includes/header.php";
 	 ?>


	<div id = "column2"> 

		<form method="POST" action="contact.php"> 

		Name:<br>
		<input type="text" name="name"><br>

		E-mail:<br>
		<input type="text" name="mail"><br>

		Comment:<br>
		<input type="text" name="comment" size="50"><br><br>

		<input type="submit" name= "submit" value="Send">
		<input type="reset" value="Reset">
		</form>

		<?php



		if( isset($_POST["submit"])) {
				$to = "annakambhampaty@gmail.com";
				$subject = "Message from " . $_POST["name"] . " " . $_POST["mail"];
				$txt = $_POST["comment"];
			//	$headers = $_POST["mail"] . "\r\n" .
				mail($to,$subject,$txt);
				echo "<p>Thank you for reaching out, " . $_POST["name"]."! The following message was sent: $txt</p>";

		}


		
		?>


	</div>

	<div id = "column1"> 

			<p class = "para1"> Want us to photograph your event? Want to work with us? Any other random musings or questions?! Feel free to reach out!</p>


	</div>



</body>
</html>