<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/postReaction.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/postFollow2.js"></script>
<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-lg-5">
		<div class="px-md-5 mx-lg-5">
			<div id="infinitePosts"></div>
			<div class="text-center alert bg-body-secondary h3 fw-normal" id="infinitePosts_loading">
				<div class="spinner-border" style="width: 3rem;height: 3rem;" role="status">
					<span class="visually-hidden">Wczytywanie...</span>
				</div>
			</div>
			<div class="text-center alert bg-body-secondary h3 fw-normal d-none" id="infinitePosts_noPosts">Brak wpisów do wyświetlenia</div>
			<div class="text-center alert bg-body-secondary h3 fw-normal d-none" id="infinitePosts_end">Wszystkie wpisy zostały wyświetlone</div>
		</div>
	</div>
</div>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/delPost.js"></script>
<script>
	var infinitePosts_url = '<?php print(Flight::getConfig('url')); ?>/ajax/follows/page-';
</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/infinitePosts.js"></script>