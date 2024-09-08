	<div class="mt-5">
		<div class="px-lg-5 mx-lg-5">
			<div class="px-lg-5 mx-xl-5 pb-3">
				<div class="px-xl-5 mx-lg-5 pb-5" id="messages">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="position-fixed w-100 bg-white" style="top:62px;z-index:2;">
	<div class="container">
		<div class="px-lg-5 mx-lg-5">
			<div class="px-lg-5 mx-xl-5">
				<div class="px-xl-5 mx-lg-5 bg-white pt-1">
					<div class="row bg-light py-2 rounded shadow-sm">
						<div class="col-2 d-flex align-items-center">
							<a href="<?php print(Flight::getConfig('url')); ?>/wiadomosci" class="btn btn-light"><i class="fa-solid fa-chevron-left"></i></a>
							<a href="" class="btn btn-light"><i class="fa-solid fa-rotate-right"></i></a>
						</div>
						<div class="col-8 d-flex align-items-center justify-content-center">
							<img src="<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print($user_id); ?>" alt="User Photo" style="width:32px;height:32px;" class="rounded-circle me-2"> <?php print($user_name); ?>
						</div>
						<div class="col-2 d-flex align-items-center justify-content-end">
							<a href="<?php print(Flight::getConfig('url')); ?>/uzytkownik-<?php print($user_id); ?>" class="btn btn-light"><i class="fa-regular fa-user"></i></a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="position-fixed w-100 py-2 bg-white chat-textbox" style="z-index:9999;">
	<div class="container">
		<div class="px-lg-5 mx-lg-5">
			<div class="px-lg-5 mx-xl-5">
				<div class="px-xl-5 mx-lg-5 bg-white">
					<?php if(Flight::checkUserRole($user_id, 'b')) { ?>
						<div class="p-3 rounded bg-dark text-white fw-normal bg-gradient"><i class="fa-solid fa-user-slash"></i> Ten profil jest nieaktywny.</div>
					<?php } else { ?>
						<div class="input-group ms-0 pe-0 me-0">
						  <input type="text" class="form-control form-control-lg" placeholder="Wprowadź treść..." id="editor" maxlength="256">
						  <button class="btn btn-lg btn-primary" onclick="sendMessage()"><i class="fa-regular fa-paper-plane"></i></button>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	const userId = <?php print($user_id); ?>;
</script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/replaceEmoticonsWithEmoji.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/messagesUser.js"></script>


