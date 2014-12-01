<?php
	
	include_once("form_validation.php");
	
	$description = $public = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$errors = validatePollData($_POST);
		
		// If everything went fine.
		if(sizeof($errors) == 0) {
		
			$description = validateInput($_POST['description']);
			$public = validateInput($_POST['public']);
			
			$pollParams = array('db' => $db, 'description' => $description, 'public' => $public, 'myid' => $_SESSION['myid']);
			addPoll($pollParams);
			
			foreach($_POST['answer'] as $ans) {
				$poll_id = getLastPollId($db);
				$ansParams = array('db' => $db, 'description' => $ans, 'poll_id' => $poll_id);
				addAnswer($ansParams);
			}

			$_SESSION['message'] = "Poll successfully created.";

			header("location: user.php");
		} else {
			$errors[] = "There must be at least 2 possible answers.";
		}
	}

?>