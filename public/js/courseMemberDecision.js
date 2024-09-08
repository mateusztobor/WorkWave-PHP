function courseMemberDecision(user,decision) {
	if(confirm("Czy na pewno chcesz " + (decision ? "dodać" : "usunąć") + " tego użytkownika " + (decision ? "do" : "ze") + " szkolenia?")) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				var response = JSON.parse(xhr.responseText);
				if (response.success) {
					if(decision) {
						if(document.getElementById("userAdd_" + user))
							document.getElementById("userAdd_" + user).classList.add('d-none');
						if(document.getElementById("userRemove_" + user))
							document.getElementById("userRemove_" + user).classList.remove('d-none');
					} else {
						if(document.getElementById("userRemove_" + user))
							document.getElementById("userRemove_" + user).classList.add('d-none');
						if(document.getElementById("userAdd_" + user))
							document.getElementById("userAdd_" + user).classList.remove('d-none');
					}
				} else alert('Wystąpił nieoczekiwany błąd.');
			}
		};
		xhr.open("GET", "{jsp$url}/ajax/courseMemberDecision/" + course_id + '/' + user + '/' + decision, true);
		xhr.send();
	}
}