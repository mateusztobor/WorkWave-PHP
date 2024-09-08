<?php
	Flight::route('/ajax/profile/@user_id:[0-9]+/page-@page:[0-9]+', function($user_id,$page) {
		$query_options['user_id'] = $user_id;
		$query_options['ORDER'] = ['time'=>'DESC'];
		
		// Pobierz ID grup użytkownika
		$user_groups = Flight::db()->select('groups_users', ['[>]groups' => ['group_id'=>'id']], ['groups.id'], ['groups_users.user_id' => Flight::user('id')]);
		$query_options['group_id'] = array_column($user_groups, 'id');
		$query_options['group_id'][] = 0;
		unset($users_groups);
		
		$resultsOnPage = 3;
		$lastPage = Flight::db()->count('posts', $query_options);
		$lastPage = ceil($lastPage/$resultsOnPage);
		$query_options['LIMIT'] = [($page-1)*$resultsOnPage, $resultsOnPage];
		unset($resultsOnPage);
		if($lastPage>0  && $page <= $lastPage) {
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
			$posts = Flight::db()->select('posts', ["[>]users" => ["user_id" => "id"],"[>]groups" => ["group_id" => "id"]], $query_fields, $query_options);
			unset($query_fields);
			unset($query_options);
			if($posts) {
				Flight::requireFunction('postReaction');
				Flight::requireFunction('postFollow');
				Flight::requireFunction('convertTagsToHTML');
				Flight::requireFunction('howTimeAgo');
				Flight::requireFunction('formatToShortNumber');
				Flight::requireFunction('formatDateTime2');
				Flight::requireFunction('checkPostOrCommentImage');
				foreach($posts as $post)
					Flight::render('single_post', ['post'=>$post]);
			}
		}
		unset($query_options);
	});