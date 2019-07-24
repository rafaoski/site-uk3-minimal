<?php namespace ProcessWire;
$blogPage = pages()->get("template=blog");
?>
<head id='html-head' pw-append>
<script src='<?= urls('jquery') ?>' defer></script>
<script src='<?= urls()->FieldtypeComments ?>comments.min.js' defer></script>
<link rel="stylesheet" href="<?= urls()->FieldtypeComments ?>comments.css">
</head>

<div id="hero" data-pw-remove>
    <?php // include('parts/_blog-links.php') ?>
</div>

<p id='site-name'>
  <a href='<?= $blogPage->url ?>'>
    <?= $blogPage->title ?>
    <?= ukIcon('reply', ['ratio' => '2.5', 'class' => 'blog-post-icon']) ?>
  </a>
</p>

<div id='content-body' class='-uk-margin-top -uk-margin-bottom'>

  <!-- CONTENT BLOG -->
  <div class='content-blog' data-uk-grid>
    <!-- CONTENT ARTICLE -->
    <div class='content-article uk-width-3-4@m'>
    <?php
      // Blog article
      echo files()->render('views/blog/parts/_blog-article.php',
      [
        'item' => page(),
        // 'options' => [],
      ]);

      // Page Links
      echo files()->render('views/template-parts/_page-links.php');

      // IF Enable Comments
      if( setting('comments') ) {
          include('parts/_blog-comments.php');
      }
    ?>
    </div>
    <!-- /CONTENT ARTICLE -->

    <!-- SIDEBAR -->
    <div class='content-sidebar uk-width-1-4@m'>
      <?php include('parts/_blog-sidebar.php') ?>
    </div>
    <!-- /SIDEBAR -->
  </div>
  <!-- /CONTENT BLOG -->

  <!-- PREVIOUS NEXT POST MENU -->
  <div class="nav-page uk-flex uk-flex-wrap uk-flex-around uk-margin-medium-top uk-margin-small">
  	<?= prNx(page()) ?>
  </div>
  <!-- /PREVIOUS NEXT POST MENU -->

<?php // Universal Sharing Buttons ( https://www.addtoany.com/ )
echo toAny(
  [
    'twitter' => true,
    'facebook' => true,
    'google_plus' => false,
    'linkedin' => false,
    'rreddit' => false,
    'email' => true,
    'google_gmail' => false,
    'share_all' => false,
  ])
?>
</div>
