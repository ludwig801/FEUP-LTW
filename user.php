<?php 
	
	include_once('database/connection.php');
	include_once('database/polls.php');

	include('lock.php');
	include('templates/header.php');

	$params = array($db, $_SESSION['myid']);
	$result = getUserPolls($params);

?>

<h2> Hello, <?=$_SESSION['myusername']; ?> ( <a href="logout.php"> Logout </a> )</h2>

<p><a href="create_poll.php">Create new poll </a></p>

<table border="1">
	<caption> Your polls </caption>
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Description</th>
		<th>Public</th>
		<th>UserID</th>
		<th></th>
	</tr>

	<?php foreach($result as $row) { ?>
			<tr>
				<td><?=$row['id']?></td>
				<td><?=$row['title']?></td>
				<td><?=$row['description']?></td>
				<td><?=$row['public']?></td>
				<td><?=$row['user_id']?></td>
				<td><a href="#">Delete</a>
			</tr>
	<?php 	} ?>

</table>

<? include('templates/footer.php'); ?>