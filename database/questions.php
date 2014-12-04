<?php
	
	// Adds a list of questions to the database.
	function addQuestions($params) {
		$questNum = 0;
		foreach($params['questions'] as $quest) {
			$questionParams = array('db' => $params['db'], 'description' => $quest, 'poll_id' => $params['poll_id'], 'question_num' => $questNum, 'answers' => $params['answers']);
			addQuestion($questionParams);
			$question_id = getLastQuestionID($params['db']);
			$questionParams['question_id'] = $question_id;
			addAnswers($questionParams);
			$questNum = ($questNum + 1);
		}
	}

	// Adds one question to the database. 
	function addQuestion($params) {
		$db = $params['db'];
		$stmt = $db->prepare('INSERT INTO questions VALUES (NULL, :description, :poll_id)');
		$stmt->bindParam(':description', $params['description'], PDO::PARAM_STR);
		$stmt->bindParam(':poll_id', $params['poll_id'], PDO::PARAM_STR);

		$stmt->execute();
	}
	
	// Returns the ID of the last question added to the database.
	function getLastQuestionID($db) {
		$stmt = $db->prepare('SELECT MAX(id) FROM questions');
		$stmt->execute();
		$result = $stmt->fetch();
		return $result['MAX(id)'];
	}
	
	// Returns the questions that are associated to a given poll.
	function getPollQuestions($params) {
		$db = $params['db'];
		$stmt = $db->prepare('SELECT * FROM questions WHERE poll_id = :poll_id');
		$stmt->bindParam(':poll_id', $params['id'], PDO::PARAM_STR);

		$stmt->execute();

		$result = $stmt->fetchAll();

		return $result;
	}
	
	function deleteAllPollQuestions($params) {
		$db = $params['db'];
		$stmt = $db->prepare('DELETE FROM questions WHERE poll_id = :poll_id');
		$stmt->bindParam(':poll_id', $params['poll_id'], PDO::PARAM_STR);
		$stmt->execute();
	}


?>