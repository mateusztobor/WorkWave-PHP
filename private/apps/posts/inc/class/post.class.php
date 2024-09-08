<?php
	class post{
		private $vars;
		function __construct($post_id) {
			$this->load($post_id);
		}
		public function view() {
			Flight::render('main', $this->vars);
		}
		private function load($post_id) {
			$app_path = '/wpis-'.$post_id;
			Flight::setCurrentApp($app_path);
			
			$query_fields = [
				'posts.id',
				'posts.content',
				'posts.comments',
				'posts.reactions',
				'posts.follows',
				'posts.time',
				'posts.group_id',
				'groups.name(group_name)',
				'posts.user_id',
				'users.first_name',
				'users.second_name'
			];
			$post = Flight::db()->get('posts', ["[>]users" => ["user_id" => "id"],"[>]groups" => ["group_id" => "id"]], $query_fields, ['posts.id'=>$post_id]);
			if($post) {
				Flight::requireFunction('delNewPostOrCommentImage');
				Flight::delNewPostOrCommentImage('comment');
				Flight::requireFunction('postReaction');
				Flight::requireFunction('postFollow');
				Flight::requireFunction('convertTagsToHTML');
				Flight::requireFunction('howTimeAgo');
				Flight::requireFunction('formatToShortNumber');
				Flight::requireFunction('formatDateTime2');
				Flight::requireFunction('checkPostOrCommentImage');
				if(Flight::db()->has('groups_users', ['user_id'=>Flight::user('id'), 'group_id'=>$post['group_id']]) || $post['group_id']==0) {
					$this->vars = array(
						'app_path' => $app_path,
						'post' => $post,
						'tpl' => 'post'
					);
				} else
					$this->vars = [
						'tpl'=>'post_404'
					];
			} else
				$this->vars = [
					'tpl'=>'post_404'
				];
		}
	}