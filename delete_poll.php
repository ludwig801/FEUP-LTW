<?php

	session_start();
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	
	$params = ['db' => $db, 'id' => $_GET['id']];
	deletePoll($params);

	$_SESSION['message'] = "Poll deleted successfully.";

	header('location: user.php');

?>