<?php
	Flight::route('/switchGroupPublic/@group_id:[0-9]+', function($group_id) {
		$group = Flight::db()->get('groups', ['public'], ['id'=>$group_id, 'admin'=>Flight::user('id')]);
		if($group) {
			Flight::db()->update('groups', ['public'=>!$group['public']], ['id'=>$group_id, 'admin'=>Flight::user('id')]);
			if(!$group['public']) {
				$req = Flight::db()->select('groups_requests', ['id', 'user_id'], ['group_id'=>$group_id]);
				if($req) {
					$i=0;
					foreach($req as $r) {
						Flight::db()->insert('groups_users', ['group_id'=>$group_id, 'user_id'=>$r['user_id']]);
						Flight::db()->delete('groups_requests', ['id'=>$r['id']]);
						$i++;
					}
					unset($r);
					unset($req);
					if($i>0)
						Flight::db()->update('groups', ['members[+]'=>$i], ['id'=>$group_id]);
					unset($i);
				}
			}
			Flight::redirect('/grupa-'.$group_id);
		} else
			Flight::notFound();
	});