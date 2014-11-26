<?php
	include_once('database/connection.php');
	include_once('database/polls.php');
	
	include('templates/header.php');
	
	if(isset($_GET['query'])) {
		$params = ['db' => $db, 'description' => $_GET['query']];
		$result = getPollsByDescription($params);
	} else {
		$result = getPublicPolls($db);
	}

?>

<form method="GET" action="public_polls.php">

	<input type="text" placeholder="Search poll..." name="query" />
	<input type="submit" value="Search" />
	
</form>

<table border="1">
	<caption> Public Polls </caption>
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>UserID</th>
		<th></th>
	</tr>

	<?php foreach($result as $row) { ?>
			<tr>
				<td><?=$row['id']?></td>
				<td><?=$row['description']?></td>
				<td><?=$row['user_id']?></td>
				<td><a href="answer_poll.php?id=<?=$row['id']?>">Answer</a></td>
			</tr>
	<?php 	} ?>

</table>

<? include('templates/footer.php'); ?>