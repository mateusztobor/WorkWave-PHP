<?php
	Flight::route('/moje-szkolenia', function(){
		Flight::setCurrentApp('/moje-szkolenia');
		Flight::render('main', ['tpl'=>'courses']);
	});