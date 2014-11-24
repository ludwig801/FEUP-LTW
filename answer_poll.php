<?php
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');
	
	include('lock.php');
	include('templates/header.php');

	if(isset($_POST['answer']) && isset($_POST['id'])) {
	
		echo $_POST['answer'];
		echo $_POST['id'];
		echo $_SESSION['myid'];
	
		$stmt = $db->prepare('INSERT INTO poll_answers VALUES (NULL, :user_id, :poll_id, :answer_id)');
		$stmt->bindParam(':user_id', $_SESSION['myid'], PDO::PARAM_STR);
		$stmt->bindParam(':poll_id', $_POST['id'], PDO::PARAM_STR);
		$stmt->bindParam(':answer_id', $_POST['answer'], PDO::PARAM_STR);

		$stmt->execute();
		
		header("location: user.php");
		
	}
	
	if(isset($_GET['id'])) {
		$params = ['db' => $db, 'id' => $_GET['id']];
		$result = getPollById($params);
		$answers = getPollAnswers($params);
	}
	
?>


<h2> Answer Poll </h2>

<h3> <?= $result['description'] ?> </h3>

<form method="POST" action="answer_poll.php">

	<?php foreach($answers as $row) { ?>
		<p><?= $row['description'] ?></p><input type="radio" value="<?=$row['id']?>" name="answer"/>
	<?php } ?>
	
	<input type="hidden" value="<?=$_GET['id']?>" name="id" />
	
	<p><input type="submit" value="Send" /></p>
	
</form>


<? include('templates/footer.php'); ?>