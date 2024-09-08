function publicNewPost() {
	if(unsavedChanges)
		disableUnsavedChanges();
	var content = document.getElementById('editor').value;
	var group = document.getElementById('group').value;
	if(content.length === 0)
		return;
	if(group < 0)
		return;
	var formData = new FormData();
	formData.append('content', content);
	formData.append('group', group);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '{jsp$url}/ajax/publicNewPost', true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				try {
					var response = JSON.parse(xhr.responseText);
					if (response.success) {
						window.location.href = response.url;
						location.reload();
					} else
						alert('Podczas publikowania wpisu wystąpił nieoczekiwany błąd.\nKod błędu: PNP1');
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
		publicNewPost();
		event.preventDefault();
	} else {
		alert('Poczekaj, aż zdjęcie zostanie wysłane.');
		event.preventDefault();
	}
});