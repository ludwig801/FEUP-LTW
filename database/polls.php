<?php
	
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
?>