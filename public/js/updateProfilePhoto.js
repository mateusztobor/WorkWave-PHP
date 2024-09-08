var profilePhoto = document.getElementById('updateProfilePhoto');
profilePhoto.addEventListener('change', function(event) {
	updateProfilePhoto(profilePhoto);
});
function updateProfilePhoto(imageInput) {
    if (imageInput.files.length === 0) {
        console.log('Nie wybrano zdjęcia.');
        return;
    }
    var imageFile = imageInput.files[0];
    var formData = new FormData();
    formData.append('imgFile', imageFile);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{jsp$url}/ajax/updateProfilePhoto/', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
						var src = document.getElementById("currentPhoto").getAttribute('src');
						src += '?v=' + Date.now();
						document.getElementById("currentPhoto").setAttribute('src',src);
                    } else
                        alert('Podczas przesyłania pliku wystąpił nieoczekiwany błąd.\nKod błędu: UPI1');
                } catch (error) {
                    alert('Podczas przesyłania pliku wystąpił nieoczekiwany błąd.\nKod błędu: UPI2');
                }
            } else
                alert('Podczas przesyłania pliku wystąpił nieoczekiwany błąd.\nKod błędu: UPI3');
        }
    };
    
    xhr.send(formData);
}
/*
function delNewPostImage() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.success) {
				var new_post_image_box = document.getElementById('new_post_image_box');
				new_post_image_box.classList.add('d-none');
				new_post_image_box.innerHTML='';
				document.getElementById('btn_new_post_image').classList.remove('d-none');
				document.getElementById('btn_new_post_image_del').classList.add('d-none');
				newPostImage_status=false;
				if(document.getElementById('editor').value.length == 0) {
					disableUnsavedChanges();
				}
            } else alert('Wystąpił nieoczekiwany błąd.');
        }
    };
    xhr.open("GET", "{jsp$url}/ajax/delNewPostImage/", true);
    xhr.send();
}
*/