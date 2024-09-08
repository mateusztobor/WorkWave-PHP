function revokeGroupModPerm(user) {
	if(confirm("Czy na pewno chcesz zabrać uprawnienia moderatora grupy temu użytkownikowi?")) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				var response = JSON.parse(xhr.responseText);
				if (response.success) {
					if(document.getElementById("revokeGroupMod_" + user))
						document.getElementById("revokeGroupMod_" + user).classList.add("d-none");
					if(document.getElementById("grantGroupMod_" + user))
						document.getElementById("grantGroupMod_" + user).classList.remove("d-none");
					if(document.getElementById("modBadge_" + user))
						document.getElementById("modBadge_" + user).classList.add("d-none");
				} else alert('Wystąpił nieoczekiwany błąd.');
			}
		};
		xhr.open("GET", "{jsp$url}/ajax/revokeGroupModPerm/" + group_id + '/' + user, true);
		xhr.send();
	}
}