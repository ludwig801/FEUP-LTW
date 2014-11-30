// Adds a new answer to the editor.
// The answer will be all placed inside a div container with the id "answers". This container must exist before calling the function.
function getNumberOfElements(parent) {

	var id = 0;

	var childElem = parent.firstElementChild;

	while(childElem) {
		if(childElem.innerHTML != undefined) 	id++;
		childElem = childElem.nextSibling;
	}
	
	return id;
}

function addAnswer() {

	var answerDiv = document.getElementById('answers');
	
	var num = getNumberOfElements(answerDiv);

	if(num < 20) {
		var paragraph = document.createElement('p');
		//paragraph.innerHTML += "<div class='answer-editor'><input type='text' name='answer[" + id + "]' placeholder='Insert answer...'" + "required/><a class='close delete-answer' href='#'>&times;</a></div>";

		paragraph.innerHTML += '<div class="answer-editor"> <div class="row"> <div class="col-lg-6"> <div class="input-group">\
							<input type="text" class="form-control" name="answer[' + num + ']" placeholder="Insert answer..." required />\
							<span class="input-group-addon"><a href="#" class="close delete-answer">&times;</a></span>\
							</div> </div> </div> </div>';
						
		answerDiv.appendChild(paragraph);
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

// Deletes an answer from the editor. 
// Each instance of an answer editor should have the class "answer-editor", and must be placed inside a div container with the ID "answers". 
// The delete button must have the class "delete-answer".
$(window).load(function() {
	$('#answers').on("click", '.delete-answer', function () {
		$(this).parents("div.answer-editor:first").remove();
		return false;
	});
});


