<div class="card mb-4" id="user_<?php print($user['id']); ?>">
	<div class="card-header border-0 d-flex align-items-center justify-content-between">
		<span class="d-flex align-items-center">
			<a href="<?php print(Flight::getConfig('url')); ?>/uzytkownik-<?php print($user['id']); ?>" class="text-decoration-none text-dark d-flex align-items-center">
				<img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($user['id']); ?>" alt="" style="width:32px;height:32px;" class="rounded-circle me-2"> <?php print($user['first_name'].' '.$user['second_name']); ?>
			</a>
			<?php print($banned ? '<span class="ms-2 badge bg-dark text-white"><i class="fa-solid fa-user-slash"></i> Profil nieaktywny</span>' : ''); ?>
			<?php if($group_admin == $user['id']) { ?>
				<span class="ms-2 badge bg-danger text-white fw-normal">Administrator grupy</span>
			<?php } else { ?>
				<span id="modBadge_<?php print($user['id']); ?>" class="ms-2 badge bg-success text-white fw-normal<?php print($user['moderator'] ? '' : ' d-none'); ?>">Moderator grupy</span>
			<?php } ?>
		</span>
		<?php if(($admin || $moderator) && (Flight::user('id') != $user['id'])) { ?>
			<div class="dropdown">
				<button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
					<i class="fa-solid fa-user-gear"></i>
				</button>
				<ul class="dropdown-menu">
					<?php if($admin) { ?>
						<li><span class="dropdown-item" role="button" onclick="delegateGroupAdmin(<?php print($user['id']); ?>);"><i class="fa-regular fa-hand"></i> Przekaż uprawnienia administratora</span></li>
						<li id="grantGroupMod_<?php print($user['id']); ?>" <?php print($user['moderator'] ? 'class="d-none"' : ''); ?>><span class="dropdown-item" role="button" onclick="grantGroupModPerm(<?php print($user['id']); ?>);"><i class="fa-solid fa-plus"></i> Nadaj uprawnienia moderatora</span></li>
						<li id="revokeGroupMod_<?php print($user['id']); ?>" <?php print($user['moderator'] ? '' : 'class="d-none"'); ?>><span class="dropdown-item" role="button" onclick="revokeGroupModPerm(<?php print($user['id']); ?>);"><i class="fa-solid fa-minus"></i> Zabierz uprawnienia moderatora</span></li>
					<?php } ?>
					<?php if($admin || (!$user['moderator'] && $group_admin != $user['id'])) { ?>
						<li><span class="dropdown-item" role="button" onclick="kickGroupMember(<?php print($user['id']); ?>);"><i class="fa-solid fa-door-open"></i> Wyrzuć użytkownika z grupy</span></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	</div>
</div>