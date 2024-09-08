<div id="<?php print($message_id); ?>">
	<div>
		<p class="small mb-1 text-muted"><?php print(Flight::formatDateTime2($time)); ?><?php print($is_read ? ' <i class="fa-regular fa-eye text-secondary" title="Przeczytane"></i>' : ''); ?></p>
	</div>
	<div class="d-flex flex-row justify-content-start">
		<img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($user_id); ?>" alt="User Photo" style="width:45px;height:45px;" class="rounded-circle">
		<div>
			<p class="small p-2 ms-3 mb-3 rounded-3 bg-light shadow-sm text-break"><?php print(Flight::convertTagsToHTML($message)); ?></p>
		</div>
	</div>
</div>