<?php namespace ProcessWire;
 $categories = page()->children("limit=18");
 // No Items Found
if( !count($categories) ) {
  files()->include('views/blog/parts/_no-found.php');
}
?>

<div id="hero">
  <?php include('parts/_blog-links.php') ?>
</div>

<div id='content-body'>

<?= ukPagination($categories) ?>

<!-- BLOG POSTS -->
<div class='uk-flex uk-flex-wrap uk-flex-around' data-uk-grid>
<?php foreach($categories as $category): ?>
  <a href='<?=$category->url?>'>
    <div class='uk-card uk-card-default uk-card-hover uk-card-body'>
          <h3><?=$category->title?>
            <span style='border-top: 3px solid black;
                  border-left: 3px solid black; border-radius: 50%; padding: 5px 15px;'
                  class='count-category'><?=count($category->references())?>
            </span>
          </h3>
    </div>
  </a>
<?php endforeach; ?>
</div>
<!-- /BLOG POSTS -->

<?= ukPagination($categories) ?>

</div>
