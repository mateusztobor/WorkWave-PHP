<?php
	class settings{
		private $vars;
		function __construct() {
			$this->load();
		}
		public function view() {
			Flight::render('main', $this->vars);
		}
		private function load() {
			$app_path = '/ustawienia-konta';
			Flight::setCurrentApp($app_path);
			if(isset(Flight::request()->data->chpass)) {
				if(isset(Flight::request()->data->c_pass) && isset(Flight::request()->data->n_pass) && isset(Flight::request()->data->rn_pass)) {
					$user = Flight::db()->get('users', ['password'], ['id'=>Flight::user('id')]);
					if($user) {
						if(password_verify((Flight::request()->data->c_pass.Flight::getConfig('password_hash')),$user['password'])) {
							Flight::requireFunction('isPasswordValid');
							if(Flight::isPasswordValid(Flight::request()->data->n_pass)) {
								if(Flight::request()->data->n_pass == Flight::request()->data->rn_pass) {
									if(Flight::db()->update('users', ['password'=>password_hash(Flight::request()->data->n_pass.Flight::getConfig('password_hash'), PASSWORD_DEFAULT)], ['id'=>Flight::user('id')])) {
										Flight::msg_add('success', 'Hasło zostało zmienione.');
									} else Flight::msg_add('danger', 'Błąd systemu.');
								} else Flight::msg_add('warning', 'Wprowadzone hasła różnią się.');
							} else Flight::msg_add('warning', 'Wprowadzone nowe hasło nie jest poprawne. Nowe hasło musi mieć minimum 8 znaków, w tym 1 znak specjalny.');
						} else Flight::msg_add('warning', 'Aktualne hasło jest niepoprawne!');
						unset($user);
					} else Flight::msg_add('danger', 'Błąd systemu.');
				}
			}
			//--------------------------
			$this->vars = array(
				'app_path' => $app_path,
				'tpl' => 'account_settings'
			);
			unset($app_path);
			//--------------------------
		}
	}