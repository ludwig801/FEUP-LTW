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
	
	function checkPassword($params) {
		$db = $params['db'];
		$stmt = $db->prepare("SELECT * FROM users WHERE username = :username and password = :password");
		$stmt->bindParam(':username', $params['username'], PDO::PARAM_STR);
		$stmt->bindParam(':password', $params['password'], PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch();
		if(count($result) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function checkUsername($params) {
		$db = $params['db'];
		$stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
		$stmt->bindParam(':username', $params['username'], PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch();
		if(count($result) > 0) {
			return false;
		} else {
			return true;
		}
	}
	
	function deleteUser($params) {
		$db = $params['db'];
		$stmt = $db->prepare('DELETE FROM users WHERE username = :username');
		$stmt->bindParam(':username', $params['username'], PDO::PARAM_STR);
		$stmt->execute();
	}

?>