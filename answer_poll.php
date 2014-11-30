<?php
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');
	include_once('database/poll_answers.php');
	
	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');

	if(isset($_POST['answer']) && isset($_POST['id'])) {	
		$params = ['db' => $db, 'user_id' => $_SESSION['myid'], 'poll_id' => $_POST['id'], 'answer_id' => $_POST['answer']];
		addPollAnswer($params);
		incrementNumberOfAnswers($params);
		header("location: user.php");
	}
	
	if(isset($_GET['id'])) {

		$params = ['db' => $db, 'user_id' => $_SESSION['myid'], 'id' => $_GET['id']];
		$check = checkIfUserAnswered($params);

		if($check) {
			$_SESSION['message'] = "You've already answered to this poll. Thanks.";
			header("location: results.php?" . $_SERVER['QUERY_STRING']);
		}
	
		$result = getPollById($params);
		$answers = getPollAnswers($params);
	}	
?>

<form method="POST" action="answer_poll.php">

	<input type="hidden" value="<?=$_GET['id']?>" name="id" />

	<div class="panel panel-primary">
	
		<div class="panel-heading">
			<div class="panel-title">
				Answer Poll
				<a class="close" href="public_polls.php">&times</a>
			</div>
		</div>
		
		<div class="panel-body">

			<div class="panel panel-default">

				<div class="panel-heading">
					<div class="panel-title">
						<?=$result['description']?>
						<a class="close" href="public_polls.php">&times</a>
					</div>
				</div>
				
				<div class="panel-body">
					<table class="table">
						<?php foreach($answers as $row) {
							echo '<div class="row">
									<div class="col-lg-6">
										<div class="input-group">
										  <span class="input-group-addon">
											<input type="radio" value=' . $row['id'] . ' name="answer">
										  </span>
										  <input type="text" class="form-control" value=' . $row['description'] . '>
										</div>
									  </div>
									</div><p/>';
						} ?>
					</table>
				</div>
				
				<div class="panel-footer">
				
					<input class="btn btn-primary" type="submit" value="Send" />
				
				</div>
				
			</div>
			
		</div>
	
	</div>
	
</form>


<?php include('templates/footer.php'); ?>