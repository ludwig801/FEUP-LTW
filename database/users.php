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
	
	function editUser($params) {
		$db = $params['db'];
		$stmt = $db->prepare('UPDATE users SET name = :name, email = :email WHERE id = :id');
		$stmt->bindParam(':id', $params['id'], PDO::PARAM_STR);
		$stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
		$stmt->bindParam(':email', $params['email'], PDO::PARAM_STR);
		$stmt->execute();
	}

?>