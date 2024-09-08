function modDelPost(postId,redirect=false) {
	if(confirm('Czy na pewno chesz usunąć ten wpis?')) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				var response = JSON.parse(xhr.responseText);
				if (response.success) {
					if(redirect)
						window.location.replace("{jsp$url}/moderator");
					else
						document.getElementById('post_' + postId).remove();
				} else alert('Wystąpił nieoczekiwany błąd.');
			}
		};
		xhr.open("GET", "{jsp$url}/ajax/moderator/delPost/" + postId, true);
		xhr.send();
	}
}