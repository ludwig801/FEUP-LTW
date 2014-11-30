<?php
	
	include_once('database/connection.php');
	include_once('database/answers.php');
	include_once('database/polls.php');
	
	// Checks if an user is logged in.
	include('lock.php');
	
	// Checks if there was a POST and validates it.
	include_once('templates/validation/create_poll_form_validation.php');
	
	// include('upload.php');
	
	include('templates/header.php');
	include('templates/navbar.php');
	
	$_GET['type'] = 'Create';
	include('templates/editor/create_poll_editor.php');
	
	include('templates/footer.php');

?>

