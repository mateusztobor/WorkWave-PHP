<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-lg-5">
		<div class="px-md-5 mx-lg-5">
			<h1 class="fw-normal h3 mb-3 text-center">Tablica moderatora</h1>
			<?php
				Flight::render('moderator_single_post', ['post'=>$post, 'in_discussion'=>true]);
			?>
			<div class="px-3">
				<?php if($post['comments'] == 0) { ?>
					<div class="alert bg-body-secondary text-center h3 fw-normal">Brak odpowiedzi</div>
				<?php } ?>
				
				<?php if($post['comments'] > 0) { ?>
					<div id="infinitePosts"></div>
					<div class="text-center alert bg-body-secondary h3 fw-normal" id="infinitePosts_loading">
						<div class="spinner-border" style="width: 3rem;height: 3rem;" role="status">
							<span class="visually-hidden">Wczytywanie...</span>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/modDelPost.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/modDelComment.js"></script>
<script>var infinitePosts_url = '<?php print(Flight::getConfig('url')); ?>/ajax/moderator/posts/<?php print($post['id']); ?>/page-';</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/infinitePosts.js"></script>