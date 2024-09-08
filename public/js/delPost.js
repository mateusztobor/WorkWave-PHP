function delPost(postId,redirect=false) {
	if(confirm('Czy na pewno chesz usunąć ten wpis?')) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				var response = JSON.parse(xhr.responseText);
				if (response.success) {
					if(redirect)
						window.location.replace("{jsp$url}/");
					else {
						document.getElementById('post_' + postId).remove();
						initTooltips();
					}
				} else alert('Wystąpił nieoczekiwany błąd.');
			}
		};
		xhr.open("GET", "{jsp$url}/ajax/delPost/" + postId, true);
		xhr.send();
	}
}