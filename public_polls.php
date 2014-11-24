<?php
	include_once('database/connection.php');
	include_once('database/polls.php');
	
	include('templates/header.php');
	
	$result = getPublicPolls($db);
	
?>

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