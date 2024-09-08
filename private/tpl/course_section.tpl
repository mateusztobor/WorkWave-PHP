<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-xl-5">
		<div class="px-xl-5 mx-lg-5">
			<div class="card-header bg-white mb-4">
				<div class="row d-flex align-items-center">
					<div class="col-2 text-start">
						<a href="<?php print(Flight::getConfig('url')); ?>/moje-szkolenia/szkolenie-<?php print($course['id']); ?>"
							class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="bottom"
							title="Powrót do listy sekcji szkolenia">
								<i class="fa-solid fa-chevron-left"></i>
						</a>
					</div>
					<div class="col-8">
						<div class="fs-4 text-center"><?php print($course['name']); ?></div>
						<div class="fst-italic fs-3 fw-bold text-center"><?php print($section_title); ?></div>
					</div>
					<div class="col-2"></div>
				</div>
				<div class="mt-4 auto-img">
					<?php print($section_content); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	initTooltips();
</script>