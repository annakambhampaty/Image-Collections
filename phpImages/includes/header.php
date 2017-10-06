
<div id="nav">
	<?php

		$links = array(
		        "Home" => "./index.php",
		        "View Albums" => "./second.php",     
		        "Add/Edit Albums" => "./add.php",
		        "Add/Edit Images" => "./addimage.php",
		        "Search" => "./search.php"

		    );



		foreach($links as $x => $x_value) {
			echo("<span class='nav_item'><a href='$x_value'>$x</a></span> ");

		};

	?>
</div>