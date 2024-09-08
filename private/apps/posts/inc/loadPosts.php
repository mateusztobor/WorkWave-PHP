<?php
	Flight::route('/ajax/posts/page-@page:[0-9]+', function($page) {
		$user_groups = Flight::db()->select('groups_users', ['[>]groups' => ['group_id'=>'id']], ['groups.id'], ['groups_users.user_id' => Flight::user('id')]);
		$user_groups = $user_groups ? array_column($user_groups, 'id') : false;
		$resultsOnPage = 3;
		$offset = ($page-1)*$resultsOnPage;
		
		$sql = "
			SELECT
				posts.id,
				posts.content,
				posts.comments,
				posts.reactions,
				posts.follows,
				posts.time,
				posts.group_id,
				`groups`.name AS group_name,
				posts.user_id,
				users.first_name,
				users.second_name
			FROM posts
			LEFT JOIN users ON posts.user_id = users.id
			LEFT JOIN `groups` ON posts.group_id = `groups`.id
			WHERE
				".($user_groups ? "posts.group_id IN (" . implode(', ', $user_groups) . ") OR " : "")."
				posts.group_id IS NULL
			ORDER BY lastmod DESC
			LIMIT " . $offset . ", " . $resultsOnPage;

			
			$posts = Flight::db()->query($sql);
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
	});