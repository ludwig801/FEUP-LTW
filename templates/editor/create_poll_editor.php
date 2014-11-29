<form class="form-create-poll" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	<fieldset>
	
		<!-- Show errors -->
		<?php foreach($errors as $err) {
				echo "<p class='error'> * $err </p>";
			  } 
		?>
		
		<!-- Description -->
		<label for="inputDescription">Question</label>
		<input id="inputDescription" type="text" name="description" placeholder="Insert the question..." class="form-control" 
				title="Description must contain between 3 and 20 characters, including upper/lowercase, numbers and '_' symbol"
				pattern="\w{3,20}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" required autofocus />

		<!-- Privacy setting -->
		<label>
			<input type="radio" name="public" value="1"/> Public 
		</label>
		<label>
			<input type="radio" name="public" value="0"/> Private
		</label>
	
		<!-- Possible answers -->
		<p><a href="javascript: addAnswer()"><input type="button" class="btn btn-default" value="Add answer"></a></p>

		<div id="answers">
		</div>
		<!--<p><input type="file" name="image" id="image" title="No file selected" ></p>-->

		<!-- Submit -->
		<input type="submit" value="Save" name="submit" class="btn btn-lg btn-primary"/>
		<a href="user.php"><input type="submit" value="Cancel" class="btn btn-lg btn-primary"></a>
		
	</fieldset>
</form>