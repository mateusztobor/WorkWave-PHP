<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-lg-5">
		<div class="px-md-5 mx-lg-5">
			<?php
				Flight::render('single_post', ['post'=>$post, 'in_discussion'=>true]);
			?>
			<div class="px-3">
				<?php if($post['comments'] == 0) { ?>
					<div class="alert bg-body-secondary text-center h3 fw-normal">Bądź pierwszy, który się wypowie!<Br>Otwórz drzwi do wartościowej rozmowy 😊</div>
				<?php } ?>
				<?php
					Flight::render('add_comment', ['post_id'=>$post['id']]);
					print(Flight::msgs());
				?>
				
				<?php if($post['comments'] > 0) { ?>
					<div id="infinitePosts"></div>
					<div class="text-center alert bg-body-secondary h3 fw-normal" id="infinitePosts_loading">
						<div class="spinner-border" style="width: 3rem;height: 3rem;" role="status">
							<span class="visually-hidden">Wczytywanie...</span>
						</div>
					</div>
					<div class="text-center alert bg-body-secondary h3 fw-normal d-none" id="infinitePosts_end">Wszystkie wpisy zostały wyświetlone</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/postReaction.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/postFollow.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/delPost.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/commentReaction.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/delComment.js"></script>
<script>var infinitePosts_url = '<?php print(Flight::getConfig('url')); ?>/ajax/post/<?php print($post['id']); ?>/page-';</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/infinitePosts.js"></script>