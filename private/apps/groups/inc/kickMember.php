<?php
	Flight::route('/ajax/kickGroupMember/@group_id:[0-9]+/@user:[0-9]+', function($group_id,$user) {
		$data = ['success'=>false];
		if(Flight::user('id') != $user) {
			$group = Flight::db()->get('groups', ['admin'], ['id'=>$group_id]);
			if($group) {
				$moderator = Flight::has('groups_users', ['group_id'=>$group_id, 'user_id'=>Flight::user('id'), 'moderator'=>1]);
				$admin = $group['admin']==Flight::user('id');
				if($moderator || $admin) {
					$perm=true;
					if(Flight::has('groups_users', ['group_id'=>$group_id, 'user_id'=>$user, 'moderator'=>1]) && $moderator)
						$perm=false;
					elseif($user == $group['admin'])
						$perm=false;
					
					if($perm) {
						$delete = Flight::db()->delete('groups_users', ['group_id'=>$group_id, 'user_id'=>$user]);
						$data = ['success'=>true];
					}
				}
			}
		}
		echo json_encode($data,JSON_UNESCAPED_SLASHES);
		unset($data);
	});