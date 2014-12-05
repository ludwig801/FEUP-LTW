<?php

	include_once('templates/validation/form_validation.php');
	include_once('database/users.php');

	$id = $name = $email = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$errors = validateUserData($_POST);

		if(sizeof($errors) == 0) {
			
			$id = $_POST['id'];
			$name = validateInput($_POST['name']);
			$email = $_POST['email'];
			
			$params = array('db' => $db, 'id' => $id, 'name' => $name, 'email' => $email);
			editUser($params);
			
			$_SESSION['message'] = "User profile successfully edited.";
			header("location: user_page.php");
			
		}
	}

?>