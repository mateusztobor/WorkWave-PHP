<h1 class="mb-4 h5 fw-normal">Informacje o WorkWave</h1>
<div class="row">
	<?php if(isset($enabledApps['core'])) { ?>
	<div class="col-md-6">
		<div class="card mb-3 border-dark">
			<div class="card-header text-center border-dark bg-dark bg-gradient text-white">
				<i class="fa-solid fa-microchip"></i> System
			</div>
			<ul class="list-group list-group-flush">
			<?php foreach($enabledApps['core'] as $app) { ?>
				<li class="list-group-item border-dark">
					<div>
						<span class="fw-bold"><?php echo $app['name']; ?></span>
						<span class="text-secondary"><?php echo $app['ver']; ?></span> 
						<?php if(!empty($app['site'])) { ?>
							<a href="<?php echo $app['site']; ?>"><i class="fa-solid fa-link"></i></a>
						<?php } ?>
					</div>
					<div><?php echo $app['desc']; ?></div>
				</li>
			<?php } ?>

			</ul>
		</div>
		<?php } ?>
	</div>
	
	<?php if(isset($enabledApps['app'])) { ?>
	<div class="col-md-6">
		<div class="card mb-3 border-dark">
			<div class="card-header text-center border-dark bg-dark bg-gradient text-white">
				<i class="fa-regular fa-window-restore"></i> Uruchomione moduły
			</div>
			<ul class="list-group list-group-flush">
			<?php foreach($enabledApps['app'] as $app) { ?>
				<li class="list-group-item border-dark">
					<div>
						<span class="fw-bold"><?php echo $app['name']; ?></span>
						<span class="text-secondary"><?php echo $app['ver']; ?></span> 
						<?php if(!empty($app['site'])) { ?>
							<a href="<?php echo $app['site']; ?>"><i class="fa-solid fa-link"></i></a>
						<?php } ?>
					</div>
					<small><?php echo $app['basename']; ?></small>
					<div><?php echo $app['desc']; ?></div>
				</li>
			<?php } ?>

			</ul>
		</div>
	</div>
	<?php } ?>
</div>
