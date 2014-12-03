<?php
	
	include_once("form_validation.php");
	include_once('database/questions.php');
	include_once('database/answers.php');
	
	$description = $public = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$errors = validatePollData($_POST);
		
		// If everything went fine.
		if(sizeof($errors) == 0) {
		
			$description = validateInput($_POST['pollTitle']);
			$public = validateInput($_POST['public']);
			$poll_id = getLastPollId($db);
			
			$params = array('db' => $db, 'description' => $description, 'public' => $public, 'myid' => $_SESSION['myid'], 'poll_id' => $poll_id, 
				'questions' => $_POST['question'], 'answers' => $_POST['answer']);
				
			addPoll($params);
			addQuestions($params);

			$_SESSION['message'] = "Poll successfully created.";

			header("location: user.php");
		} 
	}

?>