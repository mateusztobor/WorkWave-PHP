function getProfileDesc() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            if(document.getElementById('profile_desc'))
				document.getElementById('profile_desc').innerHTML = xhr.responseText;
			else
				location.reload();
        }
    };
    xhr.open("GET", '{jsp$url}/ajax/getProfileDesc', true);
    xhr.send();
}