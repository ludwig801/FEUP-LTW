<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="content/css/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="content/images/polls_icon_other.ico">
		
		<script src="content/js/scripts.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
		<title> Polling System </title>
	</head>

	<body>
	
		<div class="container">

			<header></header>

			<!-- Show temporary messages -->
			<?php if(!empty($_SESSION['message'])) { ?>
				<div class="message"> <?= $_SESSION['message']; ?> </div>
				<?php unset($_SESSION['message']);
			} ?>