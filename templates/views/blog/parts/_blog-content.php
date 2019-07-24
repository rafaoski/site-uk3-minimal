<?php namespace ProcessWire;

// get all blog entries
$blogPosts = pages()->get("template=blog-posts")->children("limit=12");

// no found
if( !count($blogPosts) ) {
	files()->include('views/blog/parts/_no-found.php');
}

// pagination
$pagination = ukPagination($blogPosts);
?>

<div id="content-body">

	<?= $pagination ?>

	<!-- BLOG POSTS -->
	<div class='uk-flex uk-flex-center uk-child-width-1-2@m' data-uk-grid>
		<?php
			foreach ($blogPosts as $item) {
				echo files()->render('views/blog/parts/_blog-article.php',
					[
						'item' => $item,
						// 'options' => [],
					]);
			}
		?>
	</div>

	<?= $pagination ?>

</div>

<div id='footer' data-pw-append>
	<!-- SEO CONTENT -->
	<div class="uk-card uk-card-body uk-light">
		<h1 class='uk-h3'><?= page('meta_title') ?></h1>
		<h2 class='uk-h5'><?= page('meta_description') ?></h2>
	</div>
</div>
