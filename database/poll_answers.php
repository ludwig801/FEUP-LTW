<?php

	function getPollAnswerResults($params) {
		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM poll_answers WHERE poll_id = :poll_id AND answer_id = :answer_id');
		$stmt->bindParam(':poll_id', $params['poll_id'], PDO::PARAM_STR);
		$stmt->bindParam(':answer_id', $params['answer_id'], PDO::PARAM_STR);

		$stmt->execute();

		$result = $stmt->fetchAll();

		return $result;
	}
	
	function addPollAnswer($params) {
		$db = $params['db'];
		$stmt = $db->prepare('INSERT INTO poll_answers VALUES (NULL, :user_id, :poll_id, :answer_id)');
		$stmt->bindParam(':user_id', $params['user_id'], PDO::PARAM_STR);
		$stmt->bindParam(':poll_id', $params['poll_id'], PDO::PARAM_STR);
		$stmt->bindParam(':answer_id', $params['answer_id'], PDO::PARAM_STR);

		$stmt->execute();
	}
	
	function checkIfUserAnswered($params) {
		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM poll_answers WHERE poll_id = :poll_id AND user_id = :user_id');
		$stmt->bindParam(':poll_id', $params['id'], PDO::PARAM_STR);
		$stmt->bindParam(':user_id', $params['user_id'], PDO::PARAM_STR);
		
		$stmt->execute();
		
		$result = $stmt->fetchAll();

		if(count($result) > 0) return 1;
		else return 0;
	}


?>