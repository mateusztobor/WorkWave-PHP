const editor = document.getElementById('editor');
editor.addEventListener('input', function() {
	const text = editor.value;
	const newText = replaceEmoticonsWithEmoji(text);
	editor.value = newText;
	document.getElementById('content_counter').innerHTML = text.length;
	if(text.length > 0) {
		unsavedChanges=true;
		enableUnsavedChanges();
	} else {
		unsavedChanges=false;
		if(!newPostImage_status) {
			disableUnsavedChanges();
		}
	}
});