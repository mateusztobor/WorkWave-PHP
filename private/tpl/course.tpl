<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-xl-5">
		<div class="px-xl-5 mx-lg-5">
			<div class="card-header bg-white mb-4">
				<div class="small text-center">Szkolenie</div>
				<div class="row">
					<div class="col-2 text-start">
						<a href="<?php print(Flight::getConfig('url')); ?>/moje-szkolenia"
							class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="bottom"
							title="Powrót do listy szkoleń">
								<i class="fa-solid fa-chevron-left"></i>
						</a>
					</div>
					<div class="col-8 fs-3 text-center fw-bold"><?php print($course_name); ?></div>
					<div class="col-2"></div>
				</div>
				<div class="fst-italic text-center">Prowadzący: <a href="<?php print(Flight::getConfig('url')); ?>/uzytkownik-<?php print($course_admin_id); ?>"><?php print($course_admin_name); ?></a></div>
			</div>
			<div id="infinitePosts" class="mt-4"></div>
			<div class="text-center alert bg-body-secondary h3 fw-normal" id="infinitePosts_loading">
				<div class="spinner-border" style="width: 3rem;height: 3rem;" role="status">
					<span class="visually-hidden">Wczytywanie...</span>
				</div>
			</div>
			<div class="alert alert-light d-none" id="infinitePosts_noPosts">To szkolenie nie zostało jeszcze uzupełnione.</div>
		</div>
	</div>
</div>
<script>
	const infinitePosts_url = '<?php print(Flight::getConfig('url')); ?>/ajax/loadCourseSections/<?php print($course_id); ?>/';
</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/infinitePosts.js"></script>