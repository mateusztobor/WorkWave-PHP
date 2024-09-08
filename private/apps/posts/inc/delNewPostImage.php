<?php
	Flight::route('/ajax/delNewPostImage', function() {
		Flight::requireFunction('delNewPostOrCommentImage');
		echo json_encode(['success'=>Flight::delNewPostOrCommentImage()],JSON_UNESCAPED_SLASHES);
	});