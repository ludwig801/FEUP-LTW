<?php
	
	include_once("form_validation.php");
	
	$description = $public = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$errors = validatePollData($_POST);
		
		// If everything went fine.
		if(sizeof($errors) == 0) {
			
			// Validates input data.
			$description = validateInput($_POST['description']);
			$public = validateInput($_POST['public']);
			
			// Prepares params.
			$params = ['db' => $db, 'id' => $_POST['id'], 'description' => $description, 'public' => $public, 'poll_id' => $_POST['poll_id'], 'answers' => $_POST['answers']];
			
			// Edits poll.
			editPoll($pollParams);
			deleteAllPollAnswers($params);
			addAllAnswers($params);
			
			$_SESSION['message'] = "Poll successfully edited.";

			header("location: user.php");
		}
	}

?>