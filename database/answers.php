<?php
	
	function addAnswers($params) {
		foreach($params['answers'] as $i => $row) {
			if($i == $params['question_num']) {
				foreach($row as $ans) {
					echo $ans;
					$ansParams = array('db' => $params['db'], 'description' => $ans, 'question_id' => $params['question_id']);
					addAnswer($ansParams);
				}
			}
		}
	}

	function addAnswer($params) {
		$db = $params['db'];
		$stmt = $db->prepare('INSERT INTO answers VALUES (NULL, :description, :question_id)');
		$stmt->bindParam(':description', $params['description'], PDO::PARAM_STR);
		$stmt->bindParam(':question_id', $params['question_id'], PDO::PARAM_STR);

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
	
	function getQuestionAnswers($params) {
		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM answers WHERE question_id = :question_id');
		$stmt->bindParam(':question_id', $params['question_id'], PDO::PARAM_STR);

		$stmt->execute();

		$result = $stmt->fetchAll();

		return $result;
	}

?>