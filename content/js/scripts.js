function addAnswer() {

	var answerDiv = document.getElementById("answers");

	var id = 0;

	var ans = answerDiv.firstElementChild;

	while(ans) {
		if(ans.innerHTML != undefined) 	id++;
		ans = ans.nextSibling;
	}

	if(id < 20) {
		var paragraph = document.createElement("p");
		paragraph.innerHTML += "<input type='text' name='answer[" + id + "]' placeholder='Insert answer..." + id + " '/>";

		answerDiv.appendChild(paragraph);
	}

}

function confirmDelete(id) {
    var r = confirm("Are you sure?");
    if (r == true) {
		window.location = 'delete_poll.php?id=' + id;
    } else {
        return;
    }
}
