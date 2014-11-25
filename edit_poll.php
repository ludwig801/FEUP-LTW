<?php
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');

	include('templates/header.php');
	
	if(isset($_POST['description']) && isset($_POST['public']) && isset($_POST['id'])) {
	
		$params = ['db' => $db, 'id' => $_POST['id'], 'description' => $_POST['description'], 'public' => $_POST['public']];
		editPoll($params);
		
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
	
	<?php echo "check: ";echo  ((bool)$result['public']); ?>
	
	<p><input type="radio" name="public" value="1" checked="<?= ((bool)$result['public']) ?>" /> Public <input type="radio" name="public" value="0" checked="<?= !((bool)$result['public']) ?>"/> Private </p>
	
	<input type="hidden" value="<?=$_GET['id']?>" name="id" />
	
	<p><input type="submit" value="Save" /></p>

</form>
	

<? include('templates/footer.php'); ?>