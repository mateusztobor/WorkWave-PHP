<div id="<?php print($message_id); ?>">
	<div class="text-end">
		<p class="small mb-1 text-muted"><?php print($is_read ? ' <i class="fa-regular fa-eye text-primary" title="Przeczytane"></i>' : ''); ?> <?php print(Flight::formatDateTime2($time)); ?></p>
	</div>
	<div class="d-flex flex-row justify-content-end mb-3 pt-1">
		<div>
			<p class="small p-2 me-3 mb-3 rounded-3 bg-body-secondary shadow-sm text-break"><?php print(Flight::convertTagsToHTML($message)); ?></p>
		</div>
		<img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($user_id); ?>" alt="User Photo" style="width:45px;height:45px;" class="rounded-circle">
	</div>
</div>