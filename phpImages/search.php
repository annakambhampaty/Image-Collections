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

   		<form action = "search.php" method="post">
                <p>Search: </p>
                <input type = "text" name = "searchInput" maxlength="150"/>
                 
                <input type="submit" name="search" value="Search">
           

		</div>



		<div id = column2>

		<?php 
            if(isset($_POST['search'])){

                require_once 'config.php';
			 	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

                 if ( $mysqli->errno ) {
                    print($mysqli->error);
                    exit();
                 }
                    

				else{

        
                    $searching = $_POST[ 'searchInput' ];
                  //  echo $searching;

                  

                //    move_uploaded_file($tempName, "images/$originalName" );
                  //  $addQuery = "INSERT INTO `images` (`imageID`, `title`, `date_created`, `date_modified`, `path`) VALUES (NULL, $title, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, $path)";

                   // $mysqli->query($addQuery);

                //  $phpquery =   "SELECT * FROM `info230_SP17_apk56sp17`.`albums` WHERE (CONVERT(`albumID` USING utf8) LIKE '%album%' OR CONVERT(`title` USING utf8) LIKE '%album%' OR CONVERT(`date_created` USING utf8) LIKE '%album%' OR CONVERT(`date_modified` USING utf8) LIKE '%album%')";



                    $phpquery = "SELECT * FROM `info230_SP17_apk56sp17`.`images` WHERE (CONVERT(`imageID` USING utf8) LIKE '%$searching%' OR CONVERT(`title` USING utf8) LIKE '%$searching%' OR CONVERT(`date_created` USING utf8) LIKE '%$searching%' OR CONVERT(`date_modified` USING utf8) LIKE '%$searching%' OR CONVERT(`path` USING utf8) LIKE '%$searching%')";

                    //echo $phpquery;
                    $result = $mysqli -> query($phpquery);


                    // if ( $mysqli->query($phpquery) ) {
                    //     echo "object added";
                    //  }

                   // $result = $mysqli -> query("SELECT imageID FROM images GROUP BY imageID");
                    // while ( $row = $result->fetch_assoc() ) {
                    //          $imageID = $row["imageID"]; 


                    // }

                     while ( $row = $result->fetch_assoc() ) {
                         
                         $path = $row["path"];
                         $imageID = $row["imageID"];

                       // echo '<input type="submit" name="search" value=<img class="display" src = $path alt="photo">><br>';

                    echo "
                        <button type='submit' name='info' value="."'".$imageID."' ". "><img src=". "'".$path ."' "."alt='photo'></button><br>

                        ";


                    }


                     $phpquery2 = "SELECT * FROM `info230_SP17_apk56sp17`.`albums` WHERE (CONVERT(`albumID` USING utf8) LIKE '%$searching%' OR CONVERT(`title` USING utf8) LIKE '%$searching%' OR CONVERT(`date_created` USING utf8) LIKE '%$searching%' OR CONVERT(`date_modified` USING utf8) LIKE '%$searching%')";


                     $result2 = $mysqli -> query($phpquery2);

                     while ( $row = $result2->fetch_assoc() ) {
                        $title = $row["title"];
                        $albumID = $row["albumID"];
                        $date_created = $row["date_created"];
                        $date_modified = $row["date_modified"];

                        echo "<a href=./second.php?Album=$albumID&displayAlbum=Show+Images>Title: " . $title ."</a><br>";
                        echo "Album ID: " .$albumID. "<br>";
                        echo "Date Created: " .$date_created. "<br>";
                        echo"Date Modified: " . $date_modified. "<br>";

                     }



                    
                }



            }
                require_once 'config.php';
                $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

                    if(isset($_POST['info'])){

                        $id = $_POST["info"];

                    

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