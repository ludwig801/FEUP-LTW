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
			<?=$poll['description']?>
			<a class="close" href="user.php">&times</a>
		</div>
	</div>
	
	<div class="panel-body">
		
		<?php
			foreach($answers as $row) {
			
				$vars = array('db' => $db, 'poll_id' => $_GET['id'], 'answer_id' => $row['id']);
				$answerResults = getPollAnswerResults($vars);
				
				echo '<div class="row">
						<div class="col-lg-6">
							<div class="input-group">
							  <span class="input-group-addon">' . count($answerResults) . '</span>
							  <span class="form-control">' . $row['description'] . '</span>
							</div><!-- /input-group -->
						  </div><!-- /.col-lg-6 -->
						</div><p/>';
			}
		?>
		
	</div>
	
</div>

<?php include('templates/footer.php'); ?>