<?php
	class follows{
		private $vars;
		function __construct() {
			$this->load();
		}
		public function view() {
			Flight::render('main', $this->vars);
		}
		private function load() {
			$app_path = '/obserwowane';
			Flight::setCurrentApp($app_path);
			$query_options['ORDER'] = ['lastmod'=>'DESC'];
			//--------------------------
			$this->vars = array(
				'app_path' => $app_path,
				'tpl' => 'follows'
			);
			//--------------------------
		}
	}