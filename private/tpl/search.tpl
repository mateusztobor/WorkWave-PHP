<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-xl-5">
		<div class="px-xl-5 mx-lg-5">
			<div>
				<input type="text" class="form-control form-control-lg" id="query" placeholder="Wyszukaj..." onkeyup="reloadSearch()">
			</div>
			<div class="my-2">
				<select class="form-select" id="type" onchange="reloadSearch()">
					<option value="1" selected>Użytkownicy</option>
					<option value="2">Wpisy</option>
					<option value="3">Grupy</option>
				</select>
			</div>
			<div id="results" class="mt-4"></div>
			<div id="searchLoading" class="text-center alert bg-body-secondary h3 fw-normal d-none">
				<div class="spinner-border" style="width: 3rem;height: 3rem;" role="status">
					<span class="visually-hidden">Wczytywanie...</span>
				</div>
			</div>
			<div id="noSearch" class="alert alert-light">Wprowadź frazę, aby wyszukać.</div>
			<div id="endSearch" class="alert alert-light d-none">Wszystkie wyniki wyszukiwania zostały wyświetlone.</div>
			<div id="noResults" class="alert alert-light d-none">Brak wyników do wyświetlenia.</div>
		</div>
	</div>
</div>

<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/postReaction.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/postFollow.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/delPost.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/joinGroup.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/leaveGroup.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/requestGroup.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/cancelRequestGroup.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/search.js"></script>