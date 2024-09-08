<a 
	href="<?php print(Flight::getConfig('url')); ?>/<?php print(isset($noTrainer) ? 'moje-' : ''); ?>szkolenia/szkolenie-<?php print($course['id']); ?>"
	class="d-block border border-dark border-1 rounded p-3 mb-4 d-flex justify-content-between align-items-center text-decoration-none text-dark"
	id="training_<?php print($course['id']); ?>">
		<div>
			<div class="small text-secondary">Szkolenie</div>
			<div class="fw-bold fs-5"><?php print($course['name']); ?></div>
		</div>
		<div>
			<i class="fa-solid fa-angles-right"></i>
		</div>
</a>