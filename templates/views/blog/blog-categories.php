<?php namespace ProcessWire;

$categories = page()->children("limit=18");

//	no items found
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
		<?php if (count($category->references())): ?>
			<a class='uk-link-reset' href='<?=$category->url?>'>
				<div class='uk-card uk-card-default uk-card-hover uk-card-body'>
				<h3 class="uk-card-title"><?=$category->title?>
				<span class='count-category uk-badge'><?= count($category->references()) ?></span></h3>
				</div>
			</a>
		<?php endif; ?>
	<?php endforeach; ?>
</div>

<?= ukPagination($categories) ?>

</div>
