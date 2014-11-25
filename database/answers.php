<?php

	function addAnswer($vars) {

		$db = $vars['db'];
		$stmt = $db->prepare('INSERT INTO answers VALUES (NULL, :description, :poll_id)');
		$stmt->bindParam(':description', $vars['description'], PDO::PARAM_STR);
		$stmt->bindParam(':poll_id', $vars['poll_id'], PDO::PARAM_STR);

		$stmt->execute();

	}

	function getPollAnswers($params) {

		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM answers WHERE poll_id = :poll_id');
		$stmt->bindParam(':poll_id', $params['id'], PDO::PARAM_STR);

		$stmt->execute();

		$result = $stmt->fetchAll();

		return $result;

	}
	
	function deleteAllPollAnswers($params) {
		$db = $params['db'];
		$stmt = $db->prepare('DELETE FROM answers WHERE poll_id = :poll_id');
		$stmt->bindParam(':poll_id', $params['poll_id'], PDO::PARAM_STR);
		$stmt->execute();
	}

?>