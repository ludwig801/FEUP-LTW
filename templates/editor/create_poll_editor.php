<div class="panel panel-primary poll-block">

	<div class="panel-heading">
	
		<!-- Check if we are creating a new poll or editing an existing one -->
		<div class="panel-title">
			<?php 
				if(isset($_GET['id'])) {
					echo 'Edit Poll';
				} else {
					echo 'Create Poll';
				} ?>
			<a class="close" href="user.php">&times;</a>
		</div>
		<p/>
		
		<!-- Poll settings block -->
		<div class="input-group">
			<!--<span class="input-group-info">Title</span>-->
			<input class="form-control" id="inputPollTitle" type="text" name="pollTitle" placeholder="Insert the poll title..."
						value="<?php if(isset($_POST['pollTitle'])) { echo $_POST['pollTitle']; } ?>"
						title="Title must contain between 3 and 20 characters, including upper/lowercase, numbers and '_' symbol"
						pattern="\w?{3,20}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" required autofocus />
		</div>
		<p/>
		<p/>
		

		<!-- Choose poll privacy settings -->
		<div class="row">
			<div class="col-lg-1">
				<div class="input-group">
					<span class="form-control">Public</span>
					<div class="input-group-addon">
						<input type="radio" name="public" value="1" <?php if(isset($_POST['public'])) { if($_POST['public'] == 1) echo 'checked'; }  ?>/>
					</div>
					<span class="form-control">Private</span>
					<div class="input-group-addon">
						<input type="radio" name="public" value="0" <?php if(isset($_POST['public'])) { if($_POST['public'] == 0) echo 'checked'; } else echo 'checked';?>/>
					</div>
				</div>
			</div>
		</div>
		
		<p/>
		<p/>
		
		<!-- Add Question -->
		<a href="javascript: addQuestion()"><input type="button"  value="Add Question" class="btn btn-default add-question"/></a>
		<p/>
		
	</div>
	
	<div class="panel-body">
	
		<?php include('templates/show_errors.php'); ?>
	
		<div id="questions">
			
			<!-- If there exists questions -->
			<?php if(isset($_POST['question'])) {
				$questionNum = 0;
				foreach($_POST['question'] as $row) {  
					if(isset($row['description'])) {
						$questionDescription = $row['description'];
						$questionID = $row['id'];
					} else {
						$questionDescription = $row;
						$questionID = $questionNum;
					}

					include('templates/question.php');
					$questionNum++;
				}
			} ?>
			
		</div>
		
	</div>
	
	<!-- Form buttons -->
	<div class="panel-footer">
		<!-- Submit -->
		<input type="submit" value="Save Poll" name="submit" class="btn btn-success"/>
		
		<!-- Cancel -->
		<a href="user.php"><input type="button" value="Cancel" class="btn btn-danger"></a>
	</div>
	
</div>