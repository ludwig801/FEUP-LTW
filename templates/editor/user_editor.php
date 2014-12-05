<div class="panel panel-primary">

	<!-- Introduction -->
	<div class="panel-heading">
		<div class="panel-title">
			<a class="close" href="user.php">&times;</a>
			<p>Welcome, <?=$_SESSION['myname']?>!<p/>
			<p>Here you can manage your account settings. Feel free to do so.<p/>
			
		</div>
	</div>
	
	<!-- ID Hidden field -->
	<input type="hidden" value="<?=$user_id?>" name="id" />
	
	<!-- Show errors -->
	<?php include('templates/show_errors.php'); ?>
	
	<!-- Editor -->
	<div class="panel-body">

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="input-group">
					<span class="input-group-addon">Username</span>
					<input type="text" class="form-control" value="<?=$_SESSION['myusername']?>" disabled required><!-- Very important! -->
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
			
			<div class="panel-body">
				<!-- Delete account -->
				<a href="user_page.php" type="button" value="Delete Account" class="btn btn-danger" title="delete my account">
					<span style="color:white" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					Delete My Account
					<span style="color:white" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</a>
			</div>
			
			<!-- Buttons -->
			<div class="panel-footer">
				<!-- Save -->
				<input type="submit" value="Save Changes" class="btn btn-primary">
				
				<!-- Discard -->
				<a href="user_page.php" type="button" value="Discard Changes" class="btn btn-default" title="Discard Changes">Discard Changes</a>
			</div>
			
		</div>
		
	</div>
	
	<!-- Buttons -->
	<div class="panel-footer">

		<!-- Poll Page -->
		<a href="user.php" type="button" value="Discard Changes" class="btn btn-default" title="Back">Back to Polls Page</a>
	</div>

</div>