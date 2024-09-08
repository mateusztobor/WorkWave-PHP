<?php
	class groups{
		private $vars;
		function __construct() {
			$this->load();
		}
		public function view() {
			Flight::render('main', $this->vars);
		}
		private function load() {
			$app_path = '/grupy';
			Flight::setCurrentApp($app_path);
			$this->vars = array(
				'app_path' => $app_path,
				'tpl' => 'groups'
			);
		}
	}