function postFollow(postId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                postFollow_handleResponse(response.status, response.follows, postId);
            } else alert('Wystąpił nieoczekiwany błąd.');
        }
    };
    xhr.open("GET", "{jsp$url}/ajax/postFollow/" + postId, true);
    xhr.send();
}
function postFollow_handleResponse(status, follows, postId) {
    var postReactionElement = document.getElementById("post_" + postId + "_reaction");
    if (status) {
		if(document.getElementById("post_" + postId + "_follow")) {
			var postReactionElement = document.getElementById("post_" + postId + "_follow");
			postReactionElement.classList.remove("text-body-secondary");
			postReactionElement.classList.add("text-primary");
			postReactionElement.setAttribute("data-bs-original-title", "Przestań obserwować"); 
		}
    } else {
		if(document.getElementById("post_" + postId + "_follow")) {
			var postReactionElement = document.getElementById("post_" + postId + "_follow");
			postReactionElement.classList.remove("text-primary");
			postReactionElement.classList.add("text-body-secondary");
			postReactionElement.setAttribute("data-bs-original-title", "Obserwuj"); 
		}
    }
	if(document.getElementById("post_" + postId + "_follow_count")) {
		document.getElementById("post_" + postId + "_follow_count").innerHTML = follows;
	}
}