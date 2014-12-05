<?php
	
	include_once("form_validation.php");
	include_once('database/questions.php');
	include_once('database/answers.php');
	include_once('templates/token.php');
	
	$description = $public = "";
	
				include_once('upload.php');
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$errors = validatePollData($_POST);
		
		// If everything went fine.
		if(sizeof($errors) == 0) {
		
			$description = validateInput($_POST['pollTitle']);
			$public = validateInput($_POST['public']);
			$token = newToken(6);
			
			$params = array('db' => $db, 'description' => $description, 'public' => $public, 'myid' => $_SESSION['myid'],  'questions' => $_POST['question'], 'answers' => $_POST['answer'], 
								'token' => $token);

			addPoll($params);
			
			$poll_id = getLastPollId($db);
			$params['poll_id'] = $poll_id;
			
			addQuestions($params);

			$_SESSION['message'] = "Poll successfully created.";
			
			include_once('upload.php');

			header("location: user.php");
		}
		else {
			//header("location: user.php");
		}
	}

?>