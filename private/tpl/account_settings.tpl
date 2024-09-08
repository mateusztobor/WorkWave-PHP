<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-lg-5">
		<div class="px-md-5 mx-lg-5">
			<h1 class="fw-normal mb-4">Ustawienia konta</h1>
			<h3 class="fw-normal mb-4">Moje dane</h1>
			<form method="post">
				<div class="col mb-4">
					<label class="form-label">Imię</label>
					<input type="text" value="<?php print(Flight::user('first_name')); ?>" class="form-control bg-white" disabled>
				</div>
				<div class="col mb-4">
					<label for="n_pass" class="form-label">Nazwisko</label>
					<input type="text" value="<?php print(Flight::user('second_name')); ?>" class="form-control bg-white" disabled>
				</div>
				<div class="col mb-4">
					<label for="rn_pass" class="form-label">Adres email</label>
					<input type="text" value="<?php print(Flight::user('email')); ?>" class="form-control bg-white" disabled>
				</div>
			</form>
		
			<h3 class="fw-normal mb-3 mt-5">Zmiana hasła</h1>
			<form method="post">
				<?php print(Flight::msgs()); ?>
				<div class="col mb-4">
					<label for="c_pass" class="form-label">Aktualne hasło</label>
					<input type="password" value="" class="form-control" id="c_pass" placeholder="Wprowadź stare hasło" maxlength="128" name="c_pass" required>
				</div>
				<div class="col mb-4">
					<label for="n_pass" class="form-label">Nowe hasło</label>
					<input type="password" value="" class="form-control" id="n_pass" placeholder="Wprowadź nowe hasło" maxlength="128" name="n_pass" pattern="^(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$" title="Hasło musi mieć minimum 8 znaków i zawierać co najmniej 1 znak specjalny (!@#$%^&*)." required>
				</div>
				<div class="col mb-4">
					<label for="rn_pass" class="form-label">Powtórz nowe hasło</label>
					<input type="password" value="" class="form-control" id="rn_pass" placeholder="Wprowadź nowe hasło" maxlength="128" name="rn_pass" required>
				</div>
				<div class="mb-4">
					<button type="submit" name="chpass" class="btn btn-success"><i class="fa-solid fa-check"></i> Zaktualizuj hasło</button>
				</div>
			</form>
		</div>
	</div>
</div>