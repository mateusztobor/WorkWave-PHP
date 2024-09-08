<?php
	Flight::route('/ajax/delNewCommentImage', function() {
		Flight::requireFunction('delNewPostOrCommentImage');
		echo json_encode(['success'=>Flight::delNewPostOrCommentImage('comment')],JSON_UNESCAPED_SLASHES);
	});