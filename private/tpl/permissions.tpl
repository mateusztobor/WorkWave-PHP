<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-xl-5">
		<div class="px-xl-5 mx-lg-5">
			<h1 class="fw-normal h3 mb-3 text-center">Zarządzanie uprawnieniami użytkowników</h1>
			<div>
				<input type="text" class="form-control form-control-lg" id="query" placeholder="Wyszukaj osoby..." onkeyup="reloadSearch()">
			</div>
			<div id="results" class="mt-4"></div>
			
			
			<div id="searchLoading" class="text-center alert bg-body-secondary h3 fw-normal d-none">
				<div class="spinner-border" style="width: 3rem;height: 3rem;" role="status">
					<span class="visually-hidden">Wczytywanie...</span>
				</div>
			</div>
			<div id="endSearch" class="alert alert-light d-none">Wszystkie wyniki zostały wyświetlone.</div>
			<div id="noResults" class="alert alert-light d-none">Brak wyników do wyświetlenia.</div>
		</div>
	</div>
</div>



<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/setPerm.js"></script>
<script>const search_url = '<?php print(Flight::getConfig('url')); ?>/ajax/admin/loadPermissions';</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/search2.js"></script>
