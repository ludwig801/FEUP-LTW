<?php
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');

	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');
	
	// Validates form.

	
	if(isset($_POST['description']) && isset($_POST['public']) && isset($_POST['id']) && isset($_POST['poll_id']) && isset($_POST['answer'])) {
	
		$params = ['db' => $db, 'id' => $_POST['id'], 'description' => $_POST['description'], 'public' => $_POST['public'], 'poll_id' => $_POST['poll_id']];
		editPoll($params);
		deleteAllPollAnswers($params);
		
		foreach($_POST['answer'] as $ans) {
			$poll_id = getLastPollId($db);
			$vars = ['db' => $db, 'description' => $ans, 'poll_id' => $poll_id];
			addAnswer($vars);
		}
	
		$_SESSION['message'] = "Poll successfully edited.";
		
		header("location: user.php");
		
	} else if(isset($_GET['id'])) {
	
		$params = ['db' => $db, 'id' => $_GET['id']];
		$result = getPollById($params);
		$descr =  $result['description'];
		$privacy = $result['public'];
		$answers = getPollAnswers($params);
		
	} else {
	
		$_SESSION['message'] = "Poll not found.";
		
		header("location: user.php");
	}
?>

<form method="POST" action"edit_poll.php">

	<input type="hidden" value="<?=$_GET['id']?>" name="id" />

	<?php
	
		$_POST['description'] = $descr;
		
		$_POST['public'] = $privacy;
	
		$_POST['answers'] = $answers;
		
		include('templates/editor/create_poll_editor.php');
	?>
	
</form>
	

<?php include('templates/footer.php'); ?>