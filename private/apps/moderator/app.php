<?php
	if(Flight::isAuthorized('logged') && !Flight::isAuthorized('b') && Flight::isAuthorized('m')) {
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'moderatorPosts.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadPosts.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadPostComments.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'moderatorPost.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'delComment.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'delPost.php';
	}