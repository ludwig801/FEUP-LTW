<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Stylesheets -->
		<!-- Bootstrap CSS CDN -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="content/css/style.css">
		
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

		<!-- Scripts -->
		<!-- jQuery CDN -->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<!-- Bootstrap scripts CDN -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
		<script src="content/js/scripts.js"></script>
		
		<title> POLL </title>
	</head>

	<body>
	
		<div class="container">

			<header></header>

			<!-- Show temporary messages -->
			<?php if(!empty($_SESSION['message'])) { ?>
				<div class='alert alert-success' role='alert'> <?= $_SESSION['message']; ?> </div>
				<?php unset($_SESSION['message']);
			} ?>