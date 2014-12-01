<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	<div class="panel panel-primary">

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
			
			<!-- Description -->
			
			<div class="input-group">
				<span class="input-group-addon">Question</span>
				<input id="inputDescription" type="text" name="description" placeholder="Insert the question..." class="form-control" 
				value="<?php if(isset($_POST['description'])) { echo $_POST['description']; } ?>"
				title="Description must contain between 3 and 20 characters, including upper/lowercase, numbers and '_' symbol"
				pattern="\w?{3,20}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" required autofocus />
			</div>
			<p/>
			
			<div class="row">
				<div class="col-lg-1">
					<div class="input-group">
						<span class="input-group-addon">Public</span>
						<div class="input-group-addon">
							<input type="radio" name="public" value="1" <?php if(isset($_POST['public']) && $_POST['public'] == 1) echo 'checked'; ?>/>
						</div>
						<span class="input-group-addon">Private</span>
						<div class="input-group-addon">
							<input type="radio" name="public" value="0" <?php if(isset($_POST['public']) && $_POST['public'] == 0) echo 'checked'; ?>/>
						</div>
					</div>
				</div>
			</div>
			<p/>
			
			<!--<p><input type="file" name="image" id="image" title="No file selected" ></p>-->
			<div id="answers">
			</div>
			<p/>
			
			<?php
			
				if(isset($_POST['answers']) && count($_POST['answers'] > 0)) {
					foreach($_POST['answers'] as $row) {
				
						echo '<script> addExistingAnswer("' . $row['description'] . '",' . $row['id'] . '); </script>';
					}
				}
				else {
					?>
						<script>
							addAnswer();
							addAnswer();
						</script>
					<?php
				}
			?>
			
			
		
			<!-- Possible answers -->
			<p><a href="javascript: addAnswer()"><input type="button" class="btn btn-default" value="+"></a></p>
		</div>
		
		<div class="panel-footer">
			<!-- Submit -->
			<input type="submit" value="Save" name="submit" class="btn btn-success"/>
			
			<!-- Cancel -->
			<a href="user.php"><input type="button" value="Cancel" class="btn btn-danger"></a>
			
		</div>
	</div>
</form>