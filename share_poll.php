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
		<div class="row">
			<div class="col-lg-4">
				<div class="input-group">
					<span class="input-group-btn">
						<button class="btn btn-warning" onclick="javascript: $('#token').get(0).select();">
							Select Token
						</button>
					</span>
					<input type="text" class="form-control" id="token" value="<?= $poll['token'] ?>" style="text-align:center" readonly/>
					<span class="input-group-btn">
						<a href="#" class="btn btn-success">
								Send via Email
						</a>
					</span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel-footer">
		<a href="user.php" type="button" value="Back" class="btn btn-primary" title="Go Back">Back</a>
	</div>
	
</div>



<?php include_once('templates/footer.php'); ?>


