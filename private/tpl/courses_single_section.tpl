<a 
	href="<?php print(Flight::getConfig('url')); ?>/moje-szkolenia/szkolenie-<?php print($course_id); ?>/sekcja-<?php print($section['id']); ?>"
	class="d-block border border-dark border-1 rounded p-3 mb-4 d-flex justify-content-between align-items-center text-decoration-none text-dark"
	id="training_<?php print($section['id']); ?>">
		<div>
			<div class="small text-secondary">Sekcja</div>
			<div class="fw-bold fs-5"><?php print($section['title']); ?></div>
		</div>
		<div>
			<i class="fa-solid fa-angles-right"></i>
		</div>
</a>