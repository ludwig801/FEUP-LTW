<!-- Show errors -->
<?php 
	if(isset($errors)) {
		foreach($errors as $err) {
			echo "<p class='error'> * $err </p>";
		} 
	}
?>