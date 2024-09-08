<?php
	Flight::map('add2Head', function($what) {
		if(Flight::has('add2Head'))
			Flight::set('add2Head', Flight::get('add2Head').$what);
		else
			Flight::set('add2Head', $what);
	});