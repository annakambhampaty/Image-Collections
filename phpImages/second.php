<!DOCTYPE HTML>
<html>

<head>
	 	<link rel = "stylesheet" href= "style/main.css" type = "text/css">
		<title>Assignment 1</title>
		<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i%7CPlayfair+Display" rel="stylesheet">


</head>


<body>



	<div class="main_container">

	 	 <?php
 	 		include "includes/header.php";
 	 	?>

		<div id = column1> 

		<form action = "second.php" method="get">

		<select name = "Album">
		 	 <?php
		 	 	

		 	  	require_once 'config.php';
				 $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

				 if ( $mysqli->errno ) {
				 	print($mysqli->error);
				 	exit();
				 }

				 else{

				 	$result = $mysqli -> query("SELECT * FROM albums");
				 	while ( $row = $result->fetch_assoc() ) {
				 		$title = $row["title"];		
				 		$albumID = $row["albumID"];			   				
	   				
				 		echo "<option value = " . $albumID . "> " . $title . "</option> ";
				
				 	}
				
				 }
				echo "</select>";

 	 		?>

 	 		<input type ="submit" name = "displayAlbum" value = "Show Images">

 	

		</div>
		

		<div id = column2>
		<?php

			//   if ( $mysqli->errno ) {
			//    print($mysqli->error);
			//   exit();
			// }

			//  else{

		$albumExists= false;

				if(isset($_GET['displayAlbum'])){

					$alb = $_GET['Album'];


					//checking to see if parameter is an integer 
					if(is_numeric( $alb)== false){
						echo "Sorry, the value you entered is not a valid Album ID. Please enter an integer value.";

					}

					//check to see if parameter corresponds to an existing album

					

					else{
					
						$checker = $mysqli -> query("SELECT albumID FROM albums");


						

						while ( $row = $checker->fetch_assoc() ) {
					 		$ID = $row["albumID"];		
					 		if($ID == $alb){
					 			$albumExists = true;
					 		}
					
					 	}
						 if ($albumExists==false) {
							echo "Sorry, the value you entered does not correspond to an existing album. Please try again.";
						}
					}
					

					//else, value is valid (an integer that corresponds to an existing album ID), continue w code and display album

					if($albumExists==true){

						$checkLength = $mysqli -> query("SELECT * FROM images INNER JOIN imageInAlbum ON images.imageID = imageInAlbum.imageID INNER JOIN albums ON albums.albumID = imageInAlbum.albumID WHERE albums.albumID = $alb");

						$i = 0;

						while ( $row = $checkLength->fetch_assoc() ) {
							$i++;

						}

						if($i==0){
				while ( $row = $checkLength->fetch_assoc() ) {
						$title = $row["title"];
						$albumID = $row["albumID"];
						$date_created = $row["date_created"];
						$date_modified = $row["date_modified"];

					}

					echo "Title: " . $title ."<br>";
						echo "Album ID: " .$albumID. "<br>";
					//	echo "Date Created: " .$date_created. "<br>";
					//	echo"Date Modified: " . $date_modified. "<br>";
							echo "Sorry, this album has no images!";
						}

						else{



						$result = $mysqli -> query("SELECT * FROM images INNER JOIN imageInAlbum ON images.imageID = imageInAlbum.imageID INNER JOIN albums ON albums.albumID = imageInAlbum.albumID
							WHERE albums.albumID = $alb");


				$otherstuff = $mysqli -> query("SELECT * FROM images INNER JOIN imageInAlbum ON images.imageID = imageInAlbum.imageID INNER JOIN albums ON albums.albumID = imageInAlbum.albumID
								WHERE albums.albumID = $alb");

						$title;
						$albumID;
						$date_created;
						$date_modified;

					while ( $row = $otherstuff->fetch_assoc() ) {
						$title = $row["title"];
						$albumID = $row["albumID"];
						$date_created = $row["date_created"];
						$date_modified = $row["date_modified"];

					}

						echo "Title: " . $title ."<br>";
						echo "Album ID: " .$albumID. "<br>";
						echo "Date Created: " .$date_created. "<br>";
						echo"Date Modified: " . $date_modified. "<br>";
				

					   // $result = $mysqli -> query("SELECT * FROM images");

					   while ( $row = $result->fetch_assoc() ) {
					     $path = $row["path"];
                         $imageID = $row["imageID"];

						echo "
                        <button type='submit' name='info' value="."'".$imageID."' ". "><img src=". "'".$path ."' "."alt='photo'></button><br>";
					     // echo '<a href = second.php?imageID=';
					     // echo $row["imageID"];
					     // echo '>';
					     // echo "<img class='display' src=". "'".$path ."' "."alt='photo'><br>";
					     // echo '</a>';




						}


					}
				}
					
			}

//		}
			             require_once 'config.php';
                $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

                    if(isset($_GET['info'])){

                        $id = $_GET["info"];

                    

                        $infoResult =  $mysqli->query("SELECT * FROM `info230_SP17_apk56sp17`.`images` WHERE (CONVERT(`imageID` USING utf8) LIKE '$id')");
                        while ( $row = $infoResult->fetch_assoc() ){
                            $imageID = $row["imageID"];
                            $file_path = $row["path"];
                            $created = $row["date_created"];
                              $modified = $row["date_modified"];
                            $caption = $row["title"];

                            echo "image ID: " .$imageID. "<br>";
                            echo "Date Created: " . $created . "<br>";
                            echo "Date Modified: " . $modified. "<br>";

                            echo "Title: " . $caption . "<br>";

                            echo "<div id = imageColumn>";

                            echo "<img src=". "'".$file_path ."' "."alt='photo'>";
                            echo "</div>";

                    }

                    }

 		?> 

 	</form>
		</div>
</div>




</body>
</html>