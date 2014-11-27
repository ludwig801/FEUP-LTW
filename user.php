<?php 
	
	include_once('database/connection.php');
	include_once('database/polls.php');

	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');

	$params = array($db, $_SESSION['myid']);
	$result = getUserPolls($params);

?>

<p><a href="create_poll.php">Create new poll </a></p>

<table border="1">
	<caption> Your polls </caption>
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Public</th>
		<th>UserID</th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
	</tr>

	<?php foreach($result as $row) { ?>
			<tr>
				<td><?=$row['id']?></td>
				<td><?=$row['description']?></td>
				<td><?=$row['public']?></td>
				<td><?=$row['user_id']?></td>
				<td><a href="results.php?id=<?=$row['id']?>">Show Answers</a></td>
				<td><a href="edit_poll.php?id=<?=$row['id']?>">Edit</a></td>
				<td><a href="javascript: confirmDelete(<?=$row['id']?>);">Delete</a></td>
				<td><a href="poll_details.php?id=<?=$row['id']?>">Details</a></td>
			</tr>
	<?php 	} ?>

</table>

<?php include('templates/footer.php'); ?>