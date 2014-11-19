<?php
	
	include_once('database/connection.php');
	include('lock.php');

	include('templates/header.php');

	if(isset($_POST['title']) && 
		isset($_POST['description']) && 
		isset($_POST['public'])) {

		$stmt = $db->prepare('INSERT INTO polls VALUES (NULL, :title, :description, :public, :user_id)');
		$stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
		$stmt->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
		$stmt->bindParam(':public', $_POST['public'], PDO::PARAM_STR);
		$stmt->bindParam(':user_id', $_SESSION['myid'], PDO::PARAM_STR);

		$stmt->execute();

		$_SESSION['message'] = "Poll successfully created.";

		header("location: user.php");
	}

?>

<form method="POST" action="">

	<p><input type="text" name="title" placeholder="Título" /></p>
	<p><input type="text" name="description" placeholder="Descrição" /></p>

	<p><input type="radio" name="public" value="true" /> Public <input type="radio" name="public" value="false" /> Private </p>

	<input type="submit" value="Guardar" />

</form>

<p><a href="user.php"> Back </a></p>


