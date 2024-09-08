<?php
	Flight::route('/ajax/delComment/@comment_id:[0-9]+', function($comment_id) {
		$data = ['success'=>false];
		$comment = Flight::db()->get('posts_comments', ['post_id'], ['id'=>$comment_id, 'user_id'=>Flight::user('id')]);
		if($comment) {
			$delete=Flight::db()->delete('posts_comments', ['id'=>$comment_id, 'user_id'=>Flight::user('id')]);
			if($delete) {
				$file = dirname(__DIR__, 3).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'comments'.DIRECTORY_SEPARATOR.$comment_id.'.webp';
				if(file_exists($file))
					unlink($file);
				Flight::db()->update('posts', ['comments[-]'=>1], ['id'=>$comment['post_id']]);
				$data = ['success'=>true];
			}
		}
		echo json_encode($data, JSON_UNESCAPED_SLASHES);
	});