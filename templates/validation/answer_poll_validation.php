<?php
	
	include_once("form_validation.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$errors = validatePollData($_POST);
		print_r($_POST);
		
		// If everything went fine.
		if(sizeof($errors) == 0) {
		
			$description = validateInput($_POST['pollTitle']);
			$public = validateInput($_POST['public']);
			
			$params = array('db' => $db, 'description' => $description, 'public' => $public, 'myid' => $_SESSION['myid'],  'questions' => $_POST['question'], 'answers' => $_POST['answer']);
				
			addPoll($params);
			
			$poll_id = getLastPollId($db);
			$params['poll_id'] = $poll_id;
			
			addQuestions($params);

			$_SESSION['message'] = "Poll successfully created.";

			header("location: user.php");
		} 
	}

?>