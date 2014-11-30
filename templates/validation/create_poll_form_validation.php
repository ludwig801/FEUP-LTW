<?php
	
	include_once("form_validation.php");
	
	$errors = array();
	$description = $public = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// Checks description.
		if(empty($_POST['description'])) {
			$errors[] = "The description is required.";
		} else if(strlen($_POST['description']) < 3) {
			$errors[] = "The description must have more than 3 characters.";
		} else {
			$description = validateInput($_POST['description']);
		}
		
		// Checks privacy settings.
		if(!isset($_POST['public'])) {
			$errors[] = "Choose a privacy setting.";
		} else if($_POST['public'] != '1' && $_POST['public'] != '0') {
			$errors[] = "Choose a privacy setting.";
		}
		else {
			$public = validateInput($_POST['public']);
			echo 'PUBLIC | ' . $public;
		}

		if(isset($_POST['answer'])) {
		
			// Checks number of answers. 
			if(sizeof($_POST['answer']) < 2) {
				$errors[] = "There must be at least 2 possible answers.";
			}
		
			// Checks answers.
			foreach($_POST['answer'] as $ans) {
				if(empty($ans)) {
					$errors[] = "The answers can't be empty.";
				}
				if(strlen($ans) < 2) {
					$errors[] = "Each answer must have more than 1 character.";
				}
			}

			// If everything went fine.
			if(sizeof($errors) == 0) {
				$pollParams = array('db' => $db, 'description' => $description, 'public' => $public, 'myid' => $_SESSION['myid']);
				addPoll($pollParams);
				
				foreach($_POST['answer'] as $ans) {
					$poll_id = getLastPollId($db);
					$ansParams = array('db' => $db, 'description' => $ans, 'poll_id' => $poll_id);
					addAnswer($ansParams);
				}

				$_SESSION['message'] = "Poll successfully created.";

				header("location: user.php");
			}
			
		} else {
			$errors[] = "There must be at least 2 possible answers.";
		}
	}

?>