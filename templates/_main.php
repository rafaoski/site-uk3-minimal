<?php namespace ProcessWire;
/**
 * _main.php template file, called after a page’s template file
 *
 */

// reset variables
$img = $img_alt = '';

// Get First Image
if(page()->images && count(page()->images)) {
	$img = page()->images->first;
	$img_alt = $img->description ?: page()->title;
}
?>
<!DOCTYPE html>
<html lang="<?= setting('lang-code') ?>">
<head id='html-head'>
<?php // site head
	echo siteHead();
?>
</head>
<body id='html-body' class='html-body <?= setting('body-classes')->implode(' ') ?>'<?= backgroundImage(['img' => $img]) ?>>

	<!-- HEADER -->
	<header id='header' class='header uk-panel'>

		<!-- PRIVACY POLICY-->
		<?= privacyPolicy(['class' => 'privacy-policy uk-padding-small uk-flex uk-flex-wrap uk-flex-left']) ?>

		<?= files()->render('views/template-parts/_language-menu.php') // Language menu ?>

		<!-- LOGO-->
		<?= siteLogo(['class' => 'logo uk-flex uk-flex-center']) ?>

		<!-- SITE NAME -->
		<p id='site-name' class='site-name uk-text-uppercase uk-heading-small uk-margin-remove uk-text-center'>
			<?= siteName() ?>
		</p>

		<!-- BREADCRUMB -->
		<div id='breadcrumb'>
			<?php if(page()->parent->id > setting('home')->id) echo ukBreadcrumb(page(),
				[
					'appendCurrent' => true
				]);
			?>
		</div>

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

	<?= files()->render('views/template-parts/_offcanvas-nav.php') ?>

<?php
// echo googleFonts( ['fonts' => ['Nunito:200,600','Butcherman']] ); // Google Fonts
// echo gwCode( setting('gw-code') ); // Google Webmaster
// echo gaCode( setting('ga-code') ); // Google Analytics
?>
</body>
</html>
