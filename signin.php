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
			echo "<div class='alert alert-danger' role='alert'> Invalid username and/or password </div>";
		}
	}
?>

	<form class="form-signin" role="form" method="POST" action="">
	
		<h2 class="form-signin-heading"> Please sign in, </h2>
		
		<label for="inputUser" class="sr-only">Username</label>
		<input id="inputUser" type="text" placeholder="Username" name="username" class="form-control" required autofocus/>
		<label for="inputPassword" class="sr-only">Password</label>
		<input id="inputPassword" type="password" placeholder="Password" name="password" class="form-control" required />

		<input type="submit" value="Signin" class="btn btn-lg btn-primary btn-block"/>
		<p>If you don't have an account, </p>
		<a href="signup.php"> <input type="button" class="btn btn-lg btn-primary btn-block" value="Signup" /> </a>

	</form>




<?php
	include('templates/footer.php');
?>