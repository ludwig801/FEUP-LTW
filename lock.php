<?php 
	
	include_once('database/connection.php');
	include_once('database/users.php');

	session_start();

	$user_check = $_SESSION['myusername'];
	
	$params = array('db' => $db, 'username' => $user_check);
	$result = getUserByUsername($params);
	$count = count($result);
	
	if($count != 1) {
		header("location: signin.php");
	} 

?>