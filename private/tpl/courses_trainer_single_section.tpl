<div
	class="d-block border border-dark border-1 rounded p-3 mb-4 d-flex justify-content-between align-items-center text-decoration-none text-dark"
	id="section_<?php print($section['id']); ?>">
		<a class="d-block text-decoration-none"
			href="<?php print(Flight::getConfig('url')); ?>/szkolenia/szkolenie-<?php print($course_id); ?>/sekcja-<?php print($section['id']); ?>">
				<div class="small text-secondary">Sekcja</div>
				<div class="fw-bold fs-5 text-dark"><?php print($section['title']); ?></div>
		</a>
		<div>
			<?php if(isset($noTrainer)) { ?>
				<i class="fa-solid fa-angles-right"></i>
			<?php } else { ?>
				<div>
					<button class="btn btn-light" onclick="moveCourseSection(0,<?php print($section['id']); ?>);"><i class="fa-solid fa-arrow-down"></i></button>
					<button class="btn btn-light" onclick="moveCourseSection(1,<?php print($section['id']); ?>);"><i class="fa-solid fa-arrow-up"></i></button>
					<a class="btn btn-light"
						href="<?php print(Flight::getConfig('url')); ?>/szkolenia/szkolenie-<?php print($course_id); ?>/sekcja-<?php print($section['id']); ?>">
							<i class="fa-solid fa-angles-right"></i>
					</a>
				</div>
			<?php } ?>
		</div>
</div>