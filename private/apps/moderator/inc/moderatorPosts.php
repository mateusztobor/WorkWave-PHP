<?php
	Flight::route('/moderator', function(){
		Flight::setCurrentApp('/moderator');
		Flight::render('main', ['tpl' => 'moderator']);
	});