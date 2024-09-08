<?php
	class auth{
		public function view() {
			$this->form();
			Flight::render('main', ['tpl'=>'login']);
		}
		private function form() {
			//$c='tester';
			//$c= password_hash($c.Flight::getConfig('password_hash'), PASSWORD_DEFAULT);
			//exit($c);
			$warning=false;
			if(Flight::request()->data->login_password) {
				if(!$warning) {
					$user = Flight::db()->select('users', ['id','password'], ['email' => htmlspecialchars(Flight::request()->data->login_email)]);
					unset($key); unset($value);
					if($user) {
						$user=$user[0];
						if(password_verify((Flight::request()->data->login_password.Flight::getConfig('password_hash')),$user['password']))
							Flight::session_register($user['id']);
						else
							$warning=true;
					} else $warning=true;
				} else $warning=true;
			}
			if($warning)
				Flight::set('form.warning',true);
		}
	}