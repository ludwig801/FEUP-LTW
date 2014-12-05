<?php

	$db = new PDO('sqlite:../database/polls.db');
	include_once('../database/polls.php');
	include_once('../database/poll_answers.php');
	include_once('../database/answers.php');
	include_once('../database/questions.php');

	$poll_id = $_GET['id'];
	
	$params = array('db' => $db, 'id' => $poll_id);
	
	$poll = getPollById($params);
	$questions = getPollQuestions($params);
	$answers = array();
	$poll_answers = array();
	
	foreach($questions as $question) {
	
		$questionParams = array('db' => $db, 'question_id' => $question['id']);
		
		$answers[$question['id']] = getQuestionAnswers($questionParams);
		
		foreach($answers[$question['id']] as $answer) {
			$answerParams = array('db' => $db, 'poll_id' => $poll_id, 'answer_id' => $answer['id']);
		
			//echo 'num: ' . getNumberOfAnswers($answerParams);
			$poll_answers[$question['id']][$answer['id']] = getNumberOfAnswers($answerParams);
		}
	}
	
	$pollData = array('poll' => $poll, 'questions' => $questions, 'answers' => $answers, 'poll_answers' => $poll_answers);
	
	// returns the json encoded data
	echo json_encode($pollData);
	return false;
?>