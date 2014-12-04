<?php
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/questions.php');
	include_once('database/answers.php');

	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');
	
	// Validates form.
	include('templates/validation/edit_poll_form_validation.php');
	
	// If we don't have a form post, prepares form. 
	if(isset($_GET['id'])) {
	
		$params = ['db' => $db, 'id' => $_GET['id']];
		$result = getPollById($params);
		$poll_id = $_GET['id'];
		$descr =  $result['description'];
		$privacy = $result['public'];
		$questions = getPollQuestions($params);
		
	} else {
	
		$_SESSION['message'] = "Poll not found.";
		header("location: user.php");
	}
?>

<form method="POST" action="edit_poll.php?id=<?= $poll_id ?>">

	<input type="hidden" name="poll_id" value="<?= $poll_id; ?>" />
	<input type="hidden" name="pollTitle" value="<?= $descr; ?>" />
	<input type="hidden" name="public" value="<?= $privacy; ?>" />
	<?php if(isset($questions) && (sizeof($questions) > 0)) { ?> <input type="hidden" name="question" value="<?php echo htmlentities(serialize($questions)); ?>" /> <?php } ?>

	<?php
	
		$_POST['poll_id'] = $poll_id;
		$_POST['pollTitle'] = $descr;		
		$_POST['public'] = $privacy;
		$_POST['question'] = $questions;
		
		include('templates/editor/create_poll_editor.php');
	?>
	
</form>

<?php include('templates/footer.php'); ?>