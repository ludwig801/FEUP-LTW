<input type="hidden" value="<?=$_GET['id']?>" name="id" />
<input type="hidden" value="<?=$_SESSION['myid']?>" name="user_id" />

<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">
			Answer Poll
			<a class="close" href="public_polls.php">&times</a>
		</div>
	</div>
	
	<div class="panel-body">

		<div class="panel panel-default">

			<div class="panel-heading">
				<div class="panel-title">
					<?=$result['description']?>
					<a class="close" href="public_polls.php">&times</a>
				</div>
			</div>
			
			<div class="panel-body">
					<?php foreach($questions as $row) {
						echo '<div class="row">
								<div class="col-lg-6">
									<div class="input-group">' . $row["description"] . '</div>
								  </div>
								</div><p/>';
						
						$params['question_id'] = $row['id'];
						$answers = getQuestionAnswers($params);
						
						echo '<div class="panel panel-default"><div class="panel-body">';
							foreach($answers as $ans) { ?>
							
								<div class="row">
									<div class="col-lg-6">
										<div class="input-group"><label><input class="answer-radio" type="radio" value="<?= $ans["id"] ?>" name="answer[<?=$row['id']?>]"> <?= $ans["description"] ?> </label></div>
									  </div>
									</div><p/>
							<?php }
						echo '</div></div>';
					} ?>
			</div>
			
			<div class="panel-footer">
			
				<input class="btn btn-primary" type="submit" value="Send" />
			
			</div>
			
		</div>
		
	</div>

</div>