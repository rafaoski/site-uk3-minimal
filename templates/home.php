<?php namespace ProcessWire;
$blog = pages()->get("template=blog-posts");
$blogPost = $blog->child();
?>

<div id="content-body" data-pw-append>
  <h3 class='uk-heading-small uk-text-center uk-margin-large-top'>
		<?=setting('in-blog')?>
	</h3>
	<?= ukBlogPost($blogPost) ?>
	<p class='uk-text-center'>
		<a class='uk-button uk-button-text uk-text-large' href='<?=$blog->parent->url?>'>
			<?=ukIcon('arrow-right')?>
			<?=setting('recent-posts')?>
		</a>
	</p>
</div>
