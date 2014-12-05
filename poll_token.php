<?php

	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('lock.php');
	include_once('templates/header.php');
	include_once('templates/navbar.php');
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		include_once('templates/validation/form_validation.php');
		include_once('database/polls.php');
	
		if(isset($_POST['token'])) {
			$token = validateInput($_POST['token']);
			
			$params = array('db' => $db, 'token' => $token);
			$poll = getPollByToken($params);
			
			if(isset($poll)) {
			
				header('location: answer_poll.php?id= '.$poll['id']);
				
			}
			
		}
	}
	
?>

<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<div class="panel panel-primary">
	
		<div class="panel-heading">
			<div class="panel-title">
				<a class="close" href="user.php">&times;</a>
				<p>Use your token.<p/>
			</div>
		</div>
		
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="input-group">
						<input type="text" class="form-control" id="token" name="token" style="text-align:center" maxlength="10"/>
						<span class="input-group-btn">
							<input type="submit" value="Confirm" name="submit" class="btn btn-success"/>
						</span>
					</div>
				</div>
			</div>
		</div>
	
	</div>

</form>

<?php include_once('templates/footer.php'); ?>

