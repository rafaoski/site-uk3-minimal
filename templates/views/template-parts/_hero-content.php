<?php namespace ProcessWire;

// if meta title && meta description
$ifPages = page('meta_title') || page('meta_description');

// if images
if ($img): ?>
	<div id="hero-image" class='hero-image <?php if($ifPages) echo 'uk-width-1-3@m'?>'>
		<?php if($img) echo "<img data-src='{$img->url}' alt='{$img_alt}' data-uk-img>"; ?>
	</div>
<?php endif;

// if meta title && meta description
if ($ifPages): ?>
	<div id="hero-text" class='hero-text uk-width-2-3@m'>
		<div class='uk-card uk-card-body uk-card-primary'>
			<?= page()->if("meta_title", "<h1>{meta_title}</h1>") ?>
			<?= page()->if("meta_description", "<h2 class='uk-text-lead uk-text-left'>{meta_description}</h2>") ?>
		</div>
	</div>
<?php endif; ?>
