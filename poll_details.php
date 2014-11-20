<?php
	
	include_once('database/connection.php');
	include_once('database/polls.php');

	include('templates/header.php');

	if(isset($_GET['id'])) {
		$params = ['db' => $db, 'id' => $_GET['id']];
		$result = getPollById($params);
	}

?>

<h2> Poll Details </h2>

<h3> <?= $result['description'] ?> </h3>

<?php include('templates/footer.php'); ?>