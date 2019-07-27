<?php namespace ProcessWire; ?>

<!-- OFF CANVAS NAV -->
<a id='offcanvas-toggle' aria-label='Off Canvas Menu' class='uk-position-top-right uk-position-fixed uk-butoon'
	href="#off-overlay" data-uk-toggle><?= ukIcon('menu', ['ratio' => 2]) ?>
</a>

<div id="off-overlay" data-uk-offcanvas="overlay: true; flip: true;">

	<div class="uk-offcanvas-bar">

		<!-- SOCIAL PROFILES-->
		<div id="social-profiles" class='social-profiles uk-flex uk-flex-center uk-padding-small'>
			<?= socialProfiles(pages('options')->textarea) ?>
		</div>

		<button class="uk-offcanvas-close" type="button" data-uk-close></button>
		<h3 class='uk-h4'><a aria-label='Home' href='<?= setting('home')->url ?>'><?= pages('options')->site_name ?></a></h3>
			<?php
				// example of caching generated markup (for 600 seconds/10 minutes)
				echo cache()->get('offcanvas-nav', 10, function() {
				return ukNav(pages('/')->children(), [
					'depth' => 2,
					'accordion' => true,
					// 'blockParents' => [ 'blog' ],
					'repeatParent' => true,
					'noNavQty' => 20,
					'maxItems' => 16,
				]);
				});
			?>
	</div>

</div>