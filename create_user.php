<?php
 
	include_once('database/connection.php');
	
	$stmt = $db->prepare('INSERT INTO users VALUES (NULL, :username, :name, :email, :password)');
	$stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
	$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
	$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
	$stmt->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
	
	$stmt->execute();
?>