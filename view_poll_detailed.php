<?php
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/poll_answers.php');
	include_once('database/answers.php');
	include_once('database/questions.php');
	
	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');
	
	$poll_id = $_GET['id'];
	
	include_once('templates/validation/view_poll_detailed_validation.php');
	
	$params = array('db' => $db, 'poll_id' => $poll_id, 'user_id' => $_SESSION['myid']);
	
	$errors = validateDetailedView($params);
	
	print_r($errors);
	
	if(sizeof($errors) > 0) {
		//header("location: user.php");
	}
	else {
		$poll = getPollById($params);
		$questions = getPollQuestions($params);
		$answers = array();
		$poll_answers = array();
	}
?>
			