<form method="post">
	<h2 class="bg-primary bg-gradient text-light p-3 rounded fw-normal mb-3">Krok 2: tworzenie konta administratora</h2>
	<div class="alert alert-success">Połączenie z bazą danych zostało nawiązane.</div>
	<?php if(count($err) > 0) { ?>
		<?php if(isset($err['fname'])) { ?>
			<div class="alert alert-warning">Podane imię jest niepoprawne.</div>
		<?php } ?>
		<?php if(isset($err['sname'])) { ?>
			<div class="alert alert-warning">Podane nazwisko jest niepoprawne.</div>
		<?php } ?>
		<?php if(isset($err['email'])) { ?>
			<div class="alert alert-warning">Podany adres email jest niepoprawny.</div>
		<?php } ?>
		<?php if(isset($err['pass_validate'])) { ?>
			<div class="alert alert-warning">Podane hasło nie spełnia wymogów bezpieczeństwa.</div>
		<?php } ?>
		<?php if(isset($err['repass'])) { ?>
			<div class="alert alert-warning">Podane hasła różnią się.</div>
		<?php } ?>
		<?php if(isset($err[''])) { ?>
			<div class="alert alert-warning">Podane dane dostępu do bazy danych są błędne.</div>
		<?php } ?>
		<?php if(isset($err[''])) { ?>
			<div class="alert alert-warning">Podane dane dostępu do bazy danych są błędne.</div>
		<?php } ?>
		<?php if(isset($err[''])) { ?>
			<div class="alert alert-warning">Podane dane dostępu do bazy danych są błędne.</div>
		<?php } ?>

	<?php } ?>

	<div class="form-floating mb-3">
	  <input type="email" class="form-control" name="email" id="email" placeholder="" value="<?php print(isset($data['email']) ? $data['email'] : ''); ?>" autocomplete="off" required>
	  <label for="email">Adres email</label>
	</div>
	
	<div class="input-group">
		<div class="form-floating mb-3">
		  <input type="text" class="form-control" name="fname" id="fname" placeholder="" value="<?php print(isset($data['fname']) ? $data['fname'] : ''); ?>" autocomplete="off" required>
		  <label for="fname">Imię</label>
		</div>
		<div class="form-floating mb-3">
		  <input type="text" class="form-control" name="sname" id="sname" placeholder="" value="<?php print(isset($data['sname']) ? $data['sname'] : ''); ?>" autocomplete="off" required>
		  <label for="sname">Nazwisko</label>
		</div>
	</div>

	<div class="form-floating mb-3">
	  <input type="password" value="" class="form-control" id="pass" placeholder="" maxlength="128" name="pass" pattern="^(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$" title="Hasło musi mieć minimum 8 znaków i zawierać co najmniej 1 znak specjalny (!@#$%^&*)." autocomplete="off" required>
	  <label for="pass">Hasło</label>
	</div>

	<div class="form-floating mb-3">
	  <input type="password" value="" class="form-control" id="repass" placeholder="" maxlength="128" name="repass" autocomplete="off" required>
	  <label for="repass">Powtórz hasło</label>
	</div>

	<div class="d-grid mb-3">
		<button type="submit" name="save_user" class="btn btn-lg btn-light text-center"><i class="fa-solid fa-user-plus"></i> Stwórz konto</button>
	</div>
</form>