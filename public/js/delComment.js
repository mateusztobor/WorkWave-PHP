function delComment(commentId) {
	if(confirm('Czy na pewno chesz usunąć tę odpowiedź?')) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				var response = JSON.parse(xhr.responseText);
				if (response.success)
					document.getElementById('comment_' + commentId).remove();
				else
					alert('Wystąpił nieoczekiwany błąd.');
			}
		};
		xhr.open("GET", "{jsp$url}/ajax/delComment/" + commentId, true);
		xhr.send();
	}
}