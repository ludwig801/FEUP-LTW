<?php
	
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/answers.php');

	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');
	
	
	if(isset($_POST['description']) && isset($_POST['public']) && isset($_POST['id']) && isset($_POST['poll_id']) && isset($_POST['answer'])) {
	
		$params = ['db' => $db, 'id' => $_POST['id'], 'description' => $_POST['description'], 'public' => $_POST['public'], 'poll_id' => $_POST['poll_id']];
		editPoll($params);
		deleteAllPollAnswers($params);
		
		foreach($_POST['answer'] as $ans) {
			$poll_id = getLastPollId($db);
			$vars = ['db' => $db, 'description' => $ans, 'poll_id' => $poll_id];
			addAnswer($vars);
		}
	
		$_SESSION['message'] = "Poll successfully edited.";
		
		header("location: user.php");
		
	} else if(isset($_GET['id'])) {
	
		$params = ['db' => $db, 'id' => $_GET['id']];
		$result = getPollById($params);
		$answers = getPollAnswers($params);
		
	} else {
	
		$_SESSION['message'] = "Poll not found.";
		
		header("location: user.php");
	}

?>

<form method="POST" action"edit_poll.php">

	<div class="panel panel-primary">
	
		<input type="hidden" value="<?=$_GET['id']?>" name="id" />

		<div class="panel-heading">
			<div class="panel-title">
				Edit Poll
				<a class="close" href="user.php">&times</a>
			</div>
		</div>
		
		<div class="panel-body">
			<p>
				<div class="input-group">
					<span class="input-group-addon">Question</span>
					<input type="text" class="form-control" name="description" value="<?= $result['description'] ?>" placeholder="The question..." />
				</div>
			</p>
			
			<p>
				<div class="row">
					<div class="col-lg-2">
						<div class="input-group">
							<span class="input-group-addon">Public</span>
							<span class="input-group-addon">
								<input type="radio" name="public" value="1"/>
							</span>
							<span class="input-group-addon">Private</span>
							<span class="input-group-addon">
								<input type="radio" name="public" value="0" checked/>
							</span>
						</div>
					</div>
				</div>
			</p>
	
			<p> Possible answers: </p>
				
			<div id="answers">
			
				<?php
					$count = 0;
					foreach($answers as $row) { 
				?>
					<p><input type='text' name='answer[<?= $count ?>]' value='<?=$row["description"]?>' placeholder="Insert answer... <?= $count ?>" /></p>
					<?php $count++; ?>
				<?php } ?>
				
			</div>
			
			<p><a href="javascript: addAnswer();"> Add answer </a></p>
			
			<input type="hidden" name="poll_id" value=<?= $result['id']?> />
			
			<p><input type="submit" value="Save" /></p>
			
		</div>
		
	</div>

</form>
	

<?php include('templates/footer.php'); ?>