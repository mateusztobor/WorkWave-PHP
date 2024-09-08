const profileDesc = document.getElementById('profileDesc');
document.getElementById('profileDesc_counter').innerHTML = profileDesc.value.length;
profileDesc.addEventListener('input', function() {
	const newText = replaceEmoticonsWithEmoji(profileDesc.value);
	profileDesc.value = newText;
	document.getElementById('profileDesc_counter').innerHTML = profileDesc.value.length;
});
function updateProfileDesc() {
	var content = profileDesc.value;
	var formData = new FormData();
	formData.append('content', content);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '{jsp$url}/ajax/updateProfileDesc', true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				try {
					var response = JSON.parse(xhr.responseText);
					if (response.success)
						getProfileDesc();
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