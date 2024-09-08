<?php
	Flight::route('/tworzenie-konta', function(){
		$alert=0;
		if(isset(Flight::request()->data->createAccount)) {
			if(isset(Flight::request()->data->email)) {
				if(filter_var(Flight::request()->data->email, FILTER_VALIDATE_EMAIL)) {
					if(mb_strlen(Flight::request()->data->email) > 0 && mb_strlen(Flight::request()->data->email) <= 255) {
						Flight::request()->data->email=strtolower(Flight::request()->data->email);
						Flight::request()->data->email=htmlspecialchars(Flight::request()->data->email);
						if(!Flight::db()->has('users', ['email'=>Flight::request()->data->email])) {
							if(
								mb_strlen(Flight::request()->data->fname) > 0 && mb_strlen(Flight::request()->data->fname) <= 64 &&
								mb_strlen(Flight::request()->data->sname) > 0 && mb_strlen(Flight::request()->data->sname) <= 64
							) {
								Flight::requireFunction('generateString');
								Flight::request()->data->fname=htmlspecialchars(Flight::request()->data->fname);
								Flight::request()->data->sname=htmlspecialchars(Flight::request()->data->sname);
								$password = Flight::generateString(8);
								$hashedPassword=password_hash($password.Flight::getConfig('password_hash'), PASSWORD_DEFAULT);
								Flight::db()->insert('users', [
									'email'=>Flight::request()->data->email,
									'first_name'=>htmlspecialchars(Flight::request()->data->fname),
									'second_name'=>htmlspecialchars(Flight::request()->data->sname),
									'password'=>$hashedPassword
								]);
								unset($hashedPassword);
								Flight::requireFunction('sendMail');
								Flight::sendMail('haslo: '.$password,'Nowe konto', Flight::request()->data->email);
								unset($password);
								$alert=1;
							} else
								$alert=2;
						} else
							$alert=3;
					}
				} else $alert=2;
			} else $alert=2;
		}
		Flight::setCurrentApp('/tworzenie-konta');
		Flight::render('main', ['tpl'=>'new_account_form', 'alert'=>$alert]);
	});