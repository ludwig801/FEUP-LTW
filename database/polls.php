<?php

	function getAllPolls($params) {
		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM polls WHERE user_id = :user_id OR public = 1');
		$stmt->bindParam(':user_id', $params['user_id'], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function getPublicPolls($db) {
		$stmt = $db->prepare('SELECT * FROM polls WHERE public = 1');
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	function getUserPolls($params) {
		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM polls WHERE user_id = :user_id');
		$stmt->bindParam(':user_id', $params['user_id'], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function getLastPollId($db) {
		$stmt = $db->prepare('SELECT MAX(id) FROM polls');
		$stmt->execute();
		$result = $stmt->fetch();
		return $result['MAX(id)'];
	}

	function getPollById($params) {
		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM polls WHERE id = :id');
		$stmt->bindParam(':id', $params['id'], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}
	
	function getPollsByDescription($params) {
		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM polls WHERE description = :description AND public = 1');
		$stmt->bindParam(':description', $params['description'], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	function addPoll($params) {
		
		$db = $params['db'];
		$stmt = $db->prepare('INSERT INTO polls VALUES (NULL, :description, :public, :user_id, "", 0, :token)');
		$stmt->bindParam(':description', $params['description'], PDO::PARAM_STR);
		$stmt->bindParam(':public', $params['public'], PDO::PARAM_STR);
		$stmt->bindParam(':user_id', $params['myid'], PDO::PARAM_STR);
		$stmt->bindParam(':token', $params['token'], PDO::PARAM_STR);
		
		$stmt->execute();
	}
	
	function editPoll($params) {
		$db = $params['db'];
		$stmt = $db->prepare('UPDATE polls SET description = :description, public = :public WHERE id = :id');
		$stmt->bindParam(':id', $params['id'], PDO::PARAM_STR);
		$stmt->bindParam(':description', $params['description'], PDO::PARAM_STR);
		$stmt->bindParam(':public', $params['public'], PDO::PARAM_STR);
		$stmt->execute();
	}
	
	function deletePoll($params) {
		$db = $params['db'];
		$stmt = $db->prepare('DELETE FROM polls WHERE id = :id');
		$stmt->bindParam(':id', $params['id'], PDO::PARAM_STR);
		$stmt->execute();
	}
	
	function incrementNumberOfAnswers($params) {
		$db = $params['db'];
		$stmt = $db->prepare('UPDATE polls SET number_of_answers = number_of_answers + 1 WHERE id = :id');
		$stmt->bindParam(':id', $params['poll_id'], PDO::PARAM_STR);
		$stmt->execute();
	}
	
	function getPollByToken($params) {
		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM polls WHERE token = :token');
		$stmt->bindParam(':token', $params['token'], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}
	
	function getSearchResults($params) {
		$db = $params['db'];
		$queryStrings = $params['query'];
		
		$results = array();
		
		foreach($queryStrings as $str) {
		
			$searchStr = '%' . $str . '%';
			$stmt = $db->prepare('SELECT * FROM polls WHERE description LIKE :query');
			$stmt->bindParam(':query', $searchStr, PDO::PARAM_STR);
			$stmt->execute();
			
			$results = $stmt->fetchAll();
		}
		
		return $results;
	}

?>