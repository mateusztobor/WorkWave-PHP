function commentReaction(postId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                commentReaction_handleResponse(response.status, response.reactions, postId);
            } else alert('Wystąpił nieoczekiwany błąd.');
        }
    };
    xhr.open("GET", "{jsp$url}/ajax/commentReaction/" + postId, true);
    xhr.send();
}
function commentReaction_handleResponse(status, reactions, postId) {
    var postReactionElement = document.getElementById("comment_" + postId + "_reaction");
    if (status) {
		if(document.getElementById("comment_" + postId + "_reaction")) {
			var postReactionElement = document.getElementById("comment_" + postId + "_reaction");
			postReactionElement.classList.remove("text-body-secondary");
			postReactionElement.classList.add("text-danger");
			postReactionElement.setAttribute("data-bs-original-title", "Nie lubię"); 
			if(document.getElementById("comment_" + postId + "_reaction_heart")) {
				document.getElementById("comment_" + postId + "_reaction_heart").classList.remove("fa-regular");
				document.getElementById("comment_" + postId + "_reaction_heart").classList.add("fa-solid");
			}
		}
    } else {
		if(document.getElementById("comment_" + postId + "_reaction")) {
			var postReactionElement = document.getElementById("comment_" + postId + "_reaction");
			postReactionElement.classList.remove("text-danger");
			postReactionElement.classList.add("text-body-secondary");
			postReactionElement.setAttribute("data-bs-original-title", "Lubię to");
			if(document.getElementById("comment_" + postId + "_reaction_heart")) {
				document.getElementById("comment_" + postId + "_reaction_heart").classList.remove("fa-solid");
				document.getElementById("comment_" + postId + "_reaction_heart").classList.add("fa-regular");
			}
		}
    }
	if(document.getElementById("comment_" + postId + "_reaction_count")) {
		document.getElementById("comment_" + postId + "_reaction_count").innerHTML = reactions;
	}

}