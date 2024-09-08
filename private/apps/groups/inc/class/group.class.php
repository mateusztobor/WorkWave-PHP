<?php
	class group{
		private $vars;
		function __construct($group_id) {
			$this->load($group_id);
		}
		public function view() {
			Flight::render('main', $this->vars);
		}
		private function load($group_id) {
			$app_path = '/grupa-'.$group_id;
			Flight::setCurrentApp($app_path);
			$query_fields = [
				'groups.id',
				'groups.name',
				'groups.description',
				'groups.members',
				'groups.admin',
				'groups.public'
			];
			$group = Flight::db()->get('groups', $query_fields, ['id'=>$group_id]);
			unset($query_fields);
			if($group) {
				$requests = Flight::db()->has('groups_requests', ['group_id'=>$group_id]) & !$group['public'];
				$requests_count = Flight::db()->count('groups_requests', ['group_id'=>$group_id]);
				$member = Flight::db()->get('groups_users', ['moderator'], ['user_id'=>Flight::user('id'), 'group_id'=>$group_id]);
				Flight::requireFunction('formatToShortNumber');
				Flight::requireFunction('currentUserInGroup');
				Flight::requireFunction('currentUserRequestGroup');
				Flight::requireFunction('convertTagsToHTML');
				$this->vars = array(
					'app_path' => $app_path,
					'group_id' => $group_id,
					'group' => $group,
					'member' => $member,
					'requests' => $requests,
					'requests_count' => $requests_count,
					'tpl' => 'group'
				);
			} else
				$this->vars = ['tpl'=>'group_404'];
		}
	}