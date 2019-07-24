<?php namespace ProcessWire;

// if isset Options from render or included files
isset($options) ? '' : $options = array();

// default options to merge
$defaults = [
	'disable_img' => false,
	'img_width' => count($item->images) ? $item->images->first->width : '',
	'img_height' => count($item->images) ? $item->images->first->height : '',
	// you should change the authors url slug in the _init.php file ( 'authors' => __('Authors') ) if the page has a different slug than the authors
	'authors_url_slug' => sanitizer()->pageName(setting('authors')),
	// user Nick Name
	'nick_name' => $item->createdUser->nick_name,
	// user slug to page
	'nick_pagename' => sanitizer()->pageName($item->createdUser->nick_pagename, true),
	// unformatted date from fields ( date )
	'date' => wireDate('Y/m/d', $item->getUnformatted("date")),
	'date_archives_url' => pages()->get("template=blog")->url .
			sanitizer()->pageName(setting('archives')) . '/' . wireDate('Y/m/', $item->getUnformatted("date")),
];

// Merge Options
$options = array_merge($defaults, $options);
?>

<article class='blog-article <?= 'article_' . $item->id ?>'>
	<header>
		<?php
		// if is blog post
		if ($item->id == page('id')): ?>
		<h1 class='blog-title uk-text-uppercase uk-h3'>
			/ <?= $item->title ?>
		</h1>
		<?php else: ?>
		<h3 class='blog-title uk-button uk-button-text'>
			<a title="<?= $item->title ?>" class="uk-link-reset" href="<?= $item->url ?>">
				/ <?= $item->title ?>
			</a>
		</h3>
		<?php endif; ?>

		<p class="uk-article-meta">

			<a class='uk-button uk-button-text' href="<?= $options['date_archives_url'] ?>">
				<span data-uk-icon="icon: calendar"></span>
				<?= $options['date'] ?>
			</a>

			<!-- <span data-uk-icon="icon: future"></span> Takes 7 min reading. -->

			<?php if($options['nick_pagename']): ?> |
			<a class='uk-button uk-button-text' href="<?= pages()->get("template=blog")->url . "$options[authors_url_slug]/" . $options['nick_pagename']; ?>/">
				<span data-uk-icon="icon: user"></span> <?= $options['nick_name'] ?>
			</a>
			<?php endif; ?>

			<?php // num comments
				if ( count($item('comments')) && setting('comments') ):
					$comments_count = $item->get('comments')->count();
			?> |
			<a href='<?=$item->url ?>#comments'>
				<span data-uk-icon="icon: comments"></span> <?= $comments_count ?>
			</a>
			<?php endif; ?>
		</p>
	</header>

	<?php if (count($item->images) && $options['disable_img'] == false): ?>
	<figure class='uk-text-center'>
		<div class="uk-inline-clip uk-transition-toggle" tabindex="0">
			<a href="<?= page()->template != 'blog-post' ? $item->url : $item->images->first->url ?>">
				<img data-src="<?= $item->images->first->url ?>" alt="<?= $item->images->first->description ?: $item->name?>"
				width='<?= $options['img_width'] ?>' height='<?= $options['img_height'] ?>' data-uk-img>
				<div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle">
				</div>
			</a>
		</div>
		<?php if ($item->images->first->description): ?>
		<figcaption class="uk-padding-small uk-text-center uk-text-muted"><?= $item->images->first->description ?></figcaption>
		<?php endif; ?>
	</figure>
	<?php endif; ?>

	<?php // if is blog post
		if ($item->id == page('id')):
	?>

	<?= $item->body ?>

	<footer>
		<?php if (count($item->categories)): ?>
		<div class='uk-margin-small'>
			<span data-uk-icon="icon: hashtag"></span>
			<?= $item->categories->each("<a class='uk-button uk-button-text' href='{url}'>{title}</a> ") ?>
		</div>
		<?php endif; ?>

		<?php if (count($item->tags)): ?>
		<div>
			<span data-uk-icon="icon: tag"></span>
			<?= $item->tags->each("<a class='uk-button uk-button-text' href='{url}'>{title}</a> ") ?>
		</div>
		<?php endif; ?>
	</footer>

	<?php else: ?>
		<p><?= $item->render('body', 'text-medium') ?></p>
		<a href="<?= $item->url ?>" title="<?= setting('read-more') ?>" class="uk-button uk-button-text uk-text-large">
		<?= ukIcon('arrow-right') ?>
		<?= setting('read-more') ?>
		</a><hr>
	<?php endif; ?>

</article>
