<?php
	
	include_once('database/connection.php');
	include_once('database/answers.php');
	include_once('database/polls.php');
	
	include('upload.php');
	
	include('lock.php');

	include('templates/header.php');

	if(isset($_POST['description']) && 
		isset($_POST['public']) &&
		isset($_POST['answer'])) {

		$stmt = $db->prepare('INSERT INTO polls VALUES (NULL, :description, :public, :user_id)');
		$stmt->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
		$stmt->bindParam(':public', $_POST['public'], PDO::PARAM_STR);
		$stmt->bindParam(':user_id', $_SESSION['myid'], PDO::PARAM_STR);

		$stmt->execute();

		foreach($_POST['answer'] as $ans) {
			$poll_id = getLastPollId($db);
			$params = ['db' => $db, 'description' => $ans, 'poll_id' => $poll_id];
			addAnswer($params);
		}

		$_SESSION['message'] = "Poll successfully created.";

		header("location: user.php");
	}

?>

<form method="post" action="" enctype="multipart/form-data">

	<p><input type="text" name="description" placeholder="The question..." /></p>

	<p><input type="radio" name="public" value="1" /> Public <input type="radio" name="public" value="0" /> Private </p>

	<p><a href="javascript: addAnswer()"> Add answer </a></p>

	<div id="answers">
	</div>
	
	<p><input type="file" name="image" id="image" title="No file selected" ></p>

	<p><input type="submit" value="Save" name="submit" /></p>

</form>

<p><a href="user.php"> Back </a></p>


