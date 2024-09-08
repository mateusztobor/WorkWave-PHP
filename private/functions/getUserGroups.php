<?php
	Flight::map('getUserGroups', function() {
		$user_groups = Flight::db()->select('groups_users', ['[>]groups' => ['group_id'=>'id']], ['groups.name', 'groups.id'], ['groups_users.user_id' => Flight::user('id')]);
		$user_groups[] = ['name'=>'Globalnie', 'id'=>0];
		return array_column($user_groups, 'id');
	});