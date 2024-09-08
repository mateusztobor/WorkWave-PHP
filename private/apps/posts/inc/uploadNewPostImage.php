<?php
	Flight::route('/ajax/uploadNewPostImage', function() {
		Flight::requireFunction('uploadPostOrCommentImage');
		echo json_encode(Flight::uploadPostOrCommentImage(), JSON_UNESCAPED_SLASHES);
	});