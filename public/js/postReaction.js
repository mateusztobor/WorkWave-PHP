function postReaction(postId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                postReaction_handleResponse(response.status, response.reactions, postId);
            } else alert('Wystąpił nieoczekiwany błąd.');
        }
    };
    xhr.open("GET", "{jsp$url}/ajax/postReaction/" + postId, true);
    xhr.send();
}
function postReaction_handleResponse(status, reactions, postId) {
    var postReactionElement = document.getElementById("post_" + postId + "_reaction");
    if (status) {
		if(document.getElementById("post_" + postId + "_reaction")) {
			var postReactionElement = document.getElementById("post_" + postId + "_reaction");
			postReactionElement.classList.remove("text-body-secondary");
			postReactionElement.classList.add("text-danger");
			postReactionElement.setAttribute("data-bs-original-title", "Nie lubię"); 
			if(document.getElementById("post_" + postId + "_reaction_heart")) {
				document.getElementById("post_" + postId + "_reaction_heart").classList.remove("fa-regular");
				document.getElementById("post_" + postId + "_reaction_heart").classList.add("fa-solid");
			}
		}
    } else {
		if(document.getElementById("post_" + postId + "_reaction")) {
			var postReactionElement = document.getElementById("post_" + postId + "_reaction");
			postReactionElement.classList.remove("text-danger");
			postReactionElement.classList.add("text-body-secondary");
			postReactionElement.setAttribute("data-bs-original-title", "Lubię to");
			if(document.getElementById("post_" + postId + "_reaction_heart")) {
				document.getElementById("post_" + postId + "_reaction_heart").classList.remove("fa-solid");
				document.getElementById("post_" + postId + "_reaction_heart").classList.add("fa-regular");
			}
		}
    }
	if(document.getElementById("post_" + postId + "_reaction_count")) {
		document.getElementById("post_" + postId + "_reaction_count").innerHTML = reactions;
	}

}