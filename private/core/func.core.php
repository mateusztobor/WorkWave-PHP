<?php
	Flight::map('msgs', function() {
		$ret = '';
		if(isset($_SESSION['msgs'])) {
			
			foreach($_SESSION['msgs'] as $msg) {
				$ret.='<div class="alert my-2 alert-'.$msg['type'].'">'.$msg['content'].'</div>';
			}
			unset($_SESSION['msgs']);
		}
		return $ret;
	});
	Flight::map('msg_add', function($type,$content) {
		$_SESSION['msgs'][] = ['type'=>$type, 'content'=>$content];
	});
	Flight::map('requireFunction', function($name) {
		$path = dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'functions/'.$name.'.php';
		if(file_exists($path)) {
			require $path;
			return true;
		} else return false;
	});

?>