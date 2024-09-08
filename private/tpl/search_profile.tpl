<a href="<?php print(Flight::getConfig('url')); ?>/uzytkownik-<?php print($user['id']); ?>" class="text-decoration-none">
	<div class="card mb-4" id="user_<?php print($user['id']); ?>">
		<div class="card-header d-flex align-items-center justify-content-between border-0">
			<span class="text-dark d-flex align-items-center"><img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($user['id']); ?>" alt="" style="width:32px;height:32px;" class="rounded-circle me-2"> <?php print($user['first_name'].' '.$user['second_name']); ?><?php print($banned ? '<span class="ms-2 badge bg-dark text-white"><i class="fa-solid fa-user-slash"></i> Profil nieaktywny</span>' : ''); ?></span>
			<a href="<?php print(Flight::getConfig('url')); ?>/wiadomosci/<?php print($user['id']); ?>" class="btn btn-light"><i class="fa-regular fa-envelope"></i></a>
		</div>
	</div>
</a>