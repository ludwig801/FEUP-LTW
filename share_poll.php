<?php
	
	include_once('database/connection.php');
	include_once('lock.php');
	include_once('database/polls.php');
	
	if(!isset($_GET['id'])) {
		$_SESSION['message'] = "Poll not found.";
		header("location: user.php");
	}
	
	include_once('templates/header.php');
	include_once('templates/navbar.php');
	
	// Get poll
	$params = array('db' => $db, 'id' => $_GET['id']);
	$poll = getPollById($params);
	
?>


<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">
			<a class="close" href="user.php">&times;</a>
			<p>Use this token to share this poll.<p/>
		</div>
	</div>
	
	<div class="panel-body">
		<label>Token:</label><input type="text" value="<?= $poll['token'] ?>" onclick="this.select();" readonly style="width:300px; margin-left: 1em; text-align:center;"/>
		
		<a href="#">
			<button type="button" class="btn btn-default">
				Send via Email
			</button>
		</a>
	</div>
	
</div>



<?php include_once('templates/footer.php'); ?>


