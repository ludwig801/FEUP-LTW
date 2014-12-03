<?php
	
	// Adds a list of questions to the database.
	function addQuestions($params) {
		$questNum = 0;
		foreach($params['questions'] as $quest) {
			$questionParams = array('db' => $params['db'], 'description' => $quest, 'poll_id' => $params['poll_id'], 'question_num' => $questNum, 'answers' => $params['answers']);
			addQuestion($questionParams);
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

?>