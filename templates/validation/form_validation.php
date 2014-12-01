<?php	
	function validateInput($data) {
		// Strips unnecessary characters.
		$data = trim($data); 
		// Strips slashes.
		$data = stripslashes($data);
		// Converts special characters to HTML entities
		$data  = htmlspecialchars($data);
		return $data;
	}
	
	function validatePollData($data) {
	
		$errors = array();
	
		// Checks description.
		if(empty($data['description'])) {
			$errors[] = "The description is required.";
		} else if(strlen($data['description']) < 3) {
			$errors[] = "The description must have more than 3 characters.";
		}
		
		// Checks privacy settings.
		if(!isset($data['public'])) {
			$errors[] = "Choose a privacy setting.";
		} else if($data['public'] != '1' && $data['public'] != '0') {
			$errors[] = "Choose a privacy setting.";
		}

		if(isset($data['answer'])) {
		
			// Checks number of answers. 
			if(sizeof($data['answer']) < 2) {
				$errors[] = "There must be at least 2 possible answers.";
			}
			
			// Checks answers.
			foreach($data['answer'] as $ans) {
				if(empty($ans)) {
					$errors[] = "The answers can't be empty.";
				}
				if(strlen($ans) < 2) {
					$errors[] = "Each answer must have more than 1 character.";
				}
			}
			
		}
		
		return $errors;
	}
?>