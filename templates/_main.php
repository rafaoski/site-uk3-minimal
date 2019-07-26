<?php namespace ProcessWire;
/**
 * _main.php template file, called after a page’s template file
 *
 */

// Reset Variables
$img = $img_alt = $style = '';

// Get CSS Files
$cssFiles = setting('css-files');

// Get JS Files
$jsFiles = setting('js-files');

// Disable Turbolinks if the user is logged in
if (user()->isLoggedin()) {
	unset($jsFiles[0]); // Unset Turbolinks Script
}

// Get First Image
if(page()->images && count(page()->images)) {
  $img = page()->images->first;
  $img_alt = $img->description ?: page()->title;
}

// setting(false, 'background-image'); // Disable background image
if ( setting('background-image') && $img ) { // set Background Image
  $style = " style='background-image: linear-gradient( rgba(255, 255, 255, 0.92), rgba(216, 216, 216, 0.88) ), url($img->url);'";
}
?>
<!DOCTYPE html>
<html lang="<?= setting('lang-code') ?>">
<head id='html-head'>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if (setting('favicon')): ?>
<link rel="icon" href="<?= setting('favicon') ?>"/>
<?php endif; ?>
<title id='title'><?= page('meta_title|title') ?></title>
<?php if (page('meta_description')): ?>
<meta name="description" id='description' content="<?= page('meta_description') ?>"/>
<?php endif; ?>
<?= $cssFiles->each("<link rel='stylesheet' href='{value}'>\n") ?>
<?= $jsFiles->each("<script src='{value}' defer></script>\n") ?>
<?= seoPagination() ?>
<?= hreflang(page()) ?>
</head>

<body id='html-body' class='html-body <?= setting('body-classes')->implode(' ') ?>'<?= $style ?>>

<!-- HEADER -->
<header id='header' class='header uk-panel'>

	<!-- PRIVACY POLICY-->
	<?= privacyPolicy(['class' => 'privacy-policy uk-padding-small uk-flex uk-flex-wrap uk-flex-left']) ?>

	<?= files()->render('views/template-parts/_language-menu.php') // Language menu ?>

	<!-- LOGO-->
	<?= siteLogo(['class' => 'logo uk-flex uk-flex-center']) ?>

	<!-- SITE NAME -->
	<?= siteName(['class' => 'site-name uk-text-uppercase uk-heading-small uk-margin-remove uk-text-center']) ?>

	<!-- BREADCRUMB -->
	<?php if(page()->parent->id > setting('home')->id) echo ukBreadcrumb(page(),
		[
			'class' => 'uk-float-right uk-padding-small uk-visible@m',
			'appendCurrent' => true
		]);
	?>

	<!-- NAVIGATION  -->
	<?= files()->render('views/template-parts/_navigation.php', ['id' => 'nav' , 'class' => 'nav uk-container']) ?>

</header>

<!-- HERO -->
<div id="hero" class='hero uk-flex uk-flex-center uk-flex-middle uk-text-center uk-padding-small' data-uk-grid>

	<?php
		echo files()->render('views/template-parts/_hero-content.php',
		[
			'img' => $img,
			'img_alt' => $img_alt
		])
	?>

</div>

<!-- CONTENT -->
<div id="content-body" class='content-body uk-container uk-container-medium uk-margin-top uk-margin-bottom'>
	<?= page()->body ?>
</div>

<?= editPage() ?>
<?= debugInfo() ?>

<!-- FOOTER -->
<footer id='footer' class="footer uk-section uk-section-small uk-margin-large-top">

	<a id="to-top" title='to-top' class='to-top uk-float-right uk-padding uk-text-danger' href="#" data-uk-totop data-uk-scroll></a>

	<div id="search-form" class='search-form uk-container uk-margin-small-bottom uk-width-1-2@m'>
		<?= files()->render('views/template-parts/_search-form.php') ?>
	</div>

	<p id='copy-text' class="copy-text uk-text-small uk-text-center uk-text-muted uk-padding-small">
		<?php echo files()->render('views/template-parts/_footer-demo-copyright.php') ?>
		<?php // echo files()->render('views/template-parts/_footer-copyright.php') ?>
	</p>

</footer>

<!-- OFF CANVAS NAV -->
<a id='offcanvas-toggle' aria-label='Off Canvas Menu' class='uk-position-top-right uk-position-fixed uk-butoon uk-button-secondary'
   href="#off-overlay" data-uk-toggle><?= ukIcon('menu', 1.7) ?>
</a>

<div id="off-overlay" data-uk-offcanvas="overlay: true; flip: true;">
	<?php
		echo files()->render('views/template-parts/_offcanvas-nav.php',
		[
			'socialProfiles' => socialProfiles(pages('options')->textarea)
		]);
	?>
</div>

<?php
// echo googleFonts( ['fonts' => ['Nunito:200,600','Butcherman']] ); // Google Fonts
// echo gwCode( setting('gw-code') ); // Google Webmaster
// echo gaCode( setting('ga-code') ); // Google Analytics
?>

</body>
</html>
