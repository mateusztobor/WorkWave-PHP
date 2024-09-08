function publicNewComment() {
	if(unsavedChanges)
		disableUnsavedChanges();
	var content = document.getElementById('editor').value;
	var post = document.getElementById('post').value;
	if(content.length === 0)
		return;
	if(post < 0)
		return;
	var formData = new FormData();
	formData.append('content', content);
	formData.append('post', post);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '{jsp$url}/ajax/publicNewComment', true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				try {
					var response = JSON.parse(xhr.responseText);
					if (!response.success) {
						alert('Podczas publikowania wpisu wystąpił nieoczekiwany błąd.\nKod błędu: PNP1');
					}
				} catch (error) {
					alert('Podczas publikowania wpisu wystąpił nieoczekiwany błąd.\nKod błędu: PNP2');
				}
			} else {
				alert('Podczas publikowania wpisu wystąpił nieoczekiwany błąd.\nKod błędu: PNP3');
			}
		}
	};
	xhr.send(formData);
}
document.getElementById("btn_add_new_post").addEventListener("click", function (event) {
	if(!newPostImage_wait) {
		publicNewComment();
	} else {
		alert('Poczekaj, aż zdjęcie zostanie wysłane.');
		event.preventDefault();
	}
});