<?php
	
	include_once('database/connection.php');

	if(isset($_POST['title']) && 
		isset($_POST['description']) && 
		isset($_POST['public'])) {

		$stmt = $db->prepare('INSERT INTO polls VALUES (NULL, :title, :description, :public)');
		$stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
		$stmt->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
		$stmt->bindParam(':public', $_POST['public'], PDO::PARAM_STR);
		
		$stmt->execute();

	}

	include('templates/header.php');

?>

<form method="POST" action="">

	<p><input type="text" name="title" placeholder="Título" /></p>
	<p><input type="text" name="description" placeholder="Descrição" /></p>

	<p><input type="radio" name="public" value="true" /> Public </p>
	<p><input type="radio" name="public" value="false" /> Private </p>

	<input type="submit" value="Guardar" />

</form>


