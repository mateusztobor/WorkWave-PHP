function setPerm(set,what,user) {
	if(confirm("Czy na pewno chcesz " + (set ? "nadać" : "zabrać") + " uprawnienia temu użytkownikowi?")) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				var response = JSON.parse(xhr.responseText);
				if (response.success) {
					var btnGrant = document.getElementById("grant-"+what+'-'+user);
					var btnRevoke = document.getElementById("revoke-"+what+'-'+user);
					if(btnGrant && btnRevoke) {
						if(set) {
							btnGrant.classList.add("d-none");
							btnRevoke.classList.remove("d-none");
						} else {
							btnGrant.classList.remove("d-none");
							btnRevoke.classList.add("d-none");
						}
					}
				} else alert('Wystąpił nieoczekiwany błąd.');
			}
		};
		xhr.open("GET", "{jsp$url}/ajax/admin/setPerm/" + user + "/" + what + "/" + set, true);
		xhr.send();
	}
}