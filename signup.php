<?php 

	include_once('database/connection.php');
	include_once('database/users.php');
	
	include('templates/header.php');

	// If required field are filled
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
	
		$errors = array();
	
		if($_POST['password'] == $_POST['confirmPassword']) {
		
			$params = array('db' => $db, 'username' => $_POST['username']);
			
			if(checkUsername($params)) {
			
				$stmt = $db->prepare('INSERT INTO users VALUES (NULL, :username, :name, :email, :password)');
				$stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
				$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
				$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
				$stmt->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
				
				$stmt->execute();

				header("location: signin.php");
			
			} else {
			
				$errors[] = "Username already taken. Choose another one.";
				
			}

		} 
	}

?>

<form class="form-signin" role="form" method="POST" action="">

	<a class="close" href="signin.php">&times;</a>
	
	<p>Create your personal account</p>
	
	<?php include_once('templates/show_errors.php'); ?>

	<label for="inputUsername">Username</label>
	<input id="inputUsername" type="text" placeholder="Pick a username..." name="username" class="form-control" required autofocus
		title="Username must contain between 8 and 16 characters, including upper/lowercase, numbers and '_' symbols"
		pattern="\w{8,16}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" autocomplete="off">
	
	<label for="inputName">Name</label>
	<input id="inputName" type="text" placeholder="Insert your name..." name="name" class="form-control" required autocomplete="off">
	
	<label for="inputEmail">Email</label>
	<input id="inputEmail" type="email" placeholder="Insert your email..." name="email" class="form-control" required autocomplete="off">
	
	<label for="inputPassword">Password</label>
	<input id="inputPassword" type="password" placeholder="Choose a password..." name="password" class="form-control" required
		title="Password must contain between 8 and 16 characters, including upper/lowercase, numbers and '_' symbols"
		pattern="\w{8,16}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" autocomplete="off">
	
	<label for="inputConfirmPassword">Confirm Password</label>
	<input id="inputConfirmPassword" type="password" placeholder="Confirm your password..." name="confirmPassword" class="form-control" required autocomplete="off">
	
	<input type="submit" value="Sign up" class="btn btn-lg btn-primary btn-block">

</form>

<?php include('templates/footer.php'); ?>