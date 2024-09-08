<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-xl-5">
		<div class="px-xl-5 mx-lg-5">
			<div class="mb-4 text-center text-xl-end d-grid d-xl-block">
				<button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#newGroup"><i class="fa-solid fa-users-line"></i> Utwórz nowe szkolenie</button> 
			</div>
			<div class="card-header text-center h5 bg-white mb-4">
				Zarządzanie szkoleniami
			</div>
			<div class="mt-4">
				<input type="text" class="form-control form-control-lg border-dark" id="query" placeholder="Wyszukaj..." onkeyup="reloadSearch()">
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
<form method="post" action="<?php print(Flight::getConfig('url')); ?>/createCourse">
<div class="modal fade modal-lg" id="newGroup" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tworzenie nowego szkolenia</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
			</div>
			<div class="modal-body">
				<div class="form-floating mb-3">
					<input class="form-control" value="" placeholder="Nazwa szkolenia" maxlength="50" id="name" name="name">
					<label for="name">Nazwa szkolenia</label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Anuluj</button>
				<button type="submit" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-user-group"></i> Utwórz</button>
			</div>
		</div>
	</div>
</div>
</form>
<script>const search_url = '<?php print(Flight::getConfig('url')); ?>/ajax/loadTrainerCourses';</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/search2.js"></script>