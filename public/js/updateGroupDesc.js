const groupDesc = document.getElementById('groupDesc');
document.getElementById('groupDesc_counter').innerHTML = groupDesc.value.length;
groupDesc.addEventListener('input', function() {
	const newText = replaceEmoticonsWithEmoji(groupDesc.value);
	groupDesc.value = newText;
	document.getElementById('groupDesc_counter').innerHTML = groupDesc.value.length;
});
function updateGroupDesc(id) {
	var content = groupDesc.value;
	var formData = new FormData();
	formData.append('content', content);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '{jsp$url}/ajax/updateGroupDesc/'+id, true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				try {
					var response = JSON.parse(xhr.responseText);
					if (response.success)
						getGroupDesc(id);
					else
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