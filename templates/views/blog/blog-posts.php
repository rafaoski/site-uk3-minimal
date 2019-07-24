<?php namespace ProcessWire;

// get posts
$blogPosts = pages()->get("template=blog-posts")->children("limit=24");

// no items found
if( !count($blogPosts) ) {
  	files()->include('views/blog/parts/_no-found.php',['items' => $blogPosts]);
}
?>

<div id="hero">
	<?php include('parts/_blog-links.php') ?>
</div>

<div id="content-body">

	<?= ukPagination($blogPosts) ?>

	<!-- BLOG POSTS -->
	<div class='uk-flex uk-flex-wrap uk-flex-center uk-child-width-1-2@m' data-uk-grid>
		<?php
			foreach ($blogPosts as $item) {
				echo files()->render('views/blog/parts/_blog-article.php',
					[
						'item' => $item,
						'options' => [
							'disable_img' => true
						]
					]);
			}
		?>
	</div>

	<?= ukPagination($blogPosts) ?>

</div>
