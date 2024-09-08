function leaveGroup(groupId) {
	if(!confirm('Czy na pewno chcesz opuścić tę grupę?'))
		return;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                location.reload();
            } else alert('Wystąpił nieoczekiwany błąd.');
        }
    };
    xhr.open("GET", "{jsp$url}/ajax/leaveGroup/" + groupId, true);
    xhr.send();
}