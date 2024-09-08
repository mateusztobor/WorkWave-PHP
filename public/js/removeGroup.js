function removeGroup(groupId) {
	if(!confirm('Czy na pewno chcesz usunąć tę grupę?'))
		return;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                window.location.href = "{jsp$url}/grupy";
            } else alert('Wystąpił nieoczekiwany błąd.');
        }
    };
    xhr.open("GET", "{jsp$url}/ajax/leaveGroup/" + groupId, true);
    xhr.send();
}