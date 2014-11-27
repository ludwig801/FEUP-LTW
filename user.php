<?php 
	
	include_once('database/connection.php');
	include_once('database/polls.php');

	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');

	$params = array($db, $_SESSION['myid']);
	$result = getUserPolls($params);

?>

<div class="panel panel-default">

	<div class="panel-heading">My Polls</div>
	<table class="table">
		<tr>
			<th>Description</th>
			<th>Public</th>
			<th>Answers</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>

		<?php foreach($result as $row) { ?>
				<tr>
					<td><?=$row['description']?></td>
					<td><?=$row['public']?></td>
					<td><?=$row['number_of_answers']?></td>
					<td><a href="results.php?id=<?=$row['id']?>">View Answers</a></td>
					<td><a href="edit_poll.php?id=<?=$row['id']?>">Edit</a></td>
					<td><a href="javascript: confirmDelete(<?=$row['id']?>);">Delete</a></td>
					<td><a href="poll_details.php?id=<?=$row['id']?>">Details</a></td>
				</tr>
		<?php 	} ?>

	</table>
	
</div>


<?php include('templates/footer.php'); ?>