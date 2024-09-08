<form method="post">
	<h2 class="bg-primary bg-gradient text-light p-3 rounded fw-normal mb-3">Krok 1: podaj dane dostępu do bazy danych MySQL</h2>
	<?php if(isset($db_connect)) { ?>
		<div class="alert alert-warning">Nie można było nawiązać połączenia z bazą danych.</div>
	<?php } ?>
	<div class="form-floating mb-3">
	  <input type="text" class="form-control" name="host" id="host" placeholder="mysql.serwer.pl" autocomplete="off" required>
	  <label for="host">Serwer MySQL</label>
	</div>

	<div class="form-floating mb-3">
	  <input type="number" class="form-control" name="port" id="port" value="3306" placeholder="3306" autocomplete="off" required>
	  <label for="port">Port</label>
	</div>

	<div class="form-floating mb-3">
	  <input type="text" class="form-control" name="user" id="user" placeholder="user" autocomplete="off" required>
	  <label for="user">Użytkownik</label>
	</div>

	<div class="form-floating mb-3">
	  <input type="password" class="form-control" name="pass" id="pass" placeholder="password" autocomplete="off" required>
	  <label for="pass">Hasło</label>
	</div>

	<div class="form-floating mb-3">
	  <input type="text" class="form-control" name="db" id="db" placeholder="mysql.serwer.pl" autocomplete="off" required>
	  <label for="db">Baza danych</label>
	</div>

	<div class="d-grid mb-3">
		<button type="submit" name="save_db" class="btn btn-lg btn-light text-center"><i class="fa-solid fa-database"></i> Połącz z bazą danych</button>
	</div>
</form>