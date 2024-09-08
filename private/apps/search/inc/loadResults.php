<?php
	Flight::route('/ajax/search', function() {
		if(isset(Flight::request()->query->query) && isset(Flight::request()->query->type) && isset(Flight::request()->query->page)) {
			if(Flight::request()->query->type == (int)Flight::request()->query->type) {
				if(Flight::request()->query->type == 1 || Flight::request()->query->type == 2 || Flight::request()->query->type == 3) {
					if(Flight::request()->query->page == (int)Flight::request()->query->page) {
						//search users
						$query = htmlspecialchars(Flight::request()->query->query);
						if(Flight::request()->query->type == 1) {
							$resultsOnPage = 5;
							$page = (Flight::request()->query->page - 1)*$resultsOnPage;
							$users = Flight::db()->query("
								SELECT id,first_name,second_name,roles FROM users 
								WHERE first_name LIKE '%".$query."%' 
								OR second_name LIKE '%".$query."%' 
								OR CONCAT(first_name, ' ', second_name) LIKE '%".$query."%'
								LIMIT ".$page.",".$resultsOnPage.";
							");
							if($users)
								foreach($users as $user)
									Flight::render('search_profile', ['user' => $user, 'banned'=>in_array('b', explode(',',$user['roles']))]);
						}
						
						elseif(Flight::request()->query->type == 2) {
							$resultsOnPage = 3;
							$page = (Flight::request()->query->page - 1)*$resultsOnPage;
								Flight::requireFunction('getUserGroupsIds');
								Flight::requireFunction('postReaction');
								Flight::requireFunction('postFollow');
								Flight::requireFunction('convertTagsToHTML');
								Flight::requireFunction('howTimeAgo');
								Flight::requireFunction('formatToShortNumber');
								Flight::requireFunction('formatDateTime2');
								Flight::requireFunction('checkPostOrCommentImage');
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
							$posts = Flight::db()->select('posts',
								["[>]users" => ["user_id" => "id"],"[>]groups" => ["group_id" => "id"]],
								$query_fields,
								[
									"content[~]" => ["AND" => explode(' ',preg_replace('/\s+/', ' ', $query))],
									'group_id'=>Flight::getUserGroupsIds(),
									'LIMIT'=>[$page, $resultsOnPage]
								]
							);
							if(!$posts) {
								$posts = Flight::db()->select('posts',
									["[>]users" => ["user_id" => "id"],"[>]groups" => ["group_id" => "id"]],
									$query_fields,
									[
										"content[~]" => ["OR" => explode(' ',preg_replace('/\s+/', ' ', $query))],
										'group_id'=>Flight::getUserGroupsIds(),
										'LIMIT'=>[$page, $resultsOnPage]
									]
								);
							}
							if($posts) {
								Flight::requireFunction('convertTagsToHTML');
								foreach($posts as $post)
									Flight::render('single_post', ['post' => $post]);
							}
						}
						
						elseif(Flight::request()->query->type == 3) {
							$resultsOnPage = 5;
							$page = (Flight::request()->query->page - 1)*$resultsOnPage;
							$groups = Flight::db()->select('groups',
								'*',
								[
									"name[~]" => ["AND" => explode(' ',preg_replace('/\s+/', ' ', $query))],
									'LIMIT'=>[$page, $resultsOnPage]
								]
							);
							if(!$groups) {
								$groups = Flight::db()->select('groups',
									'*',
									[
										"name[~]" => ["OR" => explode(' ',preg_replace('/\s+/', ' ', $query))],
										'LIMIT'=>[$page, $resultsOnPage]
									]
								);
							}
							if($groups) {
								Flight::requireFunction('convertTagsToHTML');
								Flight::requireFunction('formatToShortNumber');
								Flight::requireFunction('formatToShortNumber');
								Flight::requireFunction('currentUserInGroup');
								Flight::requireFunction('currentUserRequestGroup');
								foreach($groups as $group)
									if($group['id'] != 0)
										Flight::render('search_group', ['group' => $group, 'outside_group'=>true]);
							}
						}
					}
				}
			}
		}
	});