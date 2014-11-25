<?php
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');

	include('templates/header.php');
	
	if(isset($_POST['description']) && isset($_POST['public']) && isset($_POST['id']) && isset($_POST['poll_id'])) {
	
		$params = ['db' => $db, 'id' => $_POST['id'], 'description' => $_POST['description'], 'public' => $_POST['public'], 'poll_id' => $_POST['poll_id']];
		editPoll($params);
		deleteAllPollAnswers($params);
		$_SESSION['message'] = "Poll successfully edited.";
		
		header("location: user.php");
		
	} else if(isset($_GET['id'])) {
	
		$params = ['db' => $db, 'id' => $_GET['id']];
		$result = getPollById($params);
		$answers = getPollAnswers($params);
		
	} else {
	
		$_SESSION['message'] = "Poll not found.";
		
		header("location: user.php");
	}

?>

<h3> <?= $result['description'] ?> </h3>

<form method="POST" action"edit_poll.php">
	
	<P><input type="text" name="description" value="<?= $result['description'] ?>" placeholder="The question..." /></p>

	<p><input type="radio" name="public" value="1"/> Public <input type="radio" name="public" value="0" checked/> Private </p>
	
	<input type="hidden" value="<?=$_GET['id']?>" name="id" />
	
	<p> Possible answers: </p>
		
	<div id="answers">
	
		<?php
			$count = 0;
			foreach($answers as $row) { 
		?>
			<p><input type='text' name='answer[<?= $count ?>]' value='<?=$row["description"]?>' placeholder="Insert answer... <?= $count ?>" /></p>
			<?php $count++; ?>
		<?php } ?>
		
	</div>
	
	<p><a href="javascript: addAnswer();"> Add answer </a></p>
	
	<input type="hidden" name="poll_id" value=<?= $result['id']?> />
	
	<p><input type="submit" value="Save" /></p>

</form>
	

<?php include('templates/footer.php'); ?>