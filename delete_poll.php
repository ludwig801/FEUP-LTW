<?php

	session_start();
	
	include_once('database/connection.php');
	$stmt = $db->prepare('DELETE FROM polls WHERE id = :id');
	$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
	$stmt->execute();

	$_SESSION['message'] = "Poll deleted successfully.";

	header('location: user.php');

?>