var newPostImage_wait = false;
var newPostImage_status = false;
var newPostImage = document.getElementById('new_post_image');
newPostImage.addEventListener('change', function(event) {
	uploadNewPostImage(newPostImage);
});
function uploadNewPostImage(imageInput) {
	newPostImage_wait=true;
	newPostImage_status=true;
	enableUnsavedChanges();
    if (imageInput.files.length === 0) {
        console.log('Nie wybrano pliku.');
        return;
    }
    var imageFile = imageInput.files[0];
    var formData = new FormData();
    formData.append('imgFile', imageFile);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{jsp$url}/ajax/uploadNewCommentImage', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
						var new_post_image_box = document.getElementById('new_post_image_box');
						new_post_image_box.classList.remove('d-none');
						new_post_image_box.innerHTML='<img src="{jsp$url}/uploads/tmp/commentImage" class="img-fluid w-100" alt="">';
						document.getElementById('btn_new_post_image').classList.add('d-none');
						document.getElementById('btn_new_post_image_del').classList.remove('d-none');
                        newPostImage_wait=false;
                    } else {
                        alert('Podczas przesyłania pliku wystąpił nieoczekiwany błąd.\nKod błędu: UPI1');
                        newPostImage_wait=false;
						newPostImage_status=false;
						if(document.getElementById('editor').value.length == 0) {
							disableUnsavedChanges();
						}
                    }
                } catch (error) {
                    alert('Podczas przesyłania pliku wystąpił nieoczekiwany błąd.\nKod błędu: UPI2');
                    newPostImage_wait=false;
					newPostImage_status=false;
					if(document.getElementById('editor').value.length == 0) {
						disableUnsavedChanges();
					}
                }
            } else {
                alert('Podczas przesyłania pliku wystąpił nieoczekiwany błąd.\nKod błędu: UPI3');
                newPostImage_wait=false;
                newPostImage_status=false;
				if(document.getElementById('editor').value.length == 0) {
					disableUnsavedChanges();
				}
            }
        }
    };
    
    xhr.send(formData);
}
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
    xhr.open("GET", "{jsp$url}/ajax/delNewCommentImage/", true);
    xhr.send();
}