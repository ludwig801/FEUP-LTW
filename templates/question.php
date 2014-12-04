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
							title="Description must contain between 3 and 20 characters, including upper/lowercase, numbers and '_' symbol"
							pattern="\w?{3,20}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" 
							name=<?php if(isset($questionID)) { echo 'question[' . $questionID . ']'; } ?>
							value=<?php if(isset($questionDescription)) { echo $questionDescription; } ?> required autofocus/>
				</div>
			</div>
		</div>
		<p/>
		
		<div id="answers">
		
			<?php 
			
				$questParams = array('db' => $db, 'question_id' => $questionID);
				$tempAns = getQuestionAnswers($questParams);
				
				if(isset($tempAns)) {
					if(sizeof($tempAns) > 0) {
						$_POST['answer'] = $tempAns;
					}
				}
				
				if(isset($_POST['answer'])) {
				
					$answerNum = 0;
					foreach($_POST['answer'] as $row) {  
						$answerDescription = $row['description'];
						$answerQuestionID = $row['question_id'];
						include('templates/answer.php');
						$answerNum++;
					}

				}
				
			?>
		</div>
		
		<!-- Add answers -->
		<a href="#" class="add-answer">
			<input type="button" class="btn btn-default" value="Add Answer">
		</a>

	</div>
</div>