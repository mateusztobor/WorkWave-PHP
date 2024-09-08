<?php
	Flight::requireFunction('session');
	Flight::requireFunction('user');
	Flight::requireFunction('isAuthorized');
	
	
	if(Flight::isAuthorized('logged')) {
		Flight::requireFunction('unreadMessages');
		Flight::route('/wyloguj', function(){
			Flight::session_destroy();
		});
		if(Flight::isAuthorized('b')) {
			Flight::route('/*', function() {
				Flight::render('main', ['tpl'=>'errors/unactiveAccount']);
			});
		}
	} else {
		Flight::route('/', function() {
			Flight::redirect(Flight::getConfig('url').'/logowanie');
		});
		Flight::route('/@what', function($what) {
			if($what != 'logowanie') {
				Flight::redirect(Flight::getConfig('url').'/logowanie');
			} else {
				require __DIR__ .DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'auth.class.php';
				$controller = new auth();
				$controller->view();
			}
		});
	}