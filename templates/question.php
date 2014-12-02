<!-- Question block -->
<div class="panel panel-primary minimizable question-block">

	<div class="panel-heading">
		<div class="panel-title">
			<div class="btn btn-default min-question">Hide</div>
		</div>
	</div>
	
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-4">
				<div class="input-group">
					<span class="input-group-addon">Question</span>
					<input class="form-control" id="inputDescription" type="text" placeholder="Insert the question..."
							value="<?php if(isset($_POST['description'])) { echo $_POST['description']; } ?>"
							title="Description must contain between 3 and 20 characters, including upper/lowercase, numbers and '_' symbol"
							pattern="\w?{3,20}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" required autofocus/>
				</div>
			</div>
		</div>
		<p/>
		
		<!--<p><input type="file" name="image" id="image" title="No file selected" ></p>-->
		
		<div id="answers">
		</div>
		
		<!-- Inserts the answers for a question -->
		<?php
			if(isset($_POST['answers']) && count($_POST['answers'] > 0)) {
				foreach($_POST['answers'] as $row) {
					//echo '<script> addExistingAnswer("' . $row['description'] . '",' . $row['id'] . '); </script>';
				}
			}
			else {
					//echo ' <script> addAnswer(); addAnswer(); </script>';
			}
		?>
		
		<!-- Add answers -->
		<a href="#" class="add-answer">
			<input type="button" class="btn btn-default" value="Add Answer">
		</a>
	</div>
</div>