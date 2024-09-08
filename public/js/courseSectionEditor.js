	var editor = $('#editor').trumbowyg({
		btnsDef: {
			listdropdown: {
				dropdown: ['orderedList', 'unorderedList'],
				ico: 'orderedList',
				hasIcon: true
			},
			justifydropdown: {
				dropdown: ['justifyLeft', 'justifyCenter','justifyRight','justifyFull'],
				ico: 'justifyLeft',
				hasIcon: true
			},
			ssdropdown: {
				dropdown: ['superscript', 'subscript'],
				ico: 'superscript',
				hasIcon: true
			},
			fontfamily: {
				title: 'Czcionka',
				hasIcon: false
			},
			emoji: {
				title: 'Emoji',
			},
			image: {
				dropdown: ['insertImage', 'upload'],
				ico: 'insertImage'
			},
			formatting2: {
				dropdown:["p","h2","h3","h4","blockquote"],
				ico:"p"
			}
		},
		btns: [
			['viewHTML'],
			['historyUndo','historyRedo'],
			['formatting2'],
			['strong', 'em', 'underline'/*,'del'*/],
			['fontsize','fontfamily'],
			['foreColor', 'backColor'],
			
			
			
			['justifydropdown'],
			['lineheight'],
			['listdropdown'],
			
			['outdent', 'indent'],
			
			['link','image'],
			
			['horizontalRule'],
			['ssdropdown'],
			['preformatted'],
			['emoji'],
			['removeformat'],
			
			['fullscreen']
		],
		changeActiveDropdownIcon: true,
		tagClasses: {
			img: 'img-fluid'
		},
		semantic: {
			'b': 'strong',
			'i': 'em',
			's': 'del',
			'strike': 'del',
			'div': 'div'
		},
		
		imageWidthModalEdit: true,
		urlProtocol: true,
		lang: 'pl',
		plugins: {
			upload: {
				serverPath: '{jsp$url}/uploads/uploadCourseImage/'+updateCourseName_id,
				fileFieldName: 'imgFile',
				headers: {
					'Authorization': 'Client-ID xxxxxxxxxxxx'
				}
			}
		}
	});
	
	var beforeText = editor.trumbowyg('html');
	$(document).ready(function() {
		savingChanges();
	});
	
	function savingChanges() {
		setTimeout(function(){
			saveChanges();
		}, 30000);
	}
	
	function saveChanges() {
		if(!document.getElementById('editor')) {
			location.reload();
			return;
		}
		if(beforeText != editor.trumbowyg('html')) {
			beforeText = editor.trumbowyg('html');
			editor.html(editor.trumbowyg('html'));
			var formData = new FormData();
			formData.append('content', beforeText);
			var xhr = new XMLHttpRequest();
			xhr.open('POST', '{jsp$url}/ajax/updateCourseSectionContent/' + updateCourseName_id, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState === XMLHttpRequest.DONE) {
					if (xhr.status === 200) {
						try {
							var response = JSON.parse(xhr.responseText);
							if (response.success) {
								if(document.getElementById('lastSync'))
									document.getElementById('lastSync').innerHTML = (new Date().toLocaleTimeString());
							} else
								alert('Wystąpił nieoczekiwany błąd podczas zapisu.\nKod błędu: PNP1');
						} catch (error) {
							alert('Wystąpił nieoczekiwany błąd podczas zapisu.\nKod błędu: PNP2');
						}
					} else {
						alert('Wystąpił nieoczekiwany błąd podczas zapisu.\nKod błędu: PNP3');
					}
				}
			};
			xhr.send(formData);
		}
		savingChanges();
	}
	$(window).bind('beforeunload', function(){
		saveChanges();
	});