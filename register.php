<?php 
	include('templates/header.php');
?>
		
		<form method="POST" action="create_user.php">
			<p><label>Name: </label><input type="text" placeholder="Name" name="name" /></p>
			<p><label>Username: </label><input type="text" placeholder="Username" name="username" /></p>
			<p><label>Password: </label><input type="password" name="password" /></p>
			<p><label>Email: </label><input type="email" placeholder="Email" name="email" /></p>
			
			<p><input type="submit" value="Register" /></p>
		</form>

<?php
	include('templates/footer.php');
?>