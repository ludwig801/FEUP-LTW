<?php
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');
	
	include('lock.php');

	include('templates/header.php');
	include('templates/navbar.php');

	if(isset($_GET['id'])) {
		$params = ['db' => $db, 'id' => $_GET['id']];
		$result = getPollById($params);
		$answers = getPollAnswers($params);
	}

?>

<div class="panel panel-primary" >

	<div class="panel-heading">
		<h2 class="panel-title">
			<?=$result['description']?>
			<a class="close" href="user.php">&times</a>
		</h2>
	</div>
	
	<div class="panel-footer">
	
		<div class="panel panel-default">
		
			<div class="panel-heading">Answers</div>
			
			<table class="table">
				<?php foreach($answers as $row) { ?>
					<tr><td>
						<?=$row['description'] ?>
					</td></tr>
				<?php } ?>
			</table>
			
		</div>
	
	</div>

</div>

<?php include('templates/footer.php'); ?>