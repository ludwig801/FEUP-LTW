<?php

	include('lock.php');
	
	include_once('database/connection.php');
	
	include_once('templates/validation/edit_user_validation.php');
	
	include('templates/header.php');
	include('templates/navbar.php');
	
	$user_id = $_SESSION['myid'];
	
?>


<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<div class="panel panel-primary">

		<div class="panel-heading">
			<div class="panel-title">
				<a class="close" href="user.php">&times;</a>
				<p>Welcome, <?=$_SESSION['myname']?>!<p/>
				<p>Here you can manage your account settings. Feel free to do so.<p/>
				
			</div>
		</div>
		
		<input type="hidden" value="<?=$user_id?>" name="id" />
		
		<!-- Show errors -->
		<?php 
			if(isset($errors)) {
				foreach($errors as $err) {
					echo "<p class='error'> * $err </p>";
				} 
			}
		?>
		
		<div class="panel-body">

			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="input-group">
						<span class="input-group-addon">Username</span>
						<input type="text" class="form-control" value="<?=$_SESSION['myname']?>" disabled required><!-- Very important! -->
					</div>
					<p/>
					
					<div class="input-group">
						<span class="input-group-addon">Name</span>
						<input type="none" class="form-control" value="<?=$_SESSION['myname']?>" placeholder="Insert your name..." name="name" required>
					</div>
					<p/>
					
					<div class="input-group">
						<span class="input-group-addon">Email</span>
						<input type="email" class="form-control" value="<?=$_SESSION['myemail']?>" placeholder="Insert your email..." name="email" required>
					</div>
				</div>
				
				<div class="panel-body"></div>
				
				<div class="panel-footer">
					<!-- Submit -->
					<a href="user_page.php" type="button" value="Delete Account" class="btn btn-danger" title="delete my account">
						<span style="color:white" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Delete My Account
						<span style="color:white" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</div>
				
			</div>
			
		</div>
		
		<div class="panel-footer">
			<!-- Save -->
			<input type="submit" value="Save Changes" class="btn btn-lg btn-success">
			
			<!-- Discard -->
			<a href="user_page.php" type="button" value="Discard Changes" class="btn btn-lg  btn-default" title="Discard Changes">Discard Changes</a>
		</div>

	</div>
</form>

<?php include('templates/footer.php'); ?>