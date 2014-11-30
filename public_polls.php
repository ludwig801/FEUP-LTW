<?php
	include_once('database/connection.php');
	include_once('database/polls.php');
	
	include('lock.php');
	
	include('templates/header.php');
	include('templates/navbar.php');
	
	if(isset($_GET['query'])) {
		$params = ['db' => $db, 'description' => $_GET['query']];
		$result = getPollsByDescription($params);
	} else {
		$result = getPublicPolls($db);
	}
?>

<div class="panel panel-primary">

	<div class="panel-heading">Public Polls</div>
		<table class="table">
		
			<tr>
				<!--<th>ID</th>-->
				<th>Description</th>
				<th>Creator</th>
				<th></th>
			</tr>

			<?php foreach($result as $row) { ?>
				<tr>
					<!--<td><?=$row['id']?></td>-->
					<td><?=$row['description']?></td>
					<td><?=$row['user_id']?></td>
					<td><a href="answer_poll.php?id=<?=$row['id']?>">Answer</a></td>
				</tr>
			<?php 	} ?>
	
		</table>
	</div>
</div>

<?php include('templates/footer.php'); ?>