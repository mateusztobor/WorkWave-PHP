<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-xl-5">
		<div class="px-xl-5 mx-lg-5">
			<div class="mb-4">

				<div class="row d-flex align-items-center">
					<div class="col-2 text-start">
						<a href="<?php print(Flight::getConfig('url')); ?>/szkolenia/szkolenie-<?php print($course['id']); ?>"
							class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="bottom"
							title="Powrót do listy sekcji szkolenia">
								<i class="fa-solid fa-chevron-left"></i>
						</a>
					</div>
					<div class="col-8">
						<div class="fs-4 text-center fw-bold"><?php print($course['name']); ?></div>
					</div>
					<div class="col-2"></div>
				</div>
				<div class="input-group input-group-lg my-3">
					<a href="<?php print(Flight::getConfig('url')); ?>/deleteCourseSection/<?php print($section['id']); ?>"
						onclick="return confirm('Czy na pewno chcesz usunąć tę sekcję?');"
						class="btn btn-danger d-flex align-items-center"
						data-bs-toggle="tooltip" data-bs-placement="bottom" title="Usuń sekcję">
							<i class="fa-regular fa-trash-can"></i>
					</a>
					<input type="text" class="border-dark form-control fs-4 text-center" maxlength="128" id="name" value="" placeholder="<?php print($section['title']); ?>">
					<button type="button" onclick="updateCourseName(true);" class="btn btn-success"
						data-bs-toggle="tooltip" data-bs-placement="bottom" title="Zapisz">
							<i class="fa-solid fa-check"></i>
					</button>
				</div>
			</div>
			<div><i class="fa-solid fa-floppy-disk"></i> <span id="lastSync"></span></div>
			<textarea id="editor"><?php print($section['content']); ?></textarea>
			
		</div>
	</div>
</div>
<script>
	initTooltips();
	const updateCourseName_id = <?php print($section['id']); ?>;
</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/updateCourseName.js"></script>
<?php Flight::render('course_trainer_section_editor'); ?>