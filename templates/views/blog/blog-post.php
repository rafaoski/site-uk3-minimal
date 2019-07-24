<?php namespace ProcessWire;

$blogPage = pages()->get("template=blog");
?>
<head id='html-head' pw-append>
<script src='<?= urls('jquery') ?>' defer></script>
<script src='<?= urls()->FieldtypeComments ?>comments.min.js' defer></script>
<link rel="stylesheet" href="<?= urls()->FieldtypeComments ?>comments.css">
</head>

<div id="hero" data-pw-remove></div>

<p id='site-name'>
	<a href='<?= $blogPage->url ?>'>
		<?= $blogPage->title ?>
		<?= ukIcon('reply', ['ratio' => '2.5', 'class' => 'blog-post-icon']) ?>
	</a>
</p>

<div id='content-body' class='-uk-margin-top -uk-margin-bottom'>

	<!-- CONTENT BLOG -->
	<div class='content-blog' data-uk-grid>

		<!-- CONTENT ARTICLE -->
		<div class='content-article uk-width-3-4@m'>
			<?php
				// blog article
				echo files()->render('views/blog/parts/_blog-article.php',
				[
					'item' => page(),
					// 'options' => [],
				]);

				// page links
				echo files()->render('views/template-parts/_page-links.php');

				// if comments
				if( setting('comments') ) {
					include('parts/_blog-comments.php');
				}
			?>
		</div>

		<!-- SIDEBAR -->
		<div class='content-sidebar uk-width-1-4@m'>
			<?php include('parts/_blog-sidebar.php') ?>
		</div>

	</div>

	<!-- PREVIOUS NEXT POST MENU -->
	<div class="nav-page uk-flex uk-flex-wrap uk-flex-around uk-margin-medium-top uk-margin-small">
		<?= prNx(page()) ?>
	</div>

<?php
// Universal Sharing Buttons ( https://www.addtoany.com/ )
echo toAny(
	[
		'twitter' => true,
		'facebook' => true,
		'email' => true
	])
?>
</div>
