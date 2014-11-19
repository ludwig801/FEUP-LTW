<?php 

	include_once('database/connection.php');
	include('templates/header.php');

	// If required field are filled
	if(isset($_POST['username']) && isset($_POST['password'])) {

		$stmt = $db->prepare('INSERT INTO users VALUES (NULL, :username, :name, :email, :password)');
		$stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
		$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
		$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
		$stmt->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
		
		$stmt->execute();

	}

?>	
		<form method="POST" action="">
			<p><label>Name: </label><input type="text" placeholder="Name" name="name" /></p>
			<p><label>Username: </label><input type="text" placeholder="Username" name="username" /></p>
			<p><label>Password: </label><input type="password" name="password" /></p>
			<p><label>Email: </label><input type="email" placeholder="Email" name="email" /></p>
			
			<p><input type="submit" value="Register" /></p>

		</form>

		<a href="login.php"> Back </a>

<?php
	include('templates/footer.php');
?>