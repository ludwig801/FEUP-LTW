<?php
	include_once('database/connection.php');
	include_once('database/polls.php');
	include_once('database/poll_answers.php');
	include_once('database/answers.php');
	include_once('database/questions.php');
	
	include('lock.php');
	include('templates/header.php');
	include('templates/navbar.php');
	
	$poll_id = $_GET['id'];
	$filter = $_GET['filter'];
	
	include_once('templates/validation/view_poll_detailed_validation.php');
	
	$params = array('db' => $db, 'poll_id' => $poll_id, 'id' => $poll_id, 'user_id' => $_SESSION['myid']);
	
	$errors = validateDetailedView($params);
	
	if(sizeof($errors) > 0) {
		header("location: user.php");
	}
?>

<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

	// Load the Visualization API and the piechart package.
	google.load('visualization', '1.0', {'packages':['corechart']});

	// Set a callback to run when the Google Visualization API is loaded.
	google.setOnLoadCallback(drawPoll);

	// Callback that creates and populates a data table,
	// instantiates the pie chart, passes in the data and
	// draws it.
	function drawPoll() {

		// Create the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Topping');
		data.addColumn('number', 'Slices');
		data.addRows([
		  ['Mushrooms', 3],
		  ['Onions', 1],
		  ['Olives', 1],
		  ['Zucchini', 1],
		  ['Pepperoni', 2]
		]);
		
		$.ajax({
			type : "GET",
			url : "templates/details.php",
			data : "id=" + <?=$poll_id?>,
			success: function (response) {
				var pollData = jQuery.parseJSON(response);
				
				$(".panel-title").html("" + pollData['poll']['description']);
				
				var detailsBody = $(".panel-body").get(0);
				$(detailsBody).html('');
				
				// Each Question
				$.each(pollData['questions'], function(index, question) {
				
					var panelDiv = document.createElement('div');
					panelDiv.className = 'panel panel-primary';
					
					var questionHeading = document.createElement('div');
					questionHeading.className = 'panel-heading';
					
					var questionTitle = document.createElement('div');
					questionTitle.className = 'panel-title';
					
					questionTitle.innerHTML = question['description'];
					
					questionHeading.appendChild(questionTitle);
					panelDiv.appendChild(questionHeading);
					
					var answersBody = document.createElement('div');
					answersBody.className = 'panel-body';
					
					if(pollData['answers'][question['id']].length > 0) {
						// Create the data table.
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Answer');
						data.addColumn('number', 'Number');
							
						// Each answer within each question
						$.each(pollData['answers'][question['id']], function(questionIndex, answer) {
					
							var answerDescr = answer['description'];
							var numAnswers = pollData['poll_answers'][question['id']][answer['id']];	

							data.addRows([[answerDescr, numAnswers]]);
						});
						
						// Set chart options
						var options = {'width':250,
									   'height':200};

						// Instantiate and draw our chart, passing in some options.
						var chart = new google.visualization.PieChart(answersBody);
						chart.draw(data, options);
						
						panelDiv.appendChild(answersBody);
					}

					detailsBody.appendChild(panelDiv);
				});
			}
		});
	 }
</script>
	
<div class="panel panel-primary">
	
	<div class="panel-heading">
		<div class="panel-title"></div>
	</div>
	
	<div class="panel-body">
	</div>
	
	<div class="panel-footer">
		<a href="user.php?filter=<?=$filter?>"><button class="btn btn-primary">Back</button></a> 
	</div>

</div>
