<?php
	Flight::route('/wiadomosci', function(){
		Flight::setCurrentApp('/wiadomosci');
		Flight::render('main', ['tpl'=>'messages']);
	});