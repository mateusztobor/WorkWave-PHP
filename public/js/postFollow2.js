function postFollow(postId) {
	if(confirm("Czy na pewno chcesz usunąć ten wpis z listy obserwowanych?")) {
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
}
function postFollow_handleResponse(status, follows, postId) {
    var postReactionElement = document.getElementById("post_" + postId + "_reaction");
	if(document.getElementById("post_" + postId))
		document.getElementById("post_" + postId).remove();
	initTooltips();
}