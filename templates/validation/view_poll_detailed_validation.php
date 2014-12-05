<?php

	function validateDetailedView($params) {
		$errors = array();
		
		$owner = getPollByid($params)['user_id'];
		
		$isUsersPoll = ($owner == $_SESSION['myid']);
		
		if($isUsersPoll) {
			return $errors;
		}
		else {
			$hasAnsweredPoll = checkIfUserAnswered($params);
			if($hasAnsweredPoll) {
				return $errors;
			}
			else {
				$errors[] = "You have no access to this poll";
			}
		}

		return $errors;
	}
?>