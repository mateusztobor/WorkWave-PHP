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
			$this->vars = array(
				'app_path' => $app_path,
				'group' => '0',
				'tpl' => 'posts'
			);
		}
	}