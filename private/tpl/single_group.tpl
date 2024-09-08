
<div class="card mb-4 border-primary" id="group_<?php print($group['id']); ?>">
	<div class="card-body mb-0 text-center bg-primary bg-gradient text-light border-0 h2 fw-bold py-4">
		<?php print($group['name']); ?>
	</div>
	
	<div class="card-body bg-primary border-0 text-center py-2 d-grid d-xl-block gap-2 gap-xl-0">
		<?php if($group['admin'] == Flight::user('id')) { ?>
			<a href="<?php print(Flight::getConfig('url')); ?>/switchGroupPublic/<?php print($group['id']); ?>" class="btn btn-profile" onclick="return confirm('Czy na pewno chcesz zmienić typ grupy?');"><i class="fa-solid fa-lock<?php print($group['public'] ? '-open' : ''); ?>"></i> Grupa <?php print($group['public'] ? 'publiczna' : 'prywatna'); ?></a>
			<a role="button" href="<?php print(Flight::getConfig('url')); ?>/grupa-<?php print($group['id']); ?>/czlonkowie" class="btn btn-profile"><i class="fa-solid fa-users"></i> <?php print(Flight::formatToShortNumber($group['members'])); ?></a>
			<button type="button" id="leaveGroup_<?php print($group['id']); ?>" onClick="removeGroup(<?php print($group['id']); ?>);" class="btn btn-profile"><i class="fa-solid fa-trash"></i> Usuń grupę</button>
			<button class="btn btn-profile" data-bs-toggle="modal" data-bs-target="#updateGroupDesc"><i class="fa-solid fa-receipt"></i> Edytuj opis grupy</button>
		<?php } else { ?>
			<span class="btn btn-profile"><i class="fa-solid fa-lock<?php print($group['public'] ? '-open' : ''); ?>"></i> Grupa <?php print($group['public'] ? 'publiczna' : 'prywatna'); ?></span>
			<a role="button" 
				<?php if($member) { ?>
					href="<?php print(Flight::getConfig('url')); ?>/grupa-<?php print($group['id']); ?>/czlonkowie"
				<?php } ?>
				class="btn btn-profile"><i class="fa-solid fa-users"></i> <?php print(Flight::formatToShortNumber($group['members'])); ?></a>
			<?php if($group['public']) { ?>
				<button type="button" id="joinGroup_<?php print($group['id']); ?>" onClick="joinGroup(<?php print($group['id']); ?>);" class="btn btn-profile<?php print(Flight::currentUserInGroup($group['id']) ? ' d-none' : ''); ?>"><i class="fa-solid fa-user-plus"></i> Dołącz do grupy</button>
				<button type="button" id="leaveGroup_<?php print($group['id']); ?>" onClick="leaveGroup(<?php print($group['id']); ?>);" class="btn btn-profile<?php print(!Flight::currentUserInGroup($group['id']) ? ' d-none' : ''); ?>"><?php print($group['admin'] == Flight::user('id') ? '<i class="fa-solid fa-trash"></i> Usuń grupę' : '<i class="fa-solid fa-user-minus"></i> Opuść grupę'); ?></button>
				
			<?php } else { ?>
				<button type="button" id="requestGroup_<?php print($group['id']); ?>" onClick="requestGroup(<?php print($group['id']); ?>);" class="btn btn-profile<?php print((Flight::currentUserInGroup($group['id']) || Flight::currentUserRequestGroup($group['id'])) ? ' d-none' : ''); ?>"><i class="fa-regular fa-hand"></i> Poproś o dołączenie</button>
				<button type="button" id="cancelRequestGroup_<?php print($group['id']); ?>" onClick="cancelRequestGroup(<?php print($group['id']); ?>);" class="btn btn-profile<?php print((Flight::currentUserInGroup($group['id']) || !Flight::currentUserRequestGroup($group['id'])) ? ' d-none' : ''); ?>"><i class="fa-solid fa-rotate-left"></i> Cofnij prośbę o dołączenie</button>
				<button type="button" id="leaveGroup_<?php print($group['id']); ?>" onClick="leaveGroup(<?php print($group['id']); ?>);" class="btn btn-profile<?php print((!Flight::currentUserInGroup($group['id'])) ? ' d-none' : ''); ?>"><?php print($group['admin'] == Flight::user('id') ? '<i class="fa-solid fa-trash"></i> Usuń grupę' : '<i class="fa-solid fa-user-minus"></i> Opuść grupę'); ?></button>
			<?php } ?>
		<?php } ?>

	</div>
	
	<?php if(!empty($group['description']) && ($member || $group['public'])) { ?>
		<div class="card-body">
			<p class="card-text post_content" id="group_desc"><?php print(Flight::convertTagsToHTML($group['description'])); ?></p>
		</div>
	<?php } ?>
</div>
