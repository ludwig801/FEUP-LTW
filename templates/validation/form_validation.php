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
		if(empty($data['pollTitle'])) {
			$errors[] = "The poll title is required.";
		} else if(strlen($data['pollTitle']) < 3) {
			$errors[] = "The poll title must have more than 3 characters.";
		}
		
		// Checks privacy settings.
		if(!isset($data['public'])) {
			$errors[] = "Choose a privacy setting.";
		} else if($data['public'] != '1' && $data['public'] != '0') {
			$errors[] = "Choose a privacy setting.";
		}
		
		// Check questions.
		if(!isset($data['question'])) {
			$errors[] = "There must be at least 1 question.";
		} else if(sizeof($data['question']) < 1) {
			$errors[] = "There must be at least 1 question.";
		} else {
		
			// Checks questions description.
			foreach($data['question'] as $quest) {
				if(empty($quest)) {
					$errors[] = "The question can't be empty.";
				}
				if(strlen($quest) < 2) {
					$errors[] = "Each question must have more than 1 character.";
				}
			}
		
			// Checks questions possible answers.
			if(isset($data['answer'])) {
			
				// Checks number of answers. 
				foreach($data['answer'] as $row) {
					if(sizeof($row) < 2) {
						$errors[] = "All questions must have at least 2 answers.";
					}
				}
					
				// Checks answers.
				foreach($data['answer'] as $i => $row) {
					if(empty($row)) {
						$errors[] = "The answers can't be empty.";
					}
					foreach($row as $ans) {
						if(strlen($ans) < 2) {
							$errors[] = "Each answer must have more than 1 character.";
						}
					}
				}
			} else {
				$errors[] = "No questions found.";
			}
		}
	
		return $errors;
	}
	
	function validatePollAnswerData($data) {
	
		$errors = array();
		
		if(!isset($data['answer'])) {
			$errors[] = "No answers choosen.";
		} else {
		
			if(!isset($data['id'])) {
				
				$errors[] = "Poll ID not found.";
			
			} else {
						
				foreach($data['answer'] as $row) {
					
					if(!isset($row)) {
						$errors[] = "Unknown error. Try again.";
					} 
				}
			}

		}
			
		return $errors;
		
	}
	
?>