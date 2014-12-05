<?php

	function validateDetailedView($params) {
		$errors = array();
		
		$isUsersPoll = count(getUserPollById($params));
		$hasAnsweredPoll = checkIfUserAnswered($params);
		
		if(!$hasAnsweredPoll && !$isUsersPoll) {
			$errors[] = "You have no access to this poll";
		}
		
		return $errors;
	}
?>