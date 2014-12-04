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
		$descr =  $result['description'];
		$privacy = $result['public'];
		$questions = getPollQuestions($params);
			
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
		$_POST['question'] = $questions;
		
		include('templates/editor/create_poll_editor.php');
	?>
	
</form>
	

<?php include('templates/footer.php'); ?>