<?php
	Flight::route('/ajax/group/@group_id:[0-9]+/page-@page:[0-9]+', function($group_id,$page) {
		if(Flight::db()->has('groups_users', ['user_id'=>Flight::user('id'), 'group_id'=>$group_id]) || Flight::db()->has('groups', ['public'=>1, 'id'=>$group_id])) {
			//options
			$query_options['group_id'] = $group_id;
			//pagination
			$resultsOnPage = 3;
			$lastPage = Flight::db()->count('posts', $query_options);
			$lastPage = ceil($lastPage/$resultsOnPage);
			$query_options['LIMIT'] = [($page-1)*$resultsOnPage, $resultsOnPage];
			unset($resultsOnPage);
			if($lastPage > 0 && $page <= $lastPage) {
				$query_options['ORDER'] = ['lastmod'=>'DESC'];
				//fields
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
		}
	});