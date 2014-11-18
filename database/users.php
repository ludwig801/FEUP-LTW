<?php 

	function getAllUsers($db) {	
		$stmt = $db->prepare('SELECT * FROM users');
		$stmt->execute();
		return $stmt->fetchAll();
	}

?>