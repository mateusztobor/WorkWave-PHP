<?php
	error_reporting(0);
	Flight::set('flight.views.path', dirname(__DIR__, 1).'/setup/tpl');
	Flight::set('flight.views.extension', '.tpl');
	require dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'functions'.DIRECTORY_SEPARATOR.'generateString.php';
	Flight::map('saveIni', function($filename, $data) {
		$iniString = '';
		foreach ($data as $key => $value)
			$iniString .= "$key = \"$value\"\n";
		return
			file_put_contents(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'setup'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.$filename.'.ini', $iniString);
	});
	Flight::map('requireFunction', function($function) {
		require dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'functions'.DIRECTORY_SEPARATOR.$function.'.php';
	});
	Flight::map('getIni', function($filename) {
		return file_exists(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'setup'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.$filename.'.ini') ? parse_ini_file(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'setup'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.$filename.'.ini', false) : false;
	});
	Flight::map('deleteFile', function($file) {
		return file_exists(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'setup'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.$file) ? unlink(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'setup'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.$file) : false;
	});
	Flight::route('/instalacja', function() {
		$render = null;
		$db_form=false;
		$user_form=false;
		
		$db_file=Flight::getIni('db');
		if($db_file) {
			Flight::requireFunction('checkDbConnection');
			if(Flight::checkDbConnection($db_file)) {
				$user_file=Flight::getIni('user');
				$user_err=[];
				if($user_file) {
					
					if(isset($user_file['email']) && isset($user_file['fname']) && isset($user_file['sname']) && isset($user_file['pass']) && isset($user_file['repass'])) {
						
						
						
						Flight::requireFunction('isPasswordValid');
						if(!Flight::isPasswordValid($user_file['pass']))
							$user_err['pass_validate']=1;
						
						if($user_file['pass'] != $user_file['repass'])
							$user_err['repass']=1;
						
						if(!filter_var($user_file['email'], FILTER_VALIDATE_EMAIL))
							$user_err['email']=1;
						
						if(mb_strlen($user_file['fname']) == 0 || mb_strlen($user_file['fname']) > 64)
							$user_err['fname']=1;

						if(mb_strlen($user_file['sname']) == 0 || mb_strlen($user_file['sname']) > 64)
							$user_err['sname']=1;
						
						
						
						if(count($user_err) == 0) {
							$sql = dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'setup'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'database.sql';
							$sql_err = [];
							if(file_exists($sql)) {
								$sql = file_get_contents($sql);
								$mysqli = new mysqli($db_file['host'], $db_file['user'], $db_file['pass'], $db_file['db']);
								if($mysqli->connect_error) {
									Flight::deleteFile('db.ini');
									Flight::redirect('/instalacja');
									Flight::stop();
								} else {
									Flight::requireFunction('generateString');
									$password_hash = Flight::generateString(6);
									$password = password_hash($user_file['pass'].$password_hash, PASSWORD_DEFAULT);
									
									$sql = str_replace([
										'{email}',
										'{fname}',
										'{sname}',
										'{password}',
										'{password_hash}'
									], [
										$user_file['email'],
										$user_file['fname'],
										$user_file['sname'],
										$password,
										$password_hash
									], $sql);
									unset($user_file);
									unset($password_hash);
									unset($password);
									$mysqli->multi_query($sql);
									unset($sql);
									$mysqli->close();
									
									$newConfig = dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'setup'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'config.php';
									$newConfig = file_get_contents($newConfig);
									
									$url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
									$url = str_replace('/instalacja', '', $url);
									
									$newConfig = str_replace([
										'{url}',
										'{host}',
										'{db}',
										'{user}',
										'{pass}',
										'{port}'
									], [
										$url,
										$db_file['host'],
										$db_file['db'],
										$db_file['user'],
										$db_file['pass'],
										$db_file['port'],
									], $newConfig);
									
									unset($db_file);
									
									file_put_contents(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'config.php', $newConfig);
									unset($newConfig);
									
									Flight::deleteFile('db.ini');
									Flight::deleteFile('user.ini');
									file_put_contents(dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'setup'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'.installed', date('Y-m-d H:i:s'));
									
									header("refresh:5;url=".$url);
									Flight::stop();
								}
								
							} else
								$sql_err['nodbfile']=1;
							$render=['tpl'=>'installed', 'err'=>$sql_err];
						} else {
							unset($user_file['pass']);
							unset($user_file['repass']);
							$render=['tpl'=>'user', 'err'=>$user_err, 'data'=>$user_file];
							$user_form=true;
						}
					}
				} else {
					$render=['tpl'=>'user', 'err'=>$user_err];
					$user_form=true;
				}
			} else {
				$render=['tpl'=>'db', 'db_connect'=>false];
				$db_form=true;
			}
		} else {
			$render=['tpl'=>'db'];
			$db_form=true;
		}
		if($db_form) {
			if(isset(Flight::request()->data->save_db)) {
				if(
					isset(Flight::request()->data->host) && 
					isset(Flight::request()->data->user) && 
					isset(Flight::request()->data->pass) && 
					isset(Flight::request()->data->db) &&
					isset(Flight::request()->data->port)
				) {
					Flight::saveIni('db', [
						'host'=>Flight::request()->data->host,
						'user'=>Flight::request()->data->user,
						'pass'=>Flight::request()->data->pass,
						'db'=>Flight::request()->data->db,
						'port'=>Flight::request()->data->port
					]);
					Flight::redirect('/instalacja');
				}
			}
		}
		if($user_form) {
			if(isset(Flight::request()->data->save_user)) {
				if(
					isset(Flight::request()->data->email) && 
					isset(Flight::request()->data->fname) && 
					isset(Flight::request()->data->sname) && 
					isset(Flight::request()->data->pass) &&
					isset(Flight::request()->data->repass)
				) {
					
					
					
					Flight::saveIni('user', [
						'email'=>Flight::request()->data->email,
						'fname'=>Flight::request()->data->fname,
						'sname'=>Flight::request()->data->sname,
						'pass'=>Flight::request()->data->pass,
						'repass'=>Flight::request()->data->repass
					]);
					Flight::redirect('/instalacja');
				}
			}
		}
		Flight::render('main', $render);
	});
	Flight::route('/*', function() {
			Flight::redirect('/instalacja');
	});
	Flight::start();