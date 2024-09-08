function moveCourseSection(pos,section) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			var response = JSON.parse(xhr.responseText);
			if (response.success)
				moveElement(pos,section);
		}
	};
	xhr.open("GET", "{jsp$url}/ajax/moveCourseSection/" + pos + "/" + section, true);
	xhr.send();
}
function moveElement(pos, section) {
	var container = document.getElementById('infinitePosts');
	var element = document.getElementById('section_' + section);
	if(pos) {
		if(element.previousElementSibling)
			element.parentNode.insertBefore(element, element.previousElementSibling);
	} else {
		if(element.nextElementSibling)
			element.parentNode.insertBefore(element.nextElementSibling, element);
	}
}





