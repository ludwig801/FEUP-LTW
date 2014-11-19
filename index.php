<?php 
	include('templates/header.php');
	include_once('database/connection.php');

	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$myusername = $_POST['username'];
		$mypassword = $_POST['password'];

		$stmt = $db->prepare("SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'");
		$stmt->execute();
		$result = $stmt->fetchAll();
		$count = count($result);

		if($count == 1) {
			$_SESSION['myusername'] = $myusername;

			// Redirect to user page
			header("location: admin.php");
		} else {
			echo "Your username and/or password is invalid hehe";
		}
	}
?>

	<h2> Login now, bithc </h2>


	<form method="POST" action="">

		<p><input type="text" placeholder="username" name="username" /></p>
		<p><input type="password" placeholder="password" name="password" /></p>

		<p><input type="submit" value="login" /></p>

	</form>

	<a href="signup.php"> do not have an acc ? what a shame, create 1 </a>


<?php
	include('templates/footer.php');
?>