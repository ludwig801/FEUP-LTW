<?php
	
	session_start();
	session_unset();
	session_destroy();
	
	if(isset($_GET['signup']) && ($_GET['signup'] == 'true')) {
		header("location: signup.php");
	}
	else {
		header("location: index.php");
	}
?>