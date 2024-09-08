<?php
	Flight::map('commentReaction', function($comment_id) {
		return Flight::db()->has('posts_comments_reactions', ['user_id'=>Flight::user('id'), 'comment_id'=>$comment_id]);
	});