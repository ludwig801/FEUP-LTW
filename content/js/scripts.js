function getNumberOfElements(parent, tag) {

	var id = 0;

	var childElem = parent.firstElementChild;

	while(childElem) {
		if(childElem.tagName == tag && childElem.innerHTML != undefined)
			id++;
		childElem = childElem.nextSibling;
	}
	
	return id;
}

function firstTagChild(parent, tag) {
	var toSearch = parent;
	
	return $(toSearch).find(tag).get(0);
}

function getInputElement(parent) {
	var toSearch = parent;

	return $(toSearch).find(':input').get(0);
}

function getQuestionID(answerDiv) {
	var panel = $(answerDiv).parents('.question-block');
	var panelBody = $(panel).children('.panel-body');	
	var inputTag = getInputElement(panelBody);
	var name = inputTag.name;	
	return name[name.length-2];
}

function addAnswer(answerDiv) {

	var parentID = getQuestionID(answerDiv);
	var num = getNumberOfElements(answerDiv, 'DIV'); // <-- must be in capital letters

	if(num < 10) { // <-- max 10 answers per question
	
		var answerBlock = document.createElement('div');
		answerDiv.appendChild(answerBlock);
		
		$.get('templates/answer.php', '', function(data) {
		
			answerBlock.innerHTML = data;
			
			var inputTag = getInputElement(answerBlock);
			inputTag.name = 'answer[' + parentID + '][' + num + ']';
			inputTag.placeholder += ' [' + parentID + '][' + num + ']';
			
		}, 'html');
	}
}

function addQuestion(questionsDiv) {
	var num = getNumberOfElements(questionsDiv, 'DIV'); // <-- must be in capital letters

	if(num < 5) { // <-- max 5 questions per poll
		var questionBlock = document.createElement('div');
		
		questionsDiv.appendChild(questionBlock);
		
		$.get('templates/question.php', '', function(data) {
			questionBlock.innerHTML = "" + data;
			
			// Adds variable name to input control.
			var inputTag = getInputElement(questionBlock);
			inputTag.name = 'question[' + num + ']';
			inputTag.placeholder += num;
			
			// Adds two initial questions.
			var answerDiv = firstTagChild(questionBlock, '#answers');
			addAnswer(answerDiv);
			addAnswer(answerDiv);
		}, 'html');
	}
}

// Shows a confirmation message that checks if the user really wants to delete a poll. 
function confirmDelete(id) {
    var r = confirm("Are you sure?");
    if (r == true) {
		window.location = 'delete_poll.php?id=' + id;
    } else {
        return;
    }
}

function draw(response) {
	alert(response);
}

function createAnswerBehaviours() {

	// Adds an answer to the div [panel-body] when the [Add Answer] button is pressed
	$(document).on('click', '.add-answer', function () {
	
		var panel = $(this).parents('.question-block');
		
		var answerDiv = $(panel).find('#answers').get(0);
		
		addAnswer(answerDiv);
		
		return false;
	});
	
	// Deletes an answer when the answer's [x] icon is pressed
	$(document).on("click", '.delete-answer', function () {
	
		$(this).parents("div.answer-editor:first").remove();
		
		return false;
	});
}

function createMinimizeBehaviourToQuestion() {
	// Minimizes a question from the editor. 
	// Each instance of the question editor should have the class "min-question", and must be placed inside a div container with the class "minimizable". 
	// The delete button must have the class "min-question".

	$(document).on("click", '.min-question', function () {
	
		var panel = $(this).parents(".minimizable");
		
		var showHideBtn = $(panel).find(".min-question");
		
		if(showHideBtn.html() == "Hide") {
			$(panel).children('.panel-body').hide();
			$(panel).children('.panel-footer').hide();
			
			showHideBtn.html("Show");
		}
		else {
			$(panel).children('.panel-body').show();
			$(panel).children('.panel-footer').show();
			
			showHideBtn.html("Hide");	
		}
		return false;
	});
}

function createAddQuestionBehaviour() {
	$(document).on('click','.add-question', function () {
		
		var panel = $(this).parents(".poll-block");
		
		var questionsDiv = $(panel).find('#questions').get(0);
		
		addQuestion(questionsDiv);

		return false;
	});
}

function getDetails(questionID) {

	console.log("id: " + questionID);

	var detailsData = $.ajax({
		type : "GET",
		url : "templates/details.php",
		data : "id=" + questionID,
		success: function (response) {
			var pollData = jQuery.parseJSON(response);
			
			//console.log(response);
			
			$(".details-title").html("" + pollData['poll']['description']);
			
			console.log(pollData['poll']);
			
			var detailsBody = $(".details-body").get(0);
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
				
				console.log(question);
				
				questionHeading.appendChild(questionTitle);
				panelDiv.appendChild(questionHeading);
				
				var answersBody = document.createElement('div');
				answersBody.className = 'panel-body';
				
				var answersList = document.createElement('ul');
				answersList.className = 'list-group';
				
				//console.log(pollData['answers']['3']);
					
				// Each answer within each question
				$.each(pollData['answers'][question['id']], function(questionIndex, answer) {
				
					console.log(answer);
				
					var answerItem = document.createElement('li');
					answerItem.className = 'list-group-item';
					
					answerItem.innerHTML = answer['description'];
					
					answersList.appendChild(answerItem);
					answersList.appendChild(document.createElement('p'));
				});
				
				answersBody.appendChild(answersList);
				
				panelDiv.appendChild(answersBody);
				
				detailsBody.appendChild(panelDiv);
			});
		}
	});
}

$(window).load(function() {

	createAnswerBehaviours();	
	createMinimizeBehaviourToQuestion();
	createAddQuestionBehaviour();
	
});


