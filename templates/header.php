<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" >
		<link rel="stylesheet" href="css/style.css" >
		<link rel="shortcut icon" type="image/x-icon" href="content/images/polls_icon_other.ico">
		<script src="content/js/scripts.js"></script>
		<title> Polling System </title>
	</head>

	<body>

		<head>
			<h1><a href="index.php"> POLLING SYSTEM </a></h1>
		</head>

		<!-- Show temporary messages -->
		<?php if(!empty($_SESSION['message'])) { ?>
			<div class="message"> <?= $_SESSION['message']; ?> </div>
			<?php unset($_SESSION['message']);
		} ?>