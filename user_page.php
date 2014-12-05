<?php

	include('lock.php');
	
	include_once('database/connection.php');
	
	// Verifies if something was already posted and if it's valid. 
	include_once('templates/validation/edit_user_validation.php');
	
	include('templates/header.php');
	include('templates/navbar.php');
	
	$user_id = $_SESSION['myid'];
	
?>

<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<?php include('templates/editor/user_editor.php'); ?>
	
</form>

<?php include('templates/footer.php'); ?>