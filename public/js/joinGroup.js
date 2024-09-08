function joinGroup(groupId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                document.getElementById("joinGroup_" + groupId).classList.add("d-none");
                document.getElementById("leaveGroup_" + groupId).classList.remove("d-none");
            } else alert('Wystąpił nieoczekiwany błąd.');
        }
    };
    xhr.open("GET", "{jsp$url}/ajax/joinGroup/" + groupId, true);
    xhr.send();
}