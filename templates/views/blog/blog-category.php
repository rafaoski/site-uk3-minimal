<?php namespace ProcessWire;
// Get All Posts
$blogPosts = pages()->get("template=blog-posts")->children("categories=$page, limit=12");
// No Items Found
if( !count($blogPosts) ) {
  files()->include('views/blog/parts/_no-found.php');
}
?>

<div id="hero">
  <?php include('parts/_blog-links.php') ?>
</div>

<div id='content-body'>

<?= ukPagination($blogPosts) ?>

<!-- BLOG POSTS -->
<div class='uk-flex uk-flex-center uk-child-width-1-2@m' data-uk-grid>
    <?php // Blog Posts Loop
    foreach ($blogPosts as $item) {
              echo files()->render('views/blog/parts/_blog-article.php',
              [
                'item' => $item,
                // 'options' => [],
              ]);
        }
    ?>
</div>
<!-- /BLOG POSTS -->

<?= ukPagination($blogPosts) ?>

</div>
