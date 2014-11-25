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


?>