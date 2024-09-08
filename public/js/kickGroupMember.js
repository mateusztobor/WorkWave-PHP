function kickGroupMember(user) {
	if(confirm("Czy na pewno chcesz wyrzucić tego użytkownika z grupy?")) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				var response = JSON.parse(xhr.responseText);
				if (response.success) {
					if(document.getElementById("user_" + user))
						document.getElementById("user_" + user).remove();
				} else alert('Wystąpił nieoczekiwany błąd.');
			}
		};
		xhr.open("GET", "{jsp$url}/ajax/kickGroupMember/" + group_id + '/' + user, true);
		xhr.send();
	}
}