<?php 
	
	include_once('database/connection.php');
	include('lock.php');

	include('templates/header.php');

?>

<h2> Hello, <?=$_SESSION['myusername']; ?> </h2>

<a href="logout.php"> Logout </a>


<? include('templates/footer.php'); ?>