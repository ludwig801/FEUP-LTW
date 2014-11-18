<?php 
	include('templates/header.php');
?>

	<h2> Login now, bithc </h2>


	<form method="POST" action="database/validate_login.php">

		<p><input type="text" placeholder="username" name="username" /></p>
		<p><input type="password" placeholder="password" name="password" /></p>

		<p><input type="submit" value="login" /></p>

	</form>

	<a href="register.php"> do not have an acc ? what a shame, create 1 </a>


<?php
	include('templates/footer.php');
?>