<?php

	include_once('database/connection.php');
	include_once('database/users.php');

	$result = getAllUsers($db);

	include('templates/header.php');
?>

	<h2> lel, an admin page, just to manage stuff </h2>

	<div id="the-admins">

		<p> AMMINISTRATORI </p>

		<img src="content/images/admin1.jpg" />
		<img src="content/images/admin2.jpg" />
		<img src="content/images/admin3.jpg" />

	</div>

	<h3> followers </h3>
	
	<table>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Name</th>
			<th>E-mail</th>
			<th>Password</th>
			<th></th>
		</tr>
	
		<?php foreach($result as $row) { ?>
				<tr>
					<td><?=$row['id']?></td>
					<td><?=$row['username']?></td>
					<td><?=$row['name']?></td>
					<td><?=$row['email']?></td>
					<td><?=$row['password']?></td>
				</tr>
		<?php 	} ?>

	</table>

<?php include('templates/footer.php'); ?>