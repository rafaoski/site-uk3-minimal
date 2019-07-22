<?php namespace ProcessWire;
// -- Get All Blog Entries
$blogPosts = pages()->get("template=blog-posts")->children("limit=12");
// No Items Found
if( !count($blogPosts) ) {
  files()->include('views/blog/parts/_no-found.php');
// ession()->redirect(pages()->get("template=blog")->httpUrl;
// throw new Wire404Exception();
}
// -- Pagination
$pagination = ukPagination($blogPosts);
?>

<div id="content-body">

<?= $pagination ?>

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

<?= $pagination ?>

</div>


<div id='footer' data-pw-append>
  <!-- SEO CONTENT -->
  <div class="uk-card uk-card-body uk-light">
    <h1 class='uk-h3'><?= page('meta_title') ?></h1>
    <h2 class='uk-h5'><?= page('meta_description') ?></h2>
  </div>
  <!-- /SEO CONTENT -->
</div>
