<form method="post" action="<?php print(Flight::getConfig('url')); ?>/wpis-<?php print($post_id); ?>#newComment">
<input type="hidden" id="post" value="<?php print($post_id); ?>">
	<div class="card mb-4">
		<div class="card-body p-0">
			<textarea class="form-control post_content border-0 w-100" rows="5" placeholder="Treść odpowiedzi..." maxlength="500" id="editor" required></textarea>
		</div>
		<div class="card-body p-0 d-none" id="new_post_image_box"></div>
		<div class="card-footer text-body-secondary no-links-underline">
			<div class="row d-flex align-items-center">
				<div class="col-auto">
					<button type="submit" id="btn_add_new_post" class="btn btn-light fw-bold bg-gradient"><i class="fa-solid fa-plus"></i> Opublikuj</button>
					<label class="btn btn-light" id="btn_new_post_image">
						<input type="file" class="d-none" id="new_post_image">
						<i class="fa-regular fa-image"></i> Dodaj zdjęcie
					</label>
					<button type="button" class="btn btn-light d-none" id="btn_new_post_image_del" onclick="delNewPostImage();"><i class="fa-solid fa-xmark"></i> Usuń zdjęcie</button>
				</div>
				<div class="col text-end">
					<span id="content_counter">0</span>/500
				</div>
			</div>
		</div>
	</div>
</form>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/unsavedChanges.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/replaceEmoticonsWithEmoji.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/js/editor.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/newCommentImage.js"></script>
<script src="<?php print(Flight::getConfig('url')); ?>/public/jsp/publicNewComment.js"></script>