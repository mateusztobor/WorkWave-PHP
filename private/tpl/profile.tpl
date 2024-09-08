<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-lg-5">
		<div class="px-md-5 mx-lg-5">
			<div class="card mb-4 border-<?php print(Flight::checkUserRole($user_id, 'b') ? 'secondary' : 'primary'); ?>">
				<div class="card-body bg-<?php print(Flight::checkUserRole($user_id, 'b') ? 'secondary' : 'primary'); ?> bg-gradient text-center px-5">
					<div class="px-5" id="p"><img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($user_id); ?>" id="currentPhoto" alt="Zdjęcie profilowe użytkownika" class="my-3 img-fluid rounded-circle w-100 shadow border border-3 border-<?php print(Flight::checkUserRole($user_id, 'b') ? 'secondary' : 'info'); ?>"></div>
				</div>
				<div class="card-body mb-0 text-center bg-<?php print(Flight::checkUserRole($user_id, 'b') ? 'secondary' : 'primary'); ?> bg-gradient text-light border-0 py-2">
					<span class="h2 fw-bold"><?php print($user['first_name'].' '.$user['second_name']); ?></span>
					<?php if(Flight::checkUserRole($user_id, 'b')) { ?>
						<div class="small"><i class="fa-solid fa-user-slash"></i> Ten profil jest nieaktywny.</div>
					<?php } ?>
				</div>
				
				<div class="card-body bg-<?php print(Flight::checkUserRole($user_id, 'b') ? 'secondary' : 'primary'); ?> border-0 text-center py-2 d-grid d-lg-block gap-2 gap-lg-0">
					<?php if($user['id'] == Flight::user('id')) { ?>
						<label class="btn btn-profile" for="updateProfilePhoto">
							<input type="file" class="d-none" id="updateProfilePhoto">
							<i class="fa-solid fa-image-portrait"></i> Zaktualizuj zdjęcie profilowe
						</label>
						<button class="btn btn-profile" data-bs-toggle="modal" data-bs-target="#updateProfileDesc"><i class="fa-solid fa-receipt"></i> Edytuj opis profilu</button>
					<?php } else { ?>
						<a class="btn btn-profile" href="<?php print(Flight::getConfig('url')); ?>/wiadomosci/<?php print($user_id); ?>"><i class="fa-regular fa-envelope"></i> Wiadomości</a>
						<?php if(
							Flight::isAuthorized('a') || ((Flight::isAuthorized('m') || Flight::isAuthorized('r')))
							&&
							(!Flight::checkUserRole($user_id, 'a') && !Flight::checkUserRole($user_id, 'm') && !Flight::checkUserRole($user_id, 'r') && !Flight::checkUserRole($user_id, 't'))
							) { ?>
								<a class="btn btn-profile" onclick="return confirm('Czy na pewno chcesz <?php print(Flight::checkUserRole($user_id,'b') ? 'przywrócić' : 'dezaktywować'); ?> ten profil?')" href="<?php print(Flight::getConfig('url')); ?>/banAccount/<?php print($user_id); ?>"><?php print(Flight::checkUserRole($user_id,'b') ? '<i class="fa-solid fa-user-check"></i> Przywróć profil' : '<i class="fa-solid fa-user-slash"></i> Dezaktywuj profil'); ?></a>
						<?php } ?>
					<?php } ?>
				</div>
				
				<?php if(!empty($user['description'])) { ?>
					<div class="card-body">
						<p class="card-text post_content" id="profile_desc"><?php print(Flight::convertTagsToHTML($user['description'])); ?></p>
					</div>
				<?php } ?>
			</div>
			<div id="infinitePosts"></div>
			<div class="text-center alert bg-body-secondary h3 fw-normal" id="infinitePosts_loading">
				<div class="spinner-border" style="width: 3rem;height: 3rem;" role="status">
					<span class="visually-hidden">Wczytywanie...</span>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/postReaction.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/postFollow.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/delPost.js"></script>
<script>var infinitePosts_url = '<?php print(Flight::getConfig('url')); ?>/ajax/profile/<?php print($user_id); ?>/page-';</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/infinitePosts.js"></script>


<?php if($user['id'] == Flight::user('id')) { ?>
	<div class="modal fade modal-lg" id="updateProfileDesc" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edycja opisu profilu</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
				</div>
				<div class="modal-body">
					<label for="profileDesc" class="form-label"><span id="profileDesc_counter"></span>/500</label>
					<textarea class="form-control h-75 post_content" id="profileDesc"><?php print($user['description']); ?></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Anuluj</button>
					<button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="updateProfileDesc();"><i class="fa-solid fa-check"></i> Zapisz</button>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/updateProfilePhoto.js"></script>
	<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/getProfileDesc.js"></script>
	<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/replaceEmoticonsWithEmoji.js"></script>
	<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/updateProfileDesc.js"></script>
<?php } ?>