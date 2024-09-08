<div class="card mb-4" id="user_<?php print($user['id']); ?>">
	<div class="card-header border-0 d-flex align-items-center">
		<span class="d-flex align-items-center"><a href="<?php print(Flight::getConfig('url')); ?>/uzytkownik-<?php print($user['id']); ?>" class="text-decoration-none text-dark d-flex align-items-center"><img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($user['id']); ?>" alt="" style="width:32px;height:32px;" class="rounded-circle me-2"> <?php print($user['first_name'].' '.$user['second_name']); ?></a><?php print($banned ? '<span class="ms-2 badge bg-dark text-white"><i class="fa-solid fa-user-slash"></i> Profil nieaktywny</span>' : ''); ?></span>
	</div>
	<div class="card-body">
		<ul class="list-group">
			<li class="list-group-item border-secondary d-flex align-items-center justify-content-between">
				Moderator
				<div>
					<button class="btn btn-sm btn-success<?php print(in_array('m', $user['roles']) ? ' d-none' : ''); ?>" id="grant-1-<?php print($user['id']); ?>" onclick="setPerm(1,1,<?php print($user['id']); ?>);"<?php print(($user['id'] == Flight::user('id') || $user['id'] == 1) ? ' disabled' : ''); ?>><i class="fa-solid fa-plus"></i> Nadaj uprawnienia</button>
					<button class="btn btn-sm btn-danger<?php print(!in_array('m', $user['roles']) ? ' d-none' : ''); ?>" id="revoke-1-<?php print($user['id']); ?>" onclick="setPerm(0,1,<?php print($user['id']); ?>);"<?php print(($user['id'] == Flight::user('id') || $user['id'] == 1) ? ' disabled' : ''); ?>><i class="fa-solid fa-minus"></i> Zabierz uprawnienia</button>
				</div>
			</li>
			<li class="list-group-item border-secondary d-flex align-items-center justify-content-between">
				Szkoleniowiec
				<div>
					<button class="btn btn-sm btn-success<?php print(in_array('t', $user['roles']) ? ' d-none' : ''); ?>" id="grant-2-<?php print($user['id']); ?>" onclick="setPerm(1,2,<?php print($user['id']); ?>);"<?php print(($user['id'] == Flight::user('id') || $user['id'] == 1) ? ' disabled' : ''); ?>><i class="fa-solid fa-plus"></i> Nadaj uprawnienia</button>
					<button class="btn btn-sm btn-danger<?php print(!in_array('t', $user['roles']) ? ' d-none' : ''); ?>" id="revoke-2-<?php print($user['id']); ?>" onclick="setPerm(0,2,<?php print($user['id']); ?>);"<?php print(($user['id'] == Flight::user('id') || $user['id'] == 1) ? ' disabled' : ''); ?>><i class="fa-solid fa-minus"></i> Zabierz uprawnienia</button>
				</div>
			</li>
			<li class="list-group-item border-secondary d-flex align-items-center justify-content-between">
				Rekruter
				<div>
					<button class="btn btn-sm btn-success<?php print(in_array('r', $user['roles']) ? ' d-none' : ''); ?>" id="grant-3-<?php print($user['id']); ?>" onclick="setPerm(1,3,<?php print($user['id']); ?>);"<?php print(($user['id'] == Flight::user('id') || $user['id'] == 1) ? ' disabled' : ''); ?>><i class="fa-solid fa-plus"></i> Nadaj uprawnienia</button>
					<button class="btn btn-sm btn-danger<?php print(!in_array('r', $user['roles']) ? ' d-none' : ''); ?>" id="revoke-3-<?php print($user['id']); ?>" onclick="setPerm(0,3,<?php print($user['id']); ?>);"<?php print(($user['id'] == Flight::user('id') || $user['id'] == 1) ? ' disabled' : ''); ?>><i class="fa-solid fa-minus"></i> Zabierz uprawnienia</button>
				</div>
			</li>
			<li class="list-group-item border-secondary d-flex align-items-center justify-content-between">
				Administrator
				<div>
					<button class="btn btn-sm btn-success<?php print(in_array('a', $user['roles']) ? ' d-none' : ''); ?>" id="grant-4-<?php print($user['id']); ?>" onclick="setPerm(1,4,<?php print($user['id']); ?>);"<?php print(($user['id'] == Flight::user('id') || $user['id'] == 1) ? ' disabled' : ''); ?>><i class="fa-solid fa-plus"></i> Nadaj uprawnienia</button>
					<button class="btn btn-sm btn-danger<?php print(!in_array('a', $user['roles']) ? ' d-none' : ''); ?>" id="revoke-4-<?php print($user['id']); ?>" onclick="setPerm(0,4,<?php print($user['id']); ?>);"<?php print($user['id']); ?><?php print(($user['id'] == Flight::user('id') || $user['id'] == 1) ? ' disabled' : ''); ?>><i class="fa-solid fa-minus"></i> Zabierz uprawnienia</button>
				</div>
			</li>
		</ul>
	</div>
</div>