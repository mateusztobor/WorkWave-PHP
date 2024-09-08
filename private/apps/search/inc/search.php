<?php
	Flight::route('/wyszukiwanie', function(){
		Flight::render('main', ['tpl'=>'search']);
	});