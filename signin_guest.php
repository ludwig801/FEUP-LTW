<?php 

	include_once('database/connection.php');
	include('templates/header.php');

	session_start();

	$_SESSION['myusername'] = 'GUEST';
	$_SESSION['myname'] = 'GUEST';
	$_SESSION['myemail'] = 'NO_EMAIL';
	$_SESSION['guest'] = true;

	header("location: user.php");
?>