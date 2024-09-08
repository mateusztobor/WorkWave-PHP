<?php
	Flight::route('/uploads/posts/@post_id:[0-9]+', function($post_id){
		Flight::requireFunction('loadPostOrCommentImage');
		Flight::loadPostOrCommentImage($post_id,'post');
	});
	Flight::route('/uploads/comments/@post_id:[0-9]+', function($post_id){
		Flight::requireFunction('loadPostOrCommentImage');
		Flight::loadPostOrCommentImage($post_id,'comment');
	});
	Flight::route('/uploads/tmp/postImage', function(){
		Flight::requireFunction('loadPostOrCommentImage');
		Flight::loadPostOrCommentImage(Flight::user('id'),'post',true);
	});
	Flight::route('/uploads/tmp/commentImage', function(){
		Flight::requireFunction('loadPostOrCommentImage');
		Flight::loadPostOrCommentImage(Flight::user('id'),'comment',true);
	});