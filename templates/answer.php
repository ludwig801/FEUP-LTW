<!-- Answer template block -->
<div class="answer-editor">
	<div class="row">
		<div class="col-lg-4">
			<div class="input-group">
				<input type="text" name="<?php if(isset($answerDescription) && isset($questionNum)) { echo 'answer[' . $questionNum . '][' . $answerNum . ']'; } ?>"
					value="<?php if(isset($answerDescription)) { echo $answerDescription; } ?>"
					class="form-control" placeholder="Insert answer..." required />
				<span class="input-group-addon"><a href="#" class="close delete-answer">&times;</a></span>
			</div>
		</div>
	</div>
</div>
<p/>