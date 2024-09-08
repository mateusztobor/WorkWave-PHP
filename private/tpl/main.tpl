<!doctype html>
<html lang="pl" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>WorkWave</title>
		<link rel="icon" type="image/png" href="<?php print(Flight::getConfig('url')); ?>/public/img/logo-32.png">
		<link href="<?php print(Flight::getConfig('url')); ?>/public/libs/bootstrap/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
		<link href="<?php print(Flight::getConfig('url')); ?>/public/css/theme.css" rel="stylesheet">
		<meta name="robots" content="none">
		<meta name="AdsBot-Google" content="none">	
		<?php if(isset($need_editor)) { ?>
			<?php if($need_editor) { ?>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css" integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/colors/ui/trumbowyg.colors.min.css" integrity="sha512-vw0LMar38zTSJghtmUo0uw000TBbzhsxLZkOgXZG+U4GYEQn+c+FmVf7glhSZUQydrim3pI+/m7sTxAsKhObFA==" crossorigin="anonymous" referrerpolicy="no-referrer">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/table/ui/trumbowyg.table.min.css" integrity="sha512-qIa+aUEbRGus5acWBO86jFYxOf4l/mfgb30hNmq+bS6rAqQhTRL5NSOmANU/z5RXc3NJ0aCBknZi6YqD0dqoNw==" crossorigin="anonymous" referrerpolicy="no-referrer">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/emoji/ui/trumbowyg.emoji.min.css" integrity="sha512-2RIZab3prIyPesUHpOb8YBlL441Q/sDqNK4v+3+LEjJyEg52kXRD/GGMuW+OXG5hCSBe9gTYNal51fdoQ0WiPA==" crossorigin="anonymous" referrerpolicy="no-referrer">
			<?php } ?>
		<?php } ?>
		<!-- preloader -->
		<link href="<?php print(Flight::getConfig('url')); ?>/public/css/preloader.min.css" rel="preload" as="style" onload="this.rel='stylesheet'">
		<noscript><link href="<?php print(Flight::getConfig('url')); ?>/public/css/preloader.min.css" rel="stylesheet"></noscript>
		<?php print(Flight::has('add2Head') ? Flight::get('add2Head') : ''); ?>
	</head>

	<body class="d-flex flex-column h-100">
		<div id="preloader"><div><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div></div>
		<script src="<?php print(Flight::getConfig('url')); ?>/public/js/preloader.min.js"></script>
		<header>
			<nav id="mainNav" class="navbar bg-light navbar-expand-xl fixed-top" style="z-index:9999;">
				<div class="container">
					<a class="navbar-brand d-flex align-items-center" href="<?php print(Flight::getConfig('url')); ?>/">
						<img src="<?php print(Flight::getConfig('url')); ?>/public/img/logo-32.png" class="me-1" alt=""><span class="d-none d-lg-inline ms-1">WorkWave</span>
					</a>
					<div class="collapse navbar-collapse mt-3 mt-lg-0">
						<?php if(Flight::isAuthorized('logged')) { ?>
							<ul class="navbar-nav me-auto mb-2 mb-md-0 text-center">
								<li class="nav-item">
									<a class="nav-link<?php Flight::checkCurrentApp('/wpisy',' active'); ?>" aria-current="page" href="<?php print(Flight::getConfig('url')); ?>/"><i class="fa-solid fa-water"></i> Wpisy</a>
								</li>
								<li class="nav-item">
									<a class="nav-link<?php Flight::checkCurrentApp('/obserwowane',' active'); ?>" aria-current="page" href="<?php print(Flight::getConfig('url')); ?>/obserwowane"><i class="fa-regular fa-eye"></i> Obserwowane</a>
								</li>
								<li class="nav-item">
									<a class="nav-link<?php Flight::checkCurrentApp('/grupy',' active'); ?>" aria-current="page" href="<?php print(Flight::getConfig('url')); ?>/grupy"><i class="fa-solid fa-people-group"></i> Grupy</a>
								</li>
								<li class="nav-item">
									<a class="nav-link<?php Flight::checkCurrentApp('/moje-szkolenia',' active'); ?>" aria-current="page" href="<?php print(Flight::getConfig('url')); ?>/moje-szkolenia"><i class="fa-solid fa-brain"></i> Szkolenia</a>
								</li>
								<li class="nav-item">
									<a class="nav-link<?php Flight::checkCurrentApp('/wiadomosci',' active'); ?>" aria-current="page" href="<?php print(Flight::getConfig('url')); ?>/wiadomosci">
										<i class="fa-<?php print(Flight::unreadMessages() ? 'solid text-danger' : 'regular'); ?> fa-message"></i> Wiadomości
									</a>

								</li>
							</ul>

						<?php } ?>
					</div>
					<?php if(Flight::isAuthorized('logged')) { ?>
						<div class="d-inline-block d-flex align-items-center">
							<?php if(Flight::isAuthorized('m') || Flight::isAuthorized('r') || Flight::isAuthorized('t')) { ?>
								<div class="btn-group dropstart">
									<button class="btn btn-lg rounded nav-item m-0 p-2 text-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
										<i class="fa-solid fa-gear"></i>
									</button>
									<ul class="dropdown-menu">

										<?php if(Flight::isAuthorized('m')) { ?>
											<li><a class="dropdown-item<?php Flight::checkCurrentApp('/szkolenia',' active'); ?>" href="<?php print(Flight::getConfig('url')); ?>/szkolenia"><i class="fa-solid fa-book-open"></i> Zarządzanie szkoleniami</a></li>
										<?php } ?>

										<?php if(Flight::isAuthorized('m')) { ?>
											<li><a class="dropdown-item<?php Flight::checkCurrentApp('/moderator',' active'); ?>" href="<?php print(Flight::getConfig('url')); ?>/moderator"><i class="fa-solid fa-user-secret"></i> Tablica moderatora</a></li>
										<?php } ?>


										<?php if(Flight::isAuthorized('r') || Flight::isAuthorized('a')) { ?>
											<li><a class="dropdown-item<?php Flight::checkCurrentApp('/tworzenie-konta',' active'); ?>" href="<?php print(Flight::getConfig('url')); ?>/tworzenie-konta"><i class="fa-solid fa-user-plus"></i> Kreator tworzenia konta</a></li>
										<?php } ?>
										
										<?php if(Flight::isAuthorized('a')) { ?>
											<li><a class="dropdown-item<?php Flight::checkCurrentApp('/uprawnienia',' active'); ?>" href="<?php print(Flight::getConfig('url')); ?>/uprawnienia"><i class="fa-solid fa-users-rectangle"></i> Zarządzanie uprawnieniami</a></li>
											<li><a class="dropdown-item<?php Flight::checkCurrentApp('/informacje',' active'); ?>" href="<?php print(Flight::getConfig('url')); ?>/informacje"><i class="fa-solid fa-circle-info"></i> Informacje o systemie</a></li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
							<a href="<?php print(Flight::getConfig('url')); ?>/wyszukiwanie" class="btn btn-lg me-2">
								<i class="fa-solid fa-magnifying-glass"></i>
							</a>
							
							
							<div class="btn-group dropstart">
								<button class="btn rounded-circle m-0" type="button" style="width:48px;height:48px;background-image: url(<?php print(Flight::getConfig('url')); ?>/uploads/avatars/<?php print(Flight::user('id')); ?>); background-size: 100% 100%;" data-bs-toggle="dropdown" aria-expanded="false"></button>
								
								<ul class="dropdown-menu">
									<li><a class="dropdown-item<?php Flight::checkCurrentApp('/moj-profil',' active'); ?>" href="<?php print(Flight::getConfig('url')); ?>/uzytkownik-<?php print(Flight::user('id')); ?>"><i class="fa-solid fa-id-card"></i> Mój profil</a></li>
									<li><a class="dropdown-item<?php Flight::checkCurrentApp('/ustawienia-konta',' active'); ?>" href="<?php print(Flight::getConfig('url')); ?>/ustawienia-konta"><i class="fa-solid fa-gear"></i> Ustawienia konta</a></li>
									<li><a class="dropdown-item" href="<?php print(Flight::getConfig('url')); ?>/wyloguj"><i class="fa-solid fa-arrow-right-from-bracket"></i> Wyloguj</a></li>
								</ul>
								
							</div>
						</div>
					<?php } ?>
				</div>
			</nav>
		</header>
		<script src="<?php print(Flight::getConfig('url')); ?>/public/libs/bootstrap/bootstrap.bundle.min.js"></script>
		<script src="<?php print(Flight::getConfig('url')); ?>/public/js/tooltips.js"></script>
		<main class="flex-shrink-0">
			<div class="container mt-3 mt-md-5">
				<?php
					if(isset($content)) print($content);
					if(isset($tpl)) Flight::render($tpl);
				?>
			</div>
		</main>
		<?php if(Flight::isAuthorized('logged')) { ?>
			<div class="fixed-bottom d-block d-xl-none bg-body-secondary py-1" style="z-index:9999;">
				<div class="row d-flex justify-content-between mx-3 text-dark">
					<a href="<?php print(Flight::getConfig('url')); ?>/" class="col py-3 mx-1 text-center<?php Flight::checkCurrentApp('/wpisy',' bg-primary bg-gradient text-white rounded'); ?>"><i class="fa-solid fa-water"></i></a>
					<a href="<?php print(Flight::getConfig('url')); ?>/obserwowane" class="col py-3 mx-1 text-center<?php Flight::checkCurrentApp('/obserwowane',' bg-primary bg-gradient text-white rounded'); ?>"><i class="fa-regular fa-eye"></i></a>
					<a href="<?php print(Flight::getConfig('url')); ?>/grupy" class="col py-3 mx-1 text-center<?php Flight::checkCurrentApp('/grupy',' bg-primary bg-gradient text-white rounded'); ?>"><i class="fa-solid fa-people-group"></i></a>
					<a href="<?php print(Flight::getConfig('url')); ?>/moje-szkolenia" class="col py-3 mx-1 text-center<?php Flight::checkCurrentApp('/moje-szkolenia',' bg-primary bg-gradient text-white rounded'); ?>"><i class="fa-solid fa-brain"></i></a>
					<a
						href="<?php print(Flight::getConfig('url')); ?>/wiadomosci"
						class="position-relative col py-3 mx-1 text-center<?php Flight::checkCurrentApp('/wiadomosci',' bg-primary bg-gradient text-white rounded'); ?>">
							<i class="fa-regular fa-message"></i>
							<?php if(Flight::unreadMessages()) { ?>
								<span class="position-absolute top-0 start-50 translate-middle badge rounded-pill shadow bg-danger bg-gradient text-light">
									&nbsp;
									<span class="visually-hidden">nieprzeczytane wiadomości</span>
								</span>
							<?php } ?>
					</a>
					

				</div>
			</div>
		<?php } ?>
		<div class="pt-5 pb-4 py-xl-0"></div>
		<script src="<?php print(Flight::getConfig('url')); ?>/public/js/form-validation.js"></script>
	</body>
</html>
