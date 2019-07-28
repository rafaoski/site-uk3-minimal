<?php namespace ProcessWire;

// reset variables
$textDate = $date = '';

// archive text
$archiveText = ' / ' . $archivesUrlSlug . ' / ';

// item year
$y = $sanitizer->pageName(input()->urlSegment2);
// item month
$m = $sanitizer->pageName(input()->urlSegment3);

// date to search archives
$date_s = "$y/$m/01";
$date_e = "$y/$m/31";

// if is archive url segments 2 or bigger
if( strlen(input()->urlSegment2) ) {

	// Show info about archive date
	$textDate = '<h2>' . sprintf(setting('archives-date'), $y, $m) . '</h2>';

	// title seo date
	$date =  " - $y/$m";

	// find items
	$items = pages()->find("template=blog-post, date>=$date_s, date<=$date_e, sort=-date, limit=12");

	// uikit icon
	$iconReply = ukIcon('reply', ['ratio' => '2.5', 'class' => 'blog-post-icon']);

	// link to archives page
	$archiveText = "<a href='" . page()->url . $archivesUrlSlug . "/'>" . $archivesUrlSlug . ' ' . $iconReply . "</a>";

		// if no items found
		if( count($items) == 0 ) {

			throw new Wire404Exception();

		}

} else { // find all items

	$items = pages()->find("template=blog-post, sort=-date, limit=12");

}

?>

<head id='html-head' data-pw-append>
	<meta name="robots" content="noindex,follow" />
</head>

<title id='title'><?= strtoupper( $archivesUrlSlug ) . $date ?></title>

<meta name="description" id='description' data-pw-remove/>

<p id='site-name'>
	<?= $archiveText ?>
</p>

<div id='breadcrumb' data-pw-replace>
	<div class='uk-float-right'>
		<ul class="uk-breadcrumb">
			<?php foreach (page()->parents->and(page()) as $key):?>
			<li><a href="<?= $key->url ?>"><?= $key->title ?></a></li>
			<?php endforeach; ?>
			<?php if( !strlen(input()->urlSegment3) ): ?>
			<li><span><?= $archivesUrlSlug ?></li></span>
			<?php else: ?>
			<li><a href='<?= page()->url . $archivesUrlSlug ?>/'><?= sanitizer()->pascalCase($archivesUrlSlug) ?></a>
			<li><span><?= "$y/$m" ?></span></li>
			<?php endif; ?>
		</ul>
	</div>
</div>

<div id='content-body'>

	<div class='uk-flex uk-flex-wrap uk-flex-middle' data-uk-grid>

		<?= $textDate ?>

		<form action="./">

			<div class="uk-margin">

			<select class="uk-select uk-form-width-medium uk-form-large" name='form'
					onchange='location = this.options[this.selectedIndex].value;'>

			<option class='uk-text-large' value='#'>

				<?= setting('select-archives') ?></option>

				<?= blogArchive() ?>

			</select>

			</div>

		</form>

	</div>

	<?= ukPagination($items, ['baseUrl' => "./"]) ?>

	<div class='uk-flex uk-flex-center uk-child-width-1-2@m' data-uk-grid>
		<?php
			foreach ($items as $item) {
				files()->include('views/blog/parts/_blog-article.php', ['item' => $item]);
			}
		?>
	</div>

	<?= ukPagination($items, ['baseUrl' => "./"]) ?>

</div>
