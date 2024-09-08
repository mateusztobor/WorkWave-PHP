<?php
	Flight::map('postReaction', function($post_id) {
		return Flight::db()->has('posts_reactions', ['user_id'=>Flight::user('id'), 'post_id'=>$post_id]);
	});