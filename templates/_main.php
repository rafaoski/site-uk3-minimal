<?php namespace ProcessWire;
/**
 * _main.php template file, called after a page’s template file
 *
 */

// -- Reset Variables
$img = $img_alt = $style = '';
// -- Get CSS Files
$cssFiles = setting('css-files');
// -- Get JS Files
$jsFiles = setting('js-files');
// -- Disable Turbolinks if the user is logged in
if (user()->isLoggedin()) {
    unset($jsFiles[0]); // Unset Turbolinks Script
}
// -- Get First Image
if(page()->images && count(page()->images)) {
  $img = page()->images->first;
  $img_alt = $img->description ?: page()->title;
}
// -- Disable " setting " background-image ( more info inside file '_init.php' )
// setting(false, 'background-image');
// -- Set Background Image
if ( setting('background-image') && $img ) {
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
<?php // echo $cssFiles->each("<link rel='stylesheet' href='{value}'>\n") ?>
<?= deferCss() ?>
<?= $jsFiles->each("<script src='{value}' defer></script>\n") ?>
<?= seoPagination() ?>
<?php // echo hreflang(page()) ?>
</head>

<body id='html-body' class='html-body <?= setting('body-classes')->implode(' ') ?>'<?= $style ?>>

<!-- HEADER -->
<header id='header' class='header uk-panel'>

  <?php // echo files()->render('views/template-parts/_language-menu.php') // Language menu ?>

  <!-- SOCIAL PROFILES-->
  <div id="social-profiles" class='social-profiles uk-flex uk-flex-center uk-padding-small'>
      <?= socialProfiles(pages('options')->textarea) ?>
  </div>
  <!-- /SOCIAL PROFILES -->

  <!-- PRIVACY POLICY-->
  <div id="privacy-policy" class='privacy-policy uk-padding-small uk-padding-remove-bottom uk-flex uk-flex-center'>
      <?= privacyPolicy(pages()->get("template=privacy-policy")) ?>
  </div>
  <!-- /PRIVACY POLICY-->

  <!-- LOGO-->
  <div id='logo' class='logo' data-pw-optional>
      <?= siteLogo() ?>
  </div>
  <!-- /LOGO -->

  <!-- SITE INFO -->
  <div id='site-info' class='site-info uk-text-center'>
    <p id='site-name' class='site-name uk-text-uppercase uk-heading-small uk-margin-remove'>
      <?= siteName() ?>
    </p>
  </div>
  <!-- /SITE INFO -->

  <!-- BREADCRUMB -->
  <div id="breadcrumb" class='uk-float-right uk-padding-small'>
    <?php if(page()->parent->id > setting('home')->id) echo ukBreadcrumb(page(),
        [
          'class' => 'uk-visible@m',
          'appendCurrent' => true
        ]);
    ?>
  </div>
  <!-- /BREADCRUMB -->

  <!-- NAVIGATION  -->
  <nav id='nav' class="nav uk-container">
    <?= files()->render('views/template-parts/_navigation.php') ?>
  </nav>
  <!-- /NAVIGATION  -->

</header>
<!-- /HEADER -->

<!-- HERO -->
<div id="hero" class='hero uk-flex uk-flex-center uk-flex-middle uk-text-center uk-padding-small' data-uk-grid>
  <?php // -- Render Hero
    echo files()->render('views/template-parts/_hero-content.php',
        [
          'img' => $img,
          'img_alt' => $img_alt
        ])
  ?>
</div>
<!-- /HERO -->

<!-- CONTENT -->
<div id="content-body" class='content-body uk-container uk-container-medium uk-margin-top uk-margin-bottom'>
    <?= page()->body ?>
</div>
<!-- /CONTENT -->

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
<!-- /FOOTER -->

<!-- OFF CANVAS NAV -->
<a id='offcanvas-toggle' aria-label='Off Canvas Menu' class='uk-position-top-right uk-position-fixed uk-butoon uk-button-secondary'
    href="#off-overlay" data-uk-toggle>
  <?= ukIcon('menu', 1.7) ?>
</a>

<div id="off-overlay" data-uk-offcanvas="overlay: true; flip: true;">
  <?= files()->render('views/template-parts/_offcanvas-nav.php') ?>
</div>
<!-- /OFF CANVAS NAV -->

<?php
// echo googleFonts( ['fonts' => ['Nunito:200,600','Butcherman']] ); // Google Fonts
// echo gwCode( setting('gw-code') ); // Google Webmaster
// echo gaCode( setting('ga-code') ); // Google Analytics
?>

</body>
</html>
