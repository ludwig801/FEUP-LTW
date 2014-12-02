// Adds a new answer to the editor.
// The answer will be all placed inside a div container with the id "answers". This container must exist before calling the function.
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

function getInputElement(parent) {

	//alert(parent);
	
	var toSearch = parent;

	return $(toSearch).find(':input').get(0);
}

function addAnswer(answerDiv) {
	
	var num = getNumberOfElements(answerDiv, 'DIV'); // <-- must be in capital letters

	if(num < 10) { // <-- max 10 answers per question
		var answerBlock = document.createElement('div');
		
		answerDiv.appendChild(answerBlock);
		
		$.get('templates/answer.php', '', function(data) {
			answerBlock.innerHTML = data;
			
			var inputTag = getInputElement(answerBlock);
		
			inputTag.name = 'answer[' + num + ']';
			
			inputTag.placeholder += num;
		}, 'html');
	}
}

function addQuestion(questionsDiv) {
	var num = getNumberOfElements(questionsDiv, 'DIV'); // <-- must be in capital letters

	if(num < 20) { // <-- max 20 questions per poll
		var questionBlock = document.createElement('div');
		
		questionsDiv.appendChild(questionBlock);
		
		$.get('templates/question.php', '', function(data) {
			questionBlock.innerHTML = "" + data;
			
			var inputTag = getInputElement(questionBlock);
		
			inputTag.name = 'description[' + num + ']';
			
			inputTag.placeholder += num;
		}, 'html');
	}
}

function addExistingAnswer(answer, id) {

	var answerDiv = document.getElementById('answers');

	var paragraph = document.createElement('p');
	//paragraph.innerHTML += "<div class='answer-editor'><input type='text' name='answer[" + id + "]' placeholder='Insert answer...'" + "required/><a class='close delete-answer' href='#'>&times;</a></div>";

	paragraph.innerHTML += '<div class="answer-editor"> <div class="row"> <div class="col-lg-6"> <div class="input-group">\
						<input type="text" class="form-control" name="answer[' + id + ']" value="' + answer + '" placeholder="Insert new answer..." required />\
						<span class="input-group-addon"><a href="#" class="close delete-answer">&times;</a></span>\
						</div> </div> </div> </div>';
					
	answerDiv.appendChild(paragraph);
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

$(window).load(function() {

	createAnswerBehaviours();
	
	createMinimizeBehaviourToQuestion();
	
	createAddQuestionBehaviour();
	
});


