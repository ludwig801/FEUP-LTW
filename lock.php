<?php 
	
	include_once('database/connection.php');

	session_start();

	$user_check = $_SESSION['myusername'];

	echo $_SESSION['myusername'];

	$stmt = $db->prepare("SELECT username FROM users WHERE username = '$user_check'");
	$stmt->execute();
	$result = $stmt->fetchAll();

	$count = count($result);

	echo $count;

	if($count != 1) {
		header("location: login.php");
	} 

?>