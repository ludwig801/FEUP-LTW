<?php

	$db = new PDO('sqlite:../database/polls.db');
	include_once('../database/polls.php');
	include_once('../database/answers.php');
	include_once('../database/questions.php');

	$poll_id = $_GET['id'];
	
	$params = array('db' => $db, 'id' => $poll_id);
	
	$poll = getPollById($params);
	$questions = getPollQuestions($params);
	$answers = array();
	
	foreach($questions as $question) {
		$i = 0;
		
		$questionParams = array('db' => $db, 'question_id' => $question['id']);
		
		$answers['\'' . $question['id'] . '\''] = getQuestionAnswers($questionParams);
	}
	
	$pollData = array('poll' => $poll, 'questions' => $questions, 'answers' => $answers);
	
	// returns the json encoded data
	echo json_encode($pollData);
	return false;
?>

<!--
<div class="panel panel-primary" >

	<div class="panel-heading">
		<h2 class="panel-title">
			<?=$poll['description']?>
		</h2>
	</div>
	
	<div class="panel-body">
				
			<?php foreach($questions as $q) { ?>
					<div class="panel panel-default">
		
						<div class="panel-heading"><?=$q['description']?></div>
						
						<div class="panel-body">
						
							<ul class="list-group">
							
								<?php foreach($answers[$q['id']] as $ans) { ?>
									<li class="list-group-item"><?=$ans['description']?></li>
								<?php } ?>
							
							</ul>
						
						</div>
					</div>
			<?php } ?>
	
	</div>

</div>
-->