<?php
	if(Flight::isAuthorized('logged') && !Flight::isAuthorized('b')) {
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'profile.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadProfilePosts.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'updateProfilePhoto.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'updateProfileDesc.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'getProfileDesc.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'getProfilePhoto.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'settings.php';
		if(Flight::isAuthorized('m') || Flight::isAuthorized('r'))
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'banAccount.php';
	}