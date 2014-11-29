<?php
	
	include_once('database/connection.php');
	include_once('database/answers.php');
	include_once('database/polls.php');
	
	include('lock.php');
	// include('upload.php');


	if(isset($_POST['description']) && 
		isset($_POST['public']) &&
		isset($_POST['answer'])) {
		
		$pollParams = array('db' => $db, 'description' => $_POST['description'], 'public' => $_POST['public'], 'myid' => $_SESSION['myid']);
		addPoll($pollParams);
		
		foreach($_POST['answer'] as $ans) {
			$poll_id = getLastPollId($db);
			$ansParams = array('db' => $db, 'description' => $ans, 'poll_id' => $poll_id);
			addAnswer($ansParams);
		}

		$_SESSION['message'] = "Poll successfully created.";

		header("location: user.php");
	}
	
	include('templates/header.php');
	include('templates/navbar.php');

?>

<form class="form-create-poll" role="form" method="post" action="" enctype="multipart/form-data">
	<fieldset>
	
		<label for="inputDescription">Question</label>
		<input id="inputDescription" type="text" name="description" placeholder="Insert the question..." class="form-control" required/>

		<label>
			<input type="radio" name="public" value="1"/> Public 
		</label>
		<label>
			<input type="radio" name="public" value="0"/> Private
		</label>

		<p><a href="javascript: addAnswer()"><input type="button" class="btn btn-default" value="Add answer"></a></p>

		<div id="answers">
		</div>
		
		<!--<p><input type="file" name="image" id="image" title="No file selected" ></p>-->

		<input type="submit" value="Save" name="submit" class="btn btn-lg btn-primary"/>
		<a href="user.php"><input type="submit" value="Cancel" class="btn btn-lg btn-primary"></a>
		
	</fieldset>
</form>


<?php include('templates/footer.php'); ?>


