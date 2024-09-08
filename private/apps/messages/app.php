<?php
	if(Flight::isAuthorized('logged') && !Flight::isAuthorized('b')) {
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'messages.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadMessages.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'messagesBox.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadUserMessages.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadUserMessagesArchive.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'sendMessage.php';
	}