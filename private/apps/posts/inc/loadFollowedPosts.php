<?php
	Flight::route('/ajax/follows/page-@page:[0-9]+', function($page) {
		$user_groups = Flight::db()->select('groups_users', ['[>]groups' => ['group_id'=>'id']], ['groups.id'], ['groups_users.user_id' => Flight::user('id')]);
		$user_groups = $user_groups ? array_column($user_groups, 'id') : [];
		$user_groups[] = '';
		$resultsOnPage = 3;
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
		$posts = Flight::db()->select('posts_follows', [
			'[>]posts'=>['posts_follows.post_id'=>'id'],
			'[<]users'=>['posts.user_id'=>'id'],
			'[>]groups'=>['posts.group_id'=>'id']
		], $query_fields, [
			'posts_follows.user_id'=>Flight::user('id'),
			'ORDER'=>['posts.lastmod'=>'DESC'],
			'LIMIT'=>[($page-1)*$resultsOnPage, $resultsOnPage]
		]);
		unset($query_fields);
		unset($resultsOnPage);
		if($posts) {
			Flight::requireFunction('postReaction');
			Flight::requireFunction('postFollow');
			Flight::requireFunction('convertTagsToHTML');
			Flight::requireFunction('howTimeAgo');
			Flight::requireFunction('formatToShortNumber');
			Flight::requireFunction('formatDateTime2');
			Flight::requireFunction('checkPostOrCommentImage');
			foreach($posts as $post) {
				if(!in_array($post['group_id'], $user_groups)) {
					Flight::db()->delete('posts_follows', ['user_id'=>Flight::user('id'), 'post_id'=>$post['id']]);
					Flight::db()->update('posts', ['follows[-]'=>1], ['id'=>$post['id']]);
				}
				else
					Flight::render('single_post', ['post'=>$post]);
			}
		}
		unset($query_options);
	});