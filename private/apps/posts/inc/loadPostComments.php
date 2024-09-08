<?php
	Flight::route('/ajax/post/@post_id:[0-9]+/page-@page:[0-9]+', function($post_id,$page) {
		$post = Flight::db()->get('posts', ['group_id'], ['id'=>$post_id]);
		if($post) {
			if(Flight::db()->has('groups_users', ['user_id'=>Flight::user('id'), 'group_id'=>$post['group_id']]) || $post['group_id']==0) {
				Flight::requireFunction('commentReaction');
				$query_options['post_id'] = $post_id;
				$resultsOnPage = 3;
				$lastPage = Flight::db()->count('posts_comments', $query_options);
				$lastPage = ceil($lastPage/$resultsOnPage);
				$query_options['LIMIT'] = [($page-1)*$resultsOnPage, $resultsOnPage];
				unset($resultsOnPage);
				if($lastPage>0  && $page <= $lastPage) {
					
					$query_options['ORDER'] = ['time'=>'DESC'];
					$query_options['posts_comments.post_id'] = $post_id;
					$query_fields = [
						'posts_comments.id',
						'posts_comments.content',
						'posts_comments.reactions',
						'posts_comments.time',
						'posts_comments.user_id',
						'users.first_name',
						'users.second_name'
					];
					$comments = Flight::db()->select('posts_comments', ["[>]users" => ["user_id" => "id"]], $query_fields, $query_options);
					unset($query_fields);
					unset($query_options);
					if($comments) {
						Flight::requireFunction('convertTagsToHTML');
						Flight::requireFunction('howTimeAgo');
						Flight::requireFunction('formatToShortNumber');
						Flight::requireFunction('formatDateTime2');
						Flight::requireFunction('checkPostOrCommentImage');
						foreach($comments as $comment)
							Flight::render('single_comment', ['post'=>$comment]);
					}
				}
				unset($query_options);
			}
		}
	});