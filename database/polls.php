<?php
	
	function getUserPolls($params) {
		$db = $params[0];
		$stmt = $db->prepare('SELECT * FROM polls WHERE user_id = :myid');
		$stmt->bindParam(':myid', $params[1], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}
?>