<?php 
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	include('lock.php');

	$result = getUserPolls($db);

	include('templates/header.php');

?>

<h2> Hello, <?=$_SESSION['myusername']; ?> </h2>

<a href="logout.php"> Logout </a>


<a href="create_poll.php">Create poll dude </a>

<table>
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Description</th>
		<th>Public</th>
		<th></th>
	</tr>

	<?php foreach($result as $row) { ?>
			<tr>
				<td><?=$row['id']?></td>
				<td><?=$row['title']?></td>
				<td><?=$row['description']?></td>
				<td><?=$row['public']?></td>
			</tr>
	<?php 	} ?>

</table>


<? include('templates/footer.php'); ?>