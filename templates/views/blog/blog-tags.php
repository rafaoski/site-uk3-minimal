<?php namespace ProcessWire;

$tags = page()->children("limit=40");

// no items found
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
		<?php if (count($tag->references())): ?>
			<div>
				<a class='uk-button uk-button uk-button-text' href='<?=$tag->url?>'>
					<?=$tag->title?>
					<span class='count-category uk-badge'><?= count($tag->references()) ?></span>
				</a>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>

<?= ukPagination($tags) ?>

</div>
