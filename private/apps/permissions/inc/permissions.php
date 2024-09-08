<?php
	Flight::route('/uprawnienia', function(){
		Flight::setCurrentApp('/uprawnienia');
		Flight::render('main', ['tpl' => 'permissions']);
	});