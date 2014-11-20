<?php

	function addAnswer($vars) {

		$db = $vars['db'];
		$stmt = $db->prepare('INSERT INTO answers VALUES (NULL, :description, :poll_id)');
		$stmt->bindParam(':description', $vars['description'], PDO::PARAM_STR);
		$stmt->bindParam(':poll_id', $vars['poll_id'], PDO::PARAM_STR);

		$stmt->execute();

	}

?>