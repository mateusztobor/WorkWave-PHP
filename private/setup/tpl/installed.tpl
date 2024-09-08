<h2 class="bg-primary bg-gradient text-light p-3 rounded fw-normal mb-3">Krok 3: instalacja systemu</h2>
<?php if(count($err) == 0) { ?>
	<div class="alert alert-success">Instalacja systemu powiodła się.</div>
	<div class="alert alert-light">Za chwilę zostaniesz przekierowany do systemu WorkWave.</div>
	<div class="spinner-border text-primary fs-1" role="status">
	  <span class="visually-hidden">Wczytywanie...</span>
	</div>
<?php } else { ?>
	<div class="alert alert-danger">Instalacja systemu nie powiodła się.</div>
	<?php if(isset($err['nodbfile'])) { ?>
		<div class="alert alert-warning">Nie znaleziono pliku bazy danych.</div>
	<?php } ?>
<?php } ?>