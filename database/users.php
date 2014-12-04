<?php 

	function getAllUsers($db) {	
		$stmt = $db->prepare('SELECT * FROM users');
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	function getUserByUsername($params) {
		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
		$stmt->bindParam(':username', $params['username'], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	function getUsernameById($params) {
		$db = $params['db']; 
		$stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
		$stmt->bindParam(':id', $params['id'], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch()['username'];
	}

?>