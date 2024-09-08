<?php
	class profile{
		private $vars;
		function __construct($user_id) {
			$this->load($user_id);
		}
		public function view() {
			Flight::render('main', $this->vars);
		}
		private function load($user_id) {
			if($user_id == Flight::user('id'))
				$app_path = '/moj-profil';
			else
				$app_path = '/uzytkownik-'.$user_id;
			Flight::setCurrentApp($app_path);
			$user=Flight::db()->get('users', ['id', 'description', 'first_name', 'second_name'], ['id'=>$user_id]);
			if($user) {
				Flight::requireFunction('convertTagsToHTML');
				//--------------------------
				$this->vars = array(
					'app_path' => $app_path,
					'user_id' => $user_id,
					'user' => $user,
					'need_select2' => true,
					'tpl' => 'profile'
				);
				//--------------------------
			} else {
				$this->vars = [
					'tpl'=>'profile_404'
				];
			}
		}
	}