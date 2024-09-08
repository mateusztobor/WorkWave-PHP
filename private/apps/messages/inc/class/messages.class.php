<?php
	class posts{
		private $vars;
		function __construct() {
			$this->load();
		}
		public function view() {
			Flight::render('main', $this->vars);
		}
		private function load() {
			$app_path = '/wpisy';
			Flight::setCurrentApp($app_path);
			Flight::requireFunction('delNewPostOrCommentImage');
			Flight::delNewPostOrCommentImage();
			$user_groups = Flight::db()->select('groups_users', ['[>]groups' => ['group_id'=>'id']], ['groups.name', 'groups.id'], ['groups_users.user_id' => Flight::user('id')]);
			$query_options['group_id'] = array_column($user_groups, 'id');
			$query_options['group_id'][] = 0;
			$this->vars = array(
				'app_path' => $app_path,
				'groups'=>$user_groups,
				'need_select2' => true,
				'tpl' => 'posts'
			);
		}
	}