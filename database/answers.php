<?php
	
	function addAnswers($params) {
		foreach($params['answers'] as $i => $row) {
			if($i == $params['question_num']) {
				foreach($row as $ans) {
					echo $ans;
					$ansParams = array('db' => $params['db'], 'description' => $ans, 'poll_id' => $params['poll_id']);
					addAnswer($ansParams);
				}
			}
		}
	}

	function addAnswer($params) {
		$db = $params['db'];
		$stmt = $db->prepare('INSERT INTO answers VALUES (NULL, :description, :poll_id)');
		$stmt->bindParam(':description', $params['description'], PDO::PARAM_STR);
		$stmt->bindParam(':poll_id', $params['poll_id'], PDO::PARAM_STR);

		$stmt->execute();
	}

	function getPollAnswers($params) {

		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM answers WHERE poll_id = :poll_id');
		$stmt->bindParam(':poll_id', $params['id'], PDO::PARAM_STR);

		$stmt->execute();

		$result = $stmt->fetchAll();

		return $result;

	}
	
	function deleteAllPollAnswers($params) {
		$db = $params['db'];
		$stmt = $db->prepare('DELETE FROM answers WHERE poll_id = :poll_id');
		$stmt->bindParam(':poll_id', $params['poll_id'], PDO::PARAM_STR);
		$stmt->execute();
	}

?>