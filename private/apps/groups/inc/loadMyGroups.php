<?php
	Flight::route('/ajax/myGroups', function() {
		if(isset(Flight::request()->query->page)) {
			if(Flight::request()->query->page == (int)Flight::request()->query->page) {
				$resultsOnPage = 5;
				$page = (Flight::request()->query->page - 1)*$resultsOnPage;
				$fields = [
					'groups.id',
					'groups.name',
					'groups.members',
					'groups.admin',
					'groups.public'
				];
				$options['groups_users.user_id'] = Flight::user('id');
				$options['ORDER'] = ['groups.name'=>'ASC'];
				$options['LIMIT'] = [$page, $resultsOnPage];
				if(isset(Flight::request()->query->query))
					$options['groups.name[~]'] = htmlspecialchars(Flight::request()->query->query);
				$groups = Flight::db()->select('groups_users', ["[>]groups" => ["group_id" => "id"]], $fields, $options);
				if($groups) {
					Flight::requireFunction('formatToShortNumber');
					Flight::requireFunction('currentUserInGroup');
					foreach($groups as $group)
						Flight::render('search_group', ['group'=>$group]);
				}
			}
		}
	});