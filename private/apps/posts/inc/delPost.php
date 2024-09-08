<?php
	Flight::route('/ajax/delPost/@post_id:[0-9]+', function($post_id) {
		$data = ['success'=>false];
		if(Flight::db()->has('posts', ['id'=>$post_id, 'user_id'=>Flight::user('id')])) {
			$delete=Flight::db()->delete('posts', ['id'=>$post_id, 'user_id'=>Flight::user('id')]);
			if($delete) {
				$file = dirname(__DIR__, 3).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$post_id.'.webp';
				if(file_exists($file))
					unlink($file);
				$data = ['success'=>true];
			}
		}
		echo json_encode($data, JSON_UNESCAPED_SLASHES);
	});