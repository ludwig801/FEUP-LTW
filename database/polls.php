<?php
	
	function getUserPolls($db) {
		//$stmt = $db->prepare('SELECT * FROM polls WHERE user_id = id');
		$stmt = $db->prepare('SELECT * FROM polls');
		$stmt->execute();
		return $stmt->fetchAll();
	}
?>