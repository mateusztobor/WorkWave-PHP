<?php
	if(Flight::isAuthorized('a')) {
		Flight::route('/informacje', function(){
			Flight::setCurrentApp('/informacje');
			Flight::render('main', ['tpl'=>'info','enabledApps'=>Flight::getEnabledApps()]);
		});
	}