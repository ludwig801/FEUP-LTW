<?php 
	
	include_once('database/connection.php');
	include('lock.php');

	include('templates/header.php');

?>

<h2> Hello, <?=$_SESSION['myusername']; ?> </h2>

<a href="logout.php"> Logout </a>


<a href="create_poll.php">Create poll dude </a>


<? include('templates/footer.php'); ?>