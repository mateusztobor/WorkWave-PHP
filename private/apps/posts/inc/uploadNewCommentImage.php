<?php
	Flight::route('/ajax/uploadNewCommentImage', function() {
		Flight::requireFunction('uploadPostOrCommentImage');
		echo json_encode(Flight::uploadPostOrCommentImage('comment'), JSON_UNESCAPED_SLASHES);
	});