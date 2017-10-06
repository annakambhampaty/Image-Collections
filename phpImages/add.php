<?php session_start(); ?>
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

		<div ID = column1> 

		 <?php if(isset($_SESSION['logged_user'])){ ?>

		 	<h4> Add a new album! </h4>

			<form action = "add.php" method="post">

				Title:<br>
				<input type="text" name="title"><br>

	 	 		<input type ="submit" name = "addAlbum" value = "Add Album"> <br>
	
	 	  </form>

	 	          <h4>Choose an album to edit below</h4><br>


        <form method = "post">
            <?php
						require_once 'config.php';
			$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
            if($mysqli->connect_errno){
                printf("connection failed: %\n",$mysqli->connect_error);
                exit();
            }
            $result = $mysqli->query("SELECT * FROM albums");

            print("<select name='album'>");
            print("<option selected disabled>Select album to edit</option>");
            while($row = $result -> fetch_assoc()){
                $ID = $row['albumID'];
                $name = $row['title'];
                print("<option value ='$ID'>$name</option>");
            }
            print("</select>");

            ?>

            <input type = 'submit' name = 'submit' value='submit'><br><br>
        </form>






             <?php
        if(isset($_POST['submit'])){

            $albumID = filter_var($_POST['album'],FILTER_SANITIZE_STRING);

            if(empty($albumID)){
                echo '<h4>ERROR: Please select an album to edit</h4>';
                exit();
            }

            print("<br><br><h4>Edit Album Info</h4><br><form method = 'post'><select ID = 'secret' name= 'passID'><option value ='$albumID'>$albumID</option></select><input type = 'text' name = 'title1' class='title1' placeholder='New Title (optional)'><br><br><h4>Add Existing Image to Album (optional)</h4><br>");
           

          require_once 'config.php';
			$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
           
            $result = $mysqli->query("SELECT * FROM images");

            print("<select name = 'imageAdd'>");
            print("<option selected disabled>Select an image to add to this album</option>");

            while($row = $result-> fetch_assoc()){
                $name = $row['title'];
                $ID = $row['imageID'];
                print("<option value = '$ID'>$name</option>");
            }

            print("</select><br><br>");

            $result2 = $mysqli->query("SELECT * FROM imageInAlbum INNER JOIN images on imageInAlbum.imageID = images.imageID WHERE (imageInAlbum.albumID = {$albumID})");

            print("<h4>Remove an image from this album (optional)</h4><br>");
            print("<select name = 'imageRemove'>");
            print("<option selected disabled>Select an image to remove from this album</option>");

            while($row=$result2->fetch_assoc()){
                $name=$row['title'];
                $ID = $row['imageID'];
                print("<option value = '$ID'>$name</option>");
            }

            print("</select><br>");

            print("<h4>Delete Album?</h4>");
            print("<select name = 'deleteAlbum'>");
            print("<option selected disabled>No</option>");
            print("<option value = 'delete'>Yes/option>");
            print("</select><br>");

            print("<br><br><input type='submit' name ='submit2' value='submit'>");
            print("</form>");

        }

        ?>

        <?
        if(isset($_POST['submit2'])){
  
            $albumID = filter_var($_POST['passID'],FILTER_SANITIZE_STRING);
            $title = filter_var($_POST['title1'],FILTER_SANITIZE_STRING);
          //  $location = filter_var($_POST['location1'],FILTER_SANITIZE_STRING);

            if(isset($_POST['imageAdd'])){
             $imageAdd = $_POST['imageAdd'];
         	}

         	if(isset($_POST['imageRemove'])){
             $imageRemove = $_POST['imageRemove'];
         	}

         	if(isset($_POST['deleteAlbum'])){
             $deleteMe = $_POST['deleteAlbum'];
            }




			$date = date("Y/m/d h:m:s", strtotime("+4 hours"));
			$mysqli->query($date);



            if(!empty($title)){
                $update = $mysqli->query("UPDATE `albums` SET `title` = '{$title}' WHERE `albums`.`albumID` = $albumID;");
                print("<h4>Title updated.</h4>");
            }

  

            if(!empty($imageAdd)){

            	$imageAdd = $_POST['imageAdd'];
                $add = $mysqli->query("INSERT INTO `imageInAlbum` (`albumID`, `imageID`) VALUES ('{$albumID}', '{$imageAdd}');");
                print("<h4>Image added.</h4>");
            }

            if(!empty($imageRemove)){

            	$imageRemove = $_POST['imageRemove'];
                $remove = $mysqli->query("DELETE FROM `imageInAlbum` WHERE (imageInAlbum.albumID = {$albumID} AND imageInAlbum.imageID = {$imageRemove})");
                print("<h4>Image removed.</h4>");
            }

            if(!empty($deleteMe) && $deleteMe == 'delete'){

            	$deleteMe = $_POST['deleteAlbum'];
                $delte = $mysqli->query("DELETE FROM `imageInAlbum` WHERE (imageInAlbum.albumID = {$albumID})");
                $delete2 = $mysqli->query("DELETE FROM `albums` WHERE (albums.albumID = {$albumID})");

                print("<h4>Album deleted.</h4>");

            }

        }
        ?>













        <?
        if(isset($_POST['submit1'])){
            $title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
            $location = filter_var($_POST['location'],FILTER_SANITIZE_STRING);

            if(empty($title) || empty($location)){
                echo'<h4>ERROR: Please input all the information fields</h4>';
                exit();
            }

            if(strlen($title)<2 || strlen($location)<2){
                echo'<h4>ERROR: Minimum character count was not reached</h4>';
                exit();
            }

            if(strlen($title)>70 || strlen($location)>100){
                echo'<h4>ERROR: Maximum character count exceeded</h4>';
            }

require_once 'config.php';
			$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

            if($mysqli->connect_errno){
                printf("connection failed: %s\n",$mysqli->connect_error);
                exit();
            }

   

        }

        ?>






	 	 	<?php   }
        else{
           echo" <p>You must log in to add an album.</p>";
        }?>











		</div>







		<div ID = column2>


				<?php
	 	 			if(isset($_POST['addAlbum'])){




						$title = $_POST['title'];

						 $addQuery = "INSERT INTO `albums`(`title`) VALUES (' " . $title . " ')";

						require_once 'config.php';
				 		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

						 if ( $mysqli->errno ) {
				 			print($mysqli->error);
				 			exit();
				 		}

				 		else{
				 			$mysqli -> query($addQuery);

				 			echo "Album Added!"; //. $displayALL;
				 		}

					}
					// if(isset($_POST['editAlbum'])){

					// 	require_once 'config.php';
				 // 		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );


					// 	$albumID = $_POST['Album'];

					// 	if(isset($_POST['dateModEdit'])){


					// 	}
					// 	if(isset($_POST['dateCreatedEdit'])){


					// 	}
					// 	if(isset($_POST['titleEdit'])){

					// 	$quer = "UPDATE `albums` SET `title` = '$_POST['titleEdit']' WHERE `albums`.`albumID` = '$albumID'";

					// 	$mysqli -> query($quer);
					// 	echo $_POST['titleEdit'];




					// 	}



					// }

				?>
		


		</div>
</div>




</body>
</html>