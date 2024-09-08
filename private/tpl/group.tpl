<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-lg-5">
		<div class="px-md-5 mx-lg-5">
			<?php Flight::render('single_group'); ?>
			<?php if($member) { ?>
				<?php if($group['admin'] == Flight::user('id') || $member['moderator']) { ?>
					<div class="alert alert-light mb-4"><i class="fa-solid fa-user-tie"></i> Jesteś <?php print($group['admin'] == Flight::user('id') ? 'administratorem' : 'moderatorem'); ?> tej grupy.</div>
					<?php if($requests) { ?>
						<div class="d-grid mb-4">
							<a href="<?php print(Flight::getConfig('url')); ?>/grupa-<?php print($group['id']); ?>/prosby" class="btn btn-lg btn-primary bg-gradient text-center"><span class="badge bg-light rounded-circle text-primary"><?php print($requests_count); ?></span> Przeglądaj prośby o dołączenie do grupy</a>
						</div>
					<?php } ?>
				<?php } ?>
				<?php
					Flight::render('add_post', ['group'=>$group['id']]);
					print(Flight::msgs());
				?>
				<div id="infinitePosts"></div>
				<div class="text-center alert bg-body-secondary h3 fw-normal" id="infinitePosts_loading">
					<div class="spinner-border" style="width: 3rem;height: 3rem;" role="status">
						<span class="visually-hidden">Wczytywanie...</span>
					</div>
				</div>
				<div class="text-center alert bg-body-secondary h3 fw-normal d-none" id="infinitePosts_noPosts">Brak wpisów do wyświetlenia</div>
				<div class="text-center alert bg-body-secondary h3 fw-normal d-none" id="infinitePosts_end">Wszystkie wpisy zostały wyświetlone</div>
			<?php } else { ?>
				<div class="text-center alert bg-body-secondary h3 fw-normal">Tylko członkowie grupy mogą czytać i publikować wpisy.</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php if($group['admin'] == Flight::user('id')) { ?>
	<div class="modal fade modal-lg" id="updateGroupDesc" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edycja opisu profilu</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
				</div>
				<div class="modal-body">
					<label for="groupDesc" class="form-label"><span id="groupDesc_counter"></span>/500</label>
					<textarea class="form-control h-75 post_content" id="groupDesc"><?php print($group['description']); ?></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Anuluj</button>
					<button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="updateGroupDesc(<?php print($group['id']); ?>);"><i class="fa-solid fa-check"></i> Zapisz</button>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/updateGroupDesc.js"></script>
	<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/getGroupDesc.js"></script>
	<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/removeGroup.js"></script>
<?php } ?>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/postReaction.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/postFollow.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/delPost.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/joinGroup4.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/leaveGroup4.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/requestGroup.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/cancelRequestGroup.js"></script>
<script>var infinitePosts_url = '<?php print(Flight::getConfig('url')); ?>/ajax/group/<?php print($group_id); ?>/page-';</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/infinitePosts.js"></script>