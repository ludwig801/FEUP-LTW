<?php
	
	include_once('database/connection.php');
	include_once('database/users.php');
	include_once('lock.php');
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if(isset($_POST['password'])) {
		
			$params = array('db' => $db, 'username' => $_SESSION['myusername'], 'password' => $_POST['password']);
			if(checkPassword($params)) {
				deleteUser($params);
			} else {
				$errrors = array();
				$errors[] = "Incorrect password.";
			}
		}
		
	}
	
	include_once('templates/header.php');

?>

<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<div class="panel panel-primary">
	
		<div class="panel-heading">
			<div class="panel-title">
				<a class="close" href="user.php">&times;</a>
				<p>Are you sure you want to delete your account and all that is associated?<p/>
			</div>
		</div>
		
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="input-group">
						<input type="password" class="form-control" id="password" name="password" style="text-align:center" autocomplete="off" placeholder="Confirm your password..." />
						<span class="input-group-btn">
							<input type="submit" value="Confirm" name="submit" class="btn btn-success"/>
						</span>
					</div>
				</div>
			</div>
		</div>
	
	</div>

</form>

<?php include_once('templates/footer.php');