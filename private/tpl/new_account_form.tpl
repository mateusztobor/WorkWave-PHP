<div class="px-lg-5 mx-lg-5">
	<div class="px-lg-5 mx-xl-5">
		<div class="px-xl-5 mx-lg-5">
			<h1 class="fw-normal h3 mb-3">Kreator tworzenia nowego konta</h1>
			<?php if($alert==3) { ?>
				<div class="mb-3 alert alert-warning">Podany adres email jest już w użyciu.</div>
			<?php } elseif($alert==2) { ?>
			<div class="mb-3 alert alert-warning">Wystąpił nieoczekiwany błąd. Konto nie zostało utworzone.</div>
			<?php } elseif($alert==1) { ?>
				<div class="mb-3 alert alert-success">Konto zostało utworzone pomyślnie.</div>
			<?php } ?>
			<form method="post">
				<div class="mb-3">
					<input type="email" class="form-control" placeholder="Adres email" maxlength="255" name="email" value="<?php print($alert!=1 ? @$_POST['email'] : ''); ?>" required>
				</div>
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Imię" name="fname" maxlength="64" value="<?php print($alert!=1 ? @$_POST['fname'] : ''); ?>" required>
					<input type="text" class="form-control" placeholder="Nazwisko" name="sname" maxlength="64" value="<?php print($alert!=1 ? @$_POST['sname'] : ''); ?>" required>
				</div>
				<div class="alert alert-light mb-3">
					Hasło do konta zostanie wysłane w wiadomości email.
				</div>
				<div class="d-grid">
					<button class="btn btn-light" type="submit" name="createAccount"><i class="fa-solid fa-user-plus"></i> Stwórz konto</button>
				</div>
			</form>
		</div>
	</div>
</div>