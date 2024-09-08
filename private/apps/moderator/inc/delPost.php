<?php
	Flight::route('/ajax/moderator/delPost/@post_id:[0-9]+', function($post_id) {
		$data = ['success'=>false];
		$post = Flight::db()->get('posts', ['group_id'], ['id'=>$post_id]);
		if($post) {
			if($post['group_id'] == 0 || Flight::db()->has('groups', ['id'=>$post['group_id'], 'public'=>1])) {
				$delete=Flight::db()->delete('posts', ['id'=>$post_id]);
				if($delete) {
					$file = dirname(__DIR__, 3).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$post_id.'.webp';
					if(file_exists($file))
						unlink($file);
					$data = ['success'=>true];
				}
			}
		}
		echo json_encode($data, JSON_UNESCAPED_SLASHES);
	});