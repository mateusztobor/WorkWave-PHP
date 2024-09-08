<?php
	Flight::map('postFollow', function($post_id) {
		return Flight::db()->has('posts_follows', ['user_id'=>Flight::user('id'), 'post_id'=>$post_id]);
	});