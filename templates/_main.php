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
<?= $cssFiles->each("<link rel='stylesheet' href='{value}'>\n") ?>
<?= $jsFiles->each("<script src='{value}' defer></script>\n") ?>
<?= seoPagination() ?>
<?php // echo hreflang(page()) ?>
</head>

<body id='html-body' class='html-body <?= setting('body-classes')->implode(' ') ?>'<?= $style ?>>

<!-- TOP PANEL-->
<div id='top-panel' class='top-panel uk-container'>
  <div class="uk-flex uk-flex-center uk-flex-wrap uk-margin-medium-top">
    <div id="social-profiles" class='social-profiles'>
        <?= socialProfiles(pages('options')->textarea) ?>
    </div>

    <div id="privacy-policy" class='privacy-policy uk-padding-small'>
        <?= privacyPolicy(pages()->get("template=privacy-policy")) ?>
    </div>

      <?php // -- LANGUAGE MENU
      // echo files()->render('views/template-parts/_language-menu.php') ?>
  </div>
</div>
<!-- /TOP PANEL-->

<!-- SITE INFO -->
<div id='site-info' class="site-info uk-flex uk-flex-center uk-flex-wrap uk-flex-middle">
  <div id="logo" class='logo' data-pw-optional>
      <?= siteLogo() ?>
  </div>

  <div id='site-name' class="site-name uk-padding-small">
      <p id='site-name-text' class='site-name-text uk-text-uppercase uk-margin-remove uk-heading-small'>
        <?php if (page('template')->name == 'home'): ?>
          <?= pages('options')->site_name ?>
          <?php else: ?>
          / <?= page('title') ?>
        <?php endif; ?>
      </p>
  </div>
</div>
<!-- /SITE INFO -->

<!-- BREADCRUMB -->
<div id='bredcrumb' class='breadcrumb uk-container' data-pw-optional>
  <div class='uk-float-right'>
    <?php if(page()->parent->id > setting('home')->id) echo ukBreadcrumb(page(),
          [
            'class' => 'uk-visible@m',
            'appendCurrent' => true
          ]);
    ?>
  </div>
</div>
<!-- /BREADCRUMB -->

<!-- NAVIGATION  -->
<nav id='nav' class="nav uk-container uk-overflow-auto uk-margin-small-top">
  <?= files()->render('views/template-parts/_navigation.php') ?>
</nav>
<!-- /NAVIGATION  -->

<!-- HERO -->
<div id='hero' class='hero uk-container uk-container-expand uk-margin-medium-top uk-margin-medium-bottom'>
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

<footer id='footer' class="footer uk-section uk-section-small uk-margin-large-top">
  <div id="to-top" class='to-top uk-float-right uk-padding'>
    <a title='to-top' class='uk-text-danger' href="#" data-uk-totop data-uk-scroll></a>
  </div>

  <div id="search-form" class='search-form uk-container uk-margin-small-bottom uk-width-1-2@m'>
      <?= files()->render('views/template-parts/_search-form.php') ?>
  </div>

<p id='copy-text' class="copy-text uk-text-small uk-text-center uk-text-muted uk-padding-small">
    <?php echo files()->render('views/template-parts/_footer-demo-copyright.php') ?>
    <?php // echo files()->render('views/template-parts/_footer-copyright.php') ?>
  </p>
</footer>

<?php // -- Off Canvas Nav
echo files()->render('views/template-parts/_offcanvas-nav.php') ?>

<?php
// echo googleFonts( ['fonts' => ['Nunito:200,600','Butcherman']] ); // Google Fonts
// echo gwCode( setting('gw-code') ); // Google Webmaster
// echo gaCode( setting('ga-code') ); // Google Analytics
?>

</body>
</html>
