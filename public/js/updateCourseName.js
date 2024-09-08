function updateCourseName(section=false) {
	if(!document.getElementById('name'))
		return
	if(document.getElementById('name').value == '')
		return;
	var name = document.getElementById('name').value;
	var formData = new FormData();
	formData.append('name', name);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '{jsp$url}/ajax/updateCourse' + (section ? 'Section' : '') + 'Name/' + updateCourseName_id, true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				try {
					var response = JSON.parse(xhr.responseText);
					if (response.success) {
						document.getElementById('name').placeholder = name;
						document.getElementById('name').value = '';
						document.activeElement.blur();
					} else
						alert('Wystąpił nieoczekiwany błąd.\nKod błędu: PNP1');
				} catch (error) {
					alert('Wystąpił nieoczekiwany błąd.\nKod błędu: PNP2');
				}
			} else {
				alert('Wystąpił nieoczekiwany błąd.\nKod błędu: PNP3');
			}
		}
	};
	xhr.send(formData);
}