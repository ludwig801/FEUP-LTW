<?php 
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');
	include_once('database/poll_answers.php');

	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');
	
	if(isset($_GET['id'])) {
		$params = array('db' => $db, 'id' => $_GET['id']);
		$poll = getPollById($params);
		$answers = getPollAnswers($params);
	} else {
		$_SESSION['message'] = "Poll not found.";
		header("location: user.php");
	}

?>

<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">
			<?=$poll['description']?> | View answers
			<a class="close" href="user.php">&times</a>
		</div>
	</div>
	
	<div class="panel-body">
		
		<div class="panel panel-default">
		
			<!--<div class="panel-heading">
				<div class="panel-title">Statistics</div>
			</div>-->
			
				<table class="table">
					<tr>
						<th>Answers</th>
						<th>Count</th>
					</tr>
					
					<?php
						foreach($answers as $row) {
						
							$vars = array('db' => $db, 'poll_id' => $_GET['id'], 'answer_id' => $row['id']);
							$answerResults = getPollAnswerResults($vars);
							
							echo '<tr>';
							echo '<td>' . $row['description'] . '</td>';
							echo '<td>' . count($answerResults) . '</td>';
							echo '</tr>';
						}
					?>
					
				</table>
		
		</div>
		
	</div>
	
</div>

<?php include('templates/footer.php'); ?>