<?php namespace ProcessWire;
$tags = page()->children("limit=40");
// No Items Found
if( !count($tags) ) {
  files()->include('views/blog/parts/_no-found.php');
}
?>

<div id="hero">
  <?php include('parts/_blog-links.php') ?>
</div>

<div id='content-body'>

<?= ukPagination($tags) ?>

<!-- BLOG POSTS -->
<div class='uk-flex uk-flex-wrap uk-flex-around' data-uk-grid>
  <?php foreach($tags as $tag): ?>
    <div>
          <a href='<?=$tag->url?>' class='uk-inline'>
          <h3><?=$tag->title?>
            <span style='border-top: 3px solid black;
                  border-left: 3px solid black; border-radius: 50%; padding: 5px 15px;'
                  class='count-category'><?=count($tag->references())?>
            </span>
          </h3>
        </a>
    </div>
  <?php endforeach; ?>
</div>
<!-- /BLOG POSTS -->

<?= ukPagination($tags) ?>

</div>
