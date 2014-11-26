<?php

	function getPublicPolls($db) {
		$stmt = $db->prepare('SELECT * FROM polls WHERE public = 1');
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	function getUserPolls($params) {
		$db = $params[0];
		$stmt = $db->prepare('SELECT * FROM polls WHERE user_id = :myid');
		$stmt->bindParam(':myid', $params[1], PDO::PARAM_STR);
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
		$stmt = $db->prepare('INSERT INTO polls VALUES (NULL, :description, :public, :user_id)');
		$stmt->bindParam(':description', $params['description'], PDO::PARAM_STR);
		$stmt->bindParam(':public', $params['public'], PDO::PARAM_STR);
		$stmt->bindParam(':user_id', $params['myid'], PDO::PARAM_STR);

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
	
?>