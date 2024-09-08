<?php
	Flight::route('/szkolenia', function(){
		Flight::setCurrentApp('/szkolenia');
		Flight::render('main', ['tpl'=>'courses_trainer']);
	});