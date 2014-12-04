<?php
	
	include_once("form_validation.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$errors = validatePollAnswerData($_POST);
		

		
		// If everything went fine.
		if(sizeof($errors) == 0) {

			foreach($_POST['answer'] as $row) {
				$params = array('db' => $db, 'poll_id' => $_POST['id'], 'user_id' => $_POST['user_id'], 'answer_id' => $row);
				addPollAnswer($params);	
			}
			
			incrementNumberOfAnswers($params);
			
			header("location: user.php");
			
		} 
	}

?>