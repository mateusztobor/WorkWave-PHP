<a href="<?php print(Flight::getConfig('url')); ?>/wiadomosci/<?php print($user['id']); ?>" class="d-block text-dark text-decoration-none mb-4 p-2 border rounded">
		<div class="row d-flex align-items-center">
			<div class="col-auto text-end pe-0">
				<img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($user['id']); ?>" alt="" style="width:64px;height:64px;" class="rounded-circle me-2">
			</div>
			<div class="col ps-0">
				<div><?php print($user['name']); ?></div>
				<?php if(isset($message)) { ?>
					<div class="<?php print(!$is_read && !$lastYourMessage ? ' fw-bold' : ''); ?>
						<?php print($lastYourMessage ? ' text-secondary' : ' text-primary'); ?>"><i class="fa-solid fa-message"></i> <?php print($lastYourMessage ? 'Ty: ' : ''); ?><?php print($message); ?>
						<?php print($is_read && $lastYourMessage ? ' <i class="fa-regular fa-eye text-primary" title="Przeczytane"></i>' : ''); ?>
					</div>
				<?php } else { ?>
					<div class="text-success"><i class="fa-solid fa-play"></i> Przejdź do rozmowy</div>
				<?php } ?>
			</div>
		</div>
</a>