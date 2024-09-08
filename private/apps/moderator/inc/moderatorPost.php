<?php
	Flight::route('/moderator/@post_id:[0-9]+', function($post_id){
			Flight::setCurrentApp('/mod/wpis-'.$post_id);
			$vars = [
				'tpl'=>'post_404'
			];
			$query_fields = [
				'posts.id',
				'posts.content',
				'posts.comments',
				'posts.reactions',
				'posts.follows',
				'posts.time',
				'posts.group_id',
				'groups.name(group_name)',
				'posts.user_id',
				'users.first_name',
				'users.second_name'
			];
			$post = Flight::db()->get('posts', ["[>]users" => ["user_id" => "id"],"[>]groups" => ["group_id" => "id"]], $query_fields, ['posts.id'=>$post_id]);
			if($post) {
				if(Flight::db()->has('groups', ['public'=>1, 'id'=>$post['group_id']]) || $post['group_id'] == 0) {
					Flight::requireFunction('delNewPostOrCommentImage');
					Flight::requireFunction('convertTagsToHTML');
					Flight::requireFunction('howTimeAgo');
					Flight::requireFunction('formatToShortNumber');
					Flight::requireFunction('formatDateTime2');
					Flight::requireFunction('checkPostOrCommentImage');
					$vars = [
						'post' => $post,
						'tpl' => 'moderator_post'
					];
				}
			}
			Flight::render('main', $vars);
	});