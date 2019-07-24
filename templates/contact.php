<?php namespace ProcessWire; ?>

<div id="hero" data-pw-remove></div>

<div id="content-body" class='contact-info uk-container-expand'>

	<div class="uk-flex uk-flex-center uk-flex-middle" data-uk-grid>

		<div class="uk-width-1-2@m">
			<div class="uk-card uk-card-body uk-card-small uk-card-default">
				<h1 class='uk-h2'><?= page('meta_title') ?></h1>
				<h2 class='uk-h4'><?= page('meta_description') ?></h2>
			</div>
		</div>

		<div class='uk-width-1-2@m'>
			<div class='uk-card uk-card-body uk-card-small uk-card-primary'>
				<?= page()->body ?>
			</div>
		</div>

	</div>

	<div class='uk-flex uk-flex-center uk-margin-top'>
		<?= page('google_map') ?>
	</div>

</div>
