<?php namespace ProcessWire;

// find all authors
$blogAuthors = pages()->find("template=user, nick_name!='', nick_pagename!='', include=all, limit=24");

// no items found
if( !count($blogAuthors) ) {
	files()->include('views/blog/parts/_no-found.php');
}
// pagination
$pagination = ukPagination($blogAuthors, ['baseUrl' => "./"]);
?>

<head id='html-head' data-pw-append>
	<meta name="robots" content="noindex,follow" />
</head>

<title id='title'><?= setting('authors') ?></title>
<meta name="description" id='description' data-pw-remove/>

<p id='site-name'>
	/ <?= setting('authors') ?> /
</p>

<div id='breadcrumb' data-pw-replace>
	<div class='uk-float-right'>
		<ul class="uk-breadcrumb">
			<?php foreach (page()->parents->and(page()) as $key):?>
			<li><a href="<?= $key->url ?>"><?= $key->title ?></a></li>
			<?php endforeach; ?>
			<li><span><?= setting('authors') ?></span></li>
		</ul>
	</div>
</div>

<div id="content-body">

	<?= $pagination ?>

		<!-- BLOG AUTHORS -->
		<?php if ( count($blogAuthors) ): ?>
		<div class='uk-flex uk-flex-center uk-child-width-1-3@m'  data-uk-grid>
			<?php foreach ($blogAuthors as $author): ?>
				<div>
					<a href="<?= pages()->get("template=blog")->url . $authorsUrlSlug . '/' . sanitizer()->pageName($author->nick_name , true) . '/' ?>"
						class='uk-link-reset'>
						<div class='uk-card uk-card-default uk-card-body uk-card-hover'>
							<h3 class="uk-card-title"><?= $author->nick_name ?></h3>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

	<?= $pagination ?>

</div>
