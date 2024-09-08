<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-xl-5">
		<div class="px-xl-5 mx-lg-5 bg-white">
			<div class="row bg-light py-2 rounded shadow-sm">
				<div class="col-2 d-flex align-items-center">
					<a href="<?php print(Flight::getConfig('url')); ?>/grupa-<?php print($group['id']); ?>" class="btn btn-light"><i class="fa-solid fa-chevron-left"></i></a>
				</div>
				<div class="col-8 d-flex align-items-center justify-content-center">
					<div class="text-center"><strong class="fs-4"><?php print($group['name']); ?></strong><br>Prośby o dołączenie do grupy</div>
				</div>
				<div class="col-2"></div>
			</div>
			<div class="mt-4">
				<input type="text" class="form-control form-control-lg" id="query" placeholder="Wyszukaj osoby..." onkeyup="reloadSearch()">
			</div>
			<div id="results" class="mt-4"></div>
			<div id="searchLoading" class="text-center alert bg-body-secondary h3 fw-normal d-none">
				<div class="spinner-border" style="width: 3rem;height: 3rem;" role="status">
					<span class="visually-hidden">Wczytywanie...</span>
				</div>
			</div>
			<div id="endSearch" class="alert alert-light d-none">Wszystkie prośby zostały wyświetlone.</div>
			<div id="noResults" class="alert alert-light d-none">Brak próśb o dołączenie do grupy.</div>
		</div>
	</div>
</div>
</div>
<script>
	const group_id = <?php print($group['id']); ?>;
</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/groupRequests.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/groupRequestDecision.js"></script>
<script>const search_url = '<?php print(Flight::getConfig('url')); ?>/ajax/loadGroupRequests/<?php print($group['id']); ?>';</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/search2.js"></script>