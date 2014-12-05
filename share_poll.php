<?php
	
	include_once('database/connection.php');
	include_once('lock.php');
	
	if(!isset($_GET['id'])) {
		$_SESSION['message'] = "Poll not found.";
		header("location: user.php");
	}
	
	include_once('templates/header.php');
	include_once('templates/navbar.php');
	
?>


<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">
			<a class="close" href="user.php">&times;</a>
			<p>Use this link to share the poll.<p/>
		</div>
	</div>
	
	<div class="panel-body">
		<input type="text" value="<?= $_SERVER['SERVER_NAME']; ?>/answer_poll.php?id=<?= $_GET['id'] ?>" onclick="this.select();" readonly style="width:300px;"/>
	</div>
	
</div>



<?php include_once('templates/footer.php'); ?>


