
var firstMessage=0;
function updateFirstMessage() {
	const messagesContainer = document.getElementById("messages");
	if(messagesContainer) {
		const firstMessage2 = messagesContainer.firstElementChild;
		firstMessage = firstMessage2 ? firstMessage2.id : 0;
	}
}
var lastMessage=0;
function updateLastMessage() {
	const messagesContainer = document.getElementById("messages");
	if(messagesContainer) {
		const lastMessage2 = messagesContainer.lastElementChild;
		lastMessage = lastMessage2 ? lastMessage2.id : 0;
	}
}

function isElementInViewport(el) {
  if (!el)
    return false; // Sprawdzenie, czy element istnieje
  const rect = el.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

var isLoading = false;
var firstLoading = true;
var realView = true;
function loadMessages() {
    if (!isLoading) {
        isLoading = true;
        fetch('{jsp$url}/ajax/loadUserMessages/' + userId + '/'+lastMessage)
            .then(response => response.text())
            .then(data => {
                if (data.trim() !== '') {
                    document.getElementById('messages').insertAdjacentHTML('beforeend', data);
					if(firstLoading) {
						updateFirstMessage();
						firstLoading=false;
					} else
						realView = isElementInViewport(document.getElementById(lastMessage).previousElementSibling);
					updateLastMessage();

					if(realView) {
						window.scrollTo({
							top: document.body.scrollHeight,
							behavior: 'smooth' // Dodanie 'smooth' spowoduje płynne przewinięcie
						})
					}
                }
                isLoading = false;
            })
            .catch(error => {
                console.error('Błąd podczas pobierania wiadomości: ', error);
                isLoading = false;
            });
    }
}
loadMessages();
setInterval(loadMessages, 1500);



let isLoading2 = false; // Flaga informująca o trwającym ładowaniu
let isEnd2 = false;
const messagesContainer = document.getElementById('messages');
function loadMessagesArchive() {
    if (!isLoading2) {
        isLoading2 = true;
         fetch('{jsp$url}/ajax/loadUserMessagesArchive/' + userId + '/' + firstMessage)
            .then(response => response.text())
            .then(data => {
                if (data.trim() !== '') {
					document.getElementById('messages').insertAdjacentHTML('afterbegin', data);
					document.getElementById(firstMessage).previousElementSibling.previousElementSibling.scrollIntoView({ behavior: 'smooth', block: 'start' });
					updateFirstMessage();
                } else isEnd2=true;
                isLoading2 = false;
            })
            .catch(error => {
                isLoading2 = false;
            });
    }
}

window.onscroll = function(ev) {
	if(!isEnd2) {
		if(window.scrollY == 0) {
			setTimeout(function() {
			   loadMessagesArchive();
			}, 500);
		}
	}
};
loadMessages();





function sendMessage() {
	var content = document.getElementById('editor').value;
	if(content.length === 0)
		return;
	var formData = new FormData();
	formData.append('content', content);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '{jsp$url}/ajax/sendMessage/'+userId, true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				try {
					var response = JSON.parse(xhr.responseText);
					if (response.success)
						document.getElementById('editor').value = "";
					else
						alert('Podczas wysyłania wiadomości wystąpił nieoczekiwany błąd.\nKod błędu: PNP1');
				} catch (error) {
					alert('Podczas wysyłania wiadomości wystąpił nieoczekiwany błąd.\nKod błędu: PNP2');
				}
			} else
				alert('Podczas wysyłania wiadomości wystąpił nieoczekiwany błąd.\nKod błędu: PNP3');
		}
	};
	xhr.send(formData);
}
const editor = document.getElementById('editor');
editor.addEventListener('input', function() {
	editor.value = replaceEmoticonsWithEmoji(editor.value);
});
editor.onkeydown = function (e) {
    e = e || window.event;
    var keyCode = e.keyCode || e.which;
    if(keyCode==13) {
     sendMessage();
    }
};