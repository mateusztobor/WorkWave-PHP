<div class="card mb-4" id="user_<?php print($user['id']); ?>">
	<div class="card-header border-0 d-flex align-items-center justify-content-between">
		<span class="d-flex align-items-center">
			<a href="<?php print(Flight::getConfig('url')); ?>/uzytkownik-<?php print($user['id']); ?>" class="text-decoration-none text-dark d-flex align-items-center">
				<img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($user['id']); ?>" alt="" style="width:32px;height:32px;" class="rounded-circle me-2"> <?php print($user['first_name'].' '.$user['second_name']); ?>
			</a>
			<?php print($banned ? '<span class="ms-2 badge bg-dark text-white"><i class="fa-solid fa-user-slash"></i> Profil nieaktywny</span>' : ''); ?>
		</span>
		<div class="btn-group border-success border" role="group" aria-label="Basic example">
			<button type="button" class="btn btn-light" onclick="groupRequestDecision(<?php print($user['id']); ?>,0)"><i class="fa-solid fa-x"></i> Odrzuć</button>
			<button type="button" class="btn btn-success bg-gradient" onclick="groupRequestDecision(<?php print($user['id']); ?>,1)"><i class="fa-solid fa-check"></i> Akceptuj</button>
		</div>
	</div>
</div>