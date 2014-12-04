<?php
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/questions.php');
	include_once('database/answers.php');
	include_once('database/poll_answers.php');
	
	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');
	
	include('templates/validation/answer_poll_validation.php');

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
			header("location: poll_view_answers.php?" . $_SERVER['QUERY_STRING']);
		}
	
		$result = getPollById($params);
		$questions = getPollQuestions($params);
	}	
?>

<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<?php include_once('templates/answer_poll.php'); ?>
		
</form>


<?php include('templates/footer.php'); ?>