<?php
	Flight::map('loadPostOrCommentImage', function($post_id,$what='post',$tmp=false) {
		if($what=='post')
			$post = Flight::db()->get('posts', ['group_id'], ['id'=>$post_id]);
		elseif($what=='comment') {
			$post = Flight::db()->get('posts_comments', ['[<]posts' => ['post_id'=>'id']], ['posts.group_id'], ['posts_comments.id'=>$post_id]);
		}
		else
			$post=false;
		if($post) {
			$ok=true;
			$file = dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'uploads'.($tmp ? DIRECTORY_SEPARATOR.'tmp' : '').DIRECTORY_SEPARATOR.$what.'s'.DIRECTORY_SEPARATOR.$post_id.'.webp';
			if(file_exists($file)) {
				if($post['group_id'] != 0) {
					if(!Flight::db()->has('groups_users', ['user_id'=>Flight::user('id'), 'group_id'=>$post['group_id']]))
						$ok=false;
				}
			} else $ok=false;
			unset($post);
			if($ok) {
				header("Content-Type: image/webp");
				header("Content-Length: " . filesize($file));
				readfile($file);
			} else
				Flight::notFound();
		} else
			Flight::notFound();
	});