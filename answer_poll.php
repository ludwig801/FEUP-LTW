<?php
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');
	include_once('database/poll_answers.php');
	
	include('lock.php');
	include('templates/header.php');


	if(isset($_POST['answer']) && isset($_POST['id'])) {	
		$params = ['db' => $db, 'user_id' => $_SESSION['myid'], 'poll_id' => $_POST['id'], 'answer_id' => $_POST['answer']];
		addPollAnswer($params);
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


<h2> Answer Poll </h2>

<h3> <?= $result['description'] ?> </h3>

<form method="POST" action="answer_poll.php">

	<?php foreach($answers as $row) { ?>
		<label><p><?= $row['description'] ?><input type="radio" value="<?=$row['id']?>" name="answer"/></p></label>
	<?php } ?>
	
	<input type="hidden" value="<?=$_GET['id']?>" name="id" />
	
	<p><input type="submit" value="Send" /></p>
	
</form>


<?php include('templates/footer.php'); ?>