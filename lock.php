<?php 
	
	include_once('database/connection.php');
	include_once('database/users.php');

	session_start();
	
	if(!isset($_SESSION['guest'])) {
		$user_check = $_SESSION['myusername'];
		
		$params = array('db' => $db, 'username' => $user_check);
		$result = getUserByUsername($params);
		$count = count($result);
		
		if($count != 1) {
			header("location: signin.php");
		} 
	}

?>