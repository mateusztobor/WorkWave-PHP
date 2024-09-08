function getGroupDesc(id) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            if(document.getElementById('group_desc'))
				document.getElementById('group_desc').innerHTML = xhr.responseText;
			else
				location.reload();
        }
    };
    xhr.open("GET", '{jsp$url}/ajax/getGroupDesc/'+id, true);
    xhr.send();
}