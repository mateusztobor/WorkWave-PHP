function cancelRequestGroup(groupId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
				document.getElementById("requestGroup_" + groupId).classList.remove("d-none");
                document.getElementById("cancelRequestGroup_" + groupId).classList.add("d-none");
            } else alert('Wystąpił nieoczekiwany błąd.');
        }
    };
    xhr.open("GET", "{jsp$url}/ajax/cancelRequestGroup/" + groupId, true);
    xhr.send();
}