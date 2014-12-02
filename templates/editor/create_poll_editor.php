<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	<div class="panel panel-primary poll-block">

		<div class="panel-heading">
			<div class="panel-title">
				<?php 
					if(isset($_GET['id'])) {
						echo 'Edit Poll';
					} else {
						echo 'Create Poll';
					} ?>
				<a class="close" href="user.php">&times</a>
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
			
			<div class="row">
				<div class="col-lg-1">
					<div class="input-group">
						<span class="input-group-addon">Public</span>
						<div class="input-group-addon">
							<input type="checkbox" <?php if(isset($_POST['public']) && $_POST['public'] == 0) echo 'checked'; ?>/>
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
			<!-- Show errors -->
			<?php 
				if(isset($errors)) {
					foreach($errors as $err) {
						echo "<p class='error'> * $err </p>";
					} 
				}
			?>
			
			<div id="questions">
			</div>	
				
		</div>
		
		<div class="panel-footer">
			<!-- Submit -->
			<input type="submit" value="Save Poll" name="submit" class="btn btn-success"/>
			
			<!-- Cancel -->
			<a href="user.php"><input type="button" value="Cancel" class="btn btn-danger"></a>
		</div>
	</div>
</form>