<?php 

	include_once('database/connection.php');
	include('templates/header.php');


	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$myusername = $_POST['username'];
		$mypassword = $_POST['password'];

		$stmt = $db->prepare("SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'");
		$stmt->execute();
		$result = $stmt->fetch();

		if($result['username'] == $myusername) {

			$_SESSION['myusername'] = $myusername;
			$_SESSION['myid'] = $result['id'];

			// Redirect to user page
			header("location: user.php");

		} else {
			echo "Your username and/or password is invalid hehe";
		}
	}
?>

	<h2> Please, log in </h2>


	<form method="POST" action="">

		<p><input type="text" placeholder="username" name="username" /></p>
		<p><input type="password" placeholder="password" name="password" /></p>

		<p><input type="submit" value="Login" /></p>

	</form>

	<a href="signup.php"> <input type="button" value="Create an account" /> </a>


<?php
	include('templates/footer.php');
?>