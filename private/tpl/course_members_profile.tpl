<div class="card mb-4" id="user_<?php print($user['id']); ?>">
	<div class="card-header border-0 d-flex align-items-center justify-content-between">
		<span class="d-flex align-items-center">
			<a href="<?php print(Flight::getConfig('url')); ?>/uzytkownik-<?php print($user['id']); ?>" class="text-decoration-none text-dark d-flex align-items-center">
				<img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($user['id']); ?>" alt="" style="width:32px;height:32px;" class="rounded-circle me-2"> <?php print($user['first_name'].' '.$user['second_name']); ?>
			</a>
			<?php print($banned ? '<span class="ms-2 badge bg-dark text-white"><i class="fa-solid fa-user-slash"></i> Profil nieaktywny</span>' : ''); ?>
		</span>
		<div>
			<?php if($trainer && $user['id'] !== Flight::user('id')) { ?>
				<a href="<?php print(Flight::getConfig('url')); ?>/delegateCourseAdmin/<?php print($course_id); ?>/<?php print($user['id']); ?>"
					class="btn btn-warning bg-gradient"
					onclick="return confirm('Czy na pewno chcesz przekazać uprawnienia administratora kursu temu użytkownikowi?');">
						<i class="fa-regular fa-hand"></i> Przekaż administratora
				</a>
			<?php } ?>
			<button type="button" id="userRemove_<?php print($user['id']); ?>" class="btn btn-danger bg-gradient<?php print($isMember ? '' : ' d-none');?>" onclick="courseMemberDecision(<?php print($user['id']); ?>,0)"><i class="fa-solid fa-minus"></i> Usuń z kursu</button>
			<button type="button" id="userAdd_<?php print($user['id']); ?>" class="btn btn-success bg-gradient<?php print($isMember ? ' d-none' : '');?>" onclick="courseMemberDecision(<?php print($user['id']); ?>,1)"><i class="fa-solid fa-plus"></i> Dodaj do kursu</button>
		</div>
	</div>
</div>