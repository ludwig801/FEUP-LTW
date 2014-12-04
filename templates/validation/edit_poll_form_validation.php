<?php
	
	include_once("form_validation.php");
	
	$description = $public = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$errors = validatePollData($_POST);
		
		// If everything went fine.
		if(sizeof($errors) == 0) {
		
			// Validates input data.
			$description = validateInput($_POST['pollTitle']);
			$public = validateInput($_POST['public']);
			$poll_id = $_POST['poll_id'];
			
			// Prepares params.
			$params = ['db' => $db, 'id' => $_POST['poll_id'], 'description' => $description, 'public' => $public, 'poll_id' => $poll_id, 
				'questions' => $_POST['question'], 'answers' => $_POST['answer']];
			
			// Edits poll.
			editPoll($params);
			deleteAllPollQuestions($params);
			addQuestions($params);
			
			$_SESSION['message'] = "Poll successfully edited.";

			header("location: user.php");
		} 
	}

?>