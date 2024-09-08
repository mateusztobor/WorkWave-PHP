<div class="card mb-4" id="comment_<?php print($post['id']); ?>">
	<div class="card-header d-flex d-flex align-items-center">
		<a href="<?php print(Flight::getConfig('url')); ?>/uzytkownik-<?php print($post['user_id']); ?>" class="text-dark d-flex align-items-center"><img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($post['user_id']); ?>" alt="" style="width:32px;height:32px;" class="rounded-circle me-2"> <?php print($post['first_name'].' '.$post['second_name']); ?></a>
	</div>
	<div class="card-body post_content">
		<p class="card-text"><?php print(Flight::convertTagsToHTML($post['content'])); ?></p>
	</div>
	<?php if(Flight::checkPostOrCommentImage($post['id'],'comment')) { ?>
		<div class="card-body p-0">
			<img src="<?php print(Flight::getConfig('url')); ?>/uploads/comments/<?php print($post['id']); ?>" class="img-fluid">
		</div>
	<?php } ?>
	<div class="card-footer text-body-secondary no-links-underline ext-center text-md-start">
		<?php if(Flight::commentReaction($post['id'])) { ?>
			<a id="comment_<?php print($post['id']); ?>_reaction" onclick="commentReaction(<?php print($post['id']); ?>)" class="me-3 text-danger" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nie lubię">
				<i class="fa-solid fa-heart" id="comment_<?php print($post['id']); ?>_reaction_heart"></i> <span id="comment_<?php print($post['id']); ?>_reaction_count"><?php print(Flight::formatToShortNumber($post['reactions'])); ?></span>
			</a>
		<?php } else { ?>
			<a id="comment_<?php print($post['id']); ?>_reaction" onclick="commentReaction(<?php print($post['id']); ?>)" class="me-3 text-body-secondary" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lubię to">
				<i class="fa-regular fa-heart" id="comment_<?php print($post['id']); ?>_reaction_heart"></i> <span id="comment_<?php print($post['id']); ?>_reaction_count"><?php print(Flight::formatToShortNumber($post['reactions'])); ?></span>
			</a>
		<?php } ?>
		<span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dodano <?php print(Flight::formatDateTime2($post['time'])); ?>">
			<i class="fa-regular fa-clock"></i> <?php print(Flight::howTimeAgo($post['time'])); ?>
		</span>
		<?php if($post['user_id'] == Flight::user('id')) { ?>
			<a onclick="delComment(<?php print($post['id']); ?>);" class="ms-3 text-body-secondary" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Usuń odpowiedź">
				<i class="fa-solid fa-xmark"></i> Usuń
			</a>
		<?php } ?>
	</div>
</div>