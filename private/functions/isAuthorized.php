<?php
	Flight::map('isAuthorized', function($q){
		return ((in_array('a',Flight::get(md5('system.user'))['roles']) && $q!='b') || in_array($q,Flight::get(md5('system.user'))['roles']));
	});