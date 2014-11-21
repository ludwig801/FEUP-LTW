<?php
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');

	include('templates/header.php');

	if(isset($_GET['id'])) {
		$params = ['db' => $db, 'id' => $_GET['id']];
		$result = getPollById($params);
		$answers = getPollAnswers($params);
	}

?>

<h2> Poll Details </h2>

<h3> <?= $result['description'] ?> </h3>

<?php foreach($answers as $row) { ?>
	<p><?= $row['description'] ?></p>
<?php } ?>

<?php include('templates/footer.php'); ?>