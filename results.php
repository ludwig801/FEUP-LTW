<?php 
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');
	include_once('database/poll_answers.php');

	include('lock.php');
	include('templates/header.php');
	
	if(isset($_GET['id'])) {
		$params = array('db' => $db, 'id' => $_GET['id']);
		$poll = getPollById($params);
		$answers = getPollAnswers($params);
	} else {
		$_SESSION['message'] = "Poll not found.";
		header("location: user.php");
	}

?>


<h3> <?= $poll['description'] ?>


<?php foreach($answers as $row) { 
		
		$vars = array('db' => $db, 'poll_id' => $_GET['id'], 'answer_id' => $row['id']);
		$answerResults = getPollAnswerResults($vars);
?>
	<p><?= $row['description'] ?> :: Total = <?= count($answerResults) ?></p>
	
<?php } ?>


<?php include('templates/footer.php'); ?>