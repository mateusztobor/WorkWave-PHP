<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-xl-5">
		<div class="px-xl-5 mx-lg-5">
			<div class="mb-4">
				<a href="<?php print(Flight::getConfig('url')); ?>/szkolenia"
					class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="bottom"
					title="Powrót do listy szkoleń">
						<i class="fa-solid fa-chevron-left"></i>
				</a>
				<div class="input-group input-group-lg my-3">
					<a href="<?php print(Flight::getConfig('url')); ?>/deleteCourse/<?php print($course_id); ?>" onclick="return confirm('Czy na pewno chcesz usunąć to szkolenie?');"
						class="btn btn-danger d-flex align-items-center"
						data-bs-toggle="tooltip" data-bs-placement="bottom" title="Usuń szkolenie">
							<i class="fa-regular fa-trash-can"></i>
					</a>
					<input type="text" class="border-dark form-control fs-4 text-center" maxlength="128" id="name" value="" placeholder="<?php print($course_name); ?>">
					<button type="button" onclick="updateCourseName();" class="btn btn-success"
						data-bs-toggle="tooltip" data-bs-placement="bottom" title="Zapisz">
							<i class="fa-solid fa-check"></i>
					</button>
				
				</div>
			</div>
			<a href="<?php print(Flight::getConfig('url')); ?>/szkolenia/szkolenie-<?php print($course_id); ?>/uczestnicy"
				class="d-block text-center btn btn-primary bg-gradient mb-4">
					<i class="fa-solid fa-user-group"></i> Uczestnicy szkolenia
			</a>
			<a href="<?php print(Flight::getConfig('url')); ?>/addCourseSection/<?php print($course_id); ?>"
				class="d-block text-decoration-none text-center alert bg-light text-secondary fs-5 fw-normal">
					<i class="fa-solid fa-circle-plus"></i> Utwórz sekcję
			</a>
			<div id="infinitePosts" class="mt-4"></div>
			<div class="text-center alert bg-body-secondary h3 fw-normal" id="infinitePosts_loading">
				<div class="spinner-border" style="width: 3rem;height: 3rem;" role="status">
					<span class="visually-hidden">Wczytywanie...</span>
				</div>
			</div>
			<div class="alert alert-light d-none" id="infinitePosts_noPosts">To szkolenie nie zostało jeszcze uzupełnione.</div>
			<a href="<?php print(Flight::getConfig('url')); ?>/addCourseSection/<?php print($course_id); ?>"
				class="d-block text-decoration-none text-center alert bg-light text-secondary fs-5 fw-normal">
					<i class="fa-solid fa-circle-plus"></i> Utwórz sekcję
			</a>
		</div>
	</div>
</div>
<script>
	const infinitePosts_url = '<?php print(Flight::getConfig('url')); ?>/ajax/loadTrainerCourseSections/<?php print($course_id); ?>/';
	const updateCourseName_id = <?php print($course_id); ?>;
</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/moveCourseSection.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/updateCourseName.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/infinitePosts.js"></script>