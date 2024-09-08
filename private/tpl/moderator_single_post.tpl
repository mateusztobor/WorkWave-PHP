<div class="card mb-4" id="post_<?php print($post['id']); ?>">
	<div class="card-header d-flex align-items-center">
		<a href="<?php print(Flight::getConfig('url')); ?>/uzytkownik-<?php print($post['user_id']); ?>" class="text-dark d-flex align-items-center"><img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($post['user_id']); ?>" alt="" style="width:32px;height:32px;" class="rounded-circle me-2"> <?php print($post['first_name'].' '.$post['second_name']); ?></a>
		<?php if(!empty($post['group_name'])) { ?>
			<i class="fa-solid fa-arrow-right mx-2"></i> <a href="<?php print(Flight::getConfig('url')); ?>/grupa-<?php print($post['group_id']); ?>"><span class="text-primary"><?php print($post['group_name']); ?></span></a>
		<?php } ?>
	</div>
	<div class="card-body post_content">
		<p class="card-text"><?php print(Flight::convertTagsToHTML($post['content'])); ?></p>
	</div>
	<?php if(Flight::checkPostOrCommentImage($post['id'])) { ?>
		<div class="card-body p-0">
			<img src="<?php print(Flight::getConfig('url')); ?>/uploads/posts/<?php print($post['id']); ?>" class="img-fluid w-100">
		</div>
	<?php } ?>
	<div class="card-footer text-body-secondary no-links-underline">
		<?php if(isset($in_discussion)) { ?>
			<span class="me-3 text-body-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php print(Flight::formatToShortNumber($post['comments'])); ?> odpowiedzi">
				<i class="fa-regular fa-comments"></i> <?php print(Flight::formatToShortNumber($post['comments'])); ?>
			</span>
		<?php } else { ?>
			<a href="<?php print(Flight::getConfig('url')); ?>/moderator/<?php print($post['id']); ?>" class="me-3 text-body-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Przejdź do dyskusji">
				<i class="fa-regular fa-comments"></i> <?php print(Flight::formatToShortNumber($post['comments'])); ?>
			</a>
		<?php } ?>

		<span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dodano <?php print(Flight::formatDateTime2($post['time'])); ?>">
			<i class="fa-regular fa-clock"></i> <?php print(Flight::howTimeAgo($post['time'])); ?>
		</span>

		<a onclick="modDelPost(<?php print($post['id']); ?><?php print(isset($in_discussion) ? ',true' : ''); ?>);" class="ms-3 text-body-secondary" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Usuń wpis">
			<i class="fa-solid fa-xmark"></i> Usuń
		</a>
	</div>
</div>