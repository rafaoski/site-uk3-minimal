<?php namespace ProcessWire;

/**
 * The blog page uses URL segments ( /authors/{author-name}/ ) / ( /archives/2019/06/ )
 * https://processwire.com/docs/front-end/how-to-use-url-segments/
 *
 */

// we are only using 3 URL segments so send a 404 if there's more than 3
if( strlen(input()->urlSegment4) ) throw new Wire404Exception();

// you should change the authors url slug in the _init.php file ( 'authors' => __('Authors') ) if the page has a different name than the authors
$authorsUrlSlug = sanitizer()->pageName(setting('authors'));
// you should change the archives url slug in the _init.php file ( 'archives' => __('Archives') ) if the page has a different name than the archives
$archivesUrlSlug = sanitizer()->pageName(setting('archives'));

// check if this page is the authors' page
if( strlen(input()->urlSegment1) && $input->urlSegment1 == $authorsUrlSlug ) {

// wWe are only using 2 URL segments in authors ( /authors/{author-name}/ ), so send a 404 if there's more than 2
if( strlen(input()->urlSegment3) ) throw new Wire404Exception();

// authors entries
if( strlen(input()->urlSegment1) ) {
	files()->include('views/blog/parts/_blog-authors.php', [
		'authorsUrlSlug' => $authorsUrlSlug
	]);
}

// author entries
if( strlen(input()->urlSegment2) ) {
	files()->include('views/blog/parts/_blog-author.php',
		[
			'authorsUrlSlug' => $authorsUrlSlug
		]);
}

// archives page
} else if(strlen(input()->urlSegment1) && $input->urlSegment1 == $archivesUrlSlug) {

	files()->include('views/blog/parts/_blog-archives.php',
		[
			'archivesUrlSlug' => $archivesUrlSlug
		]);

} else {

// with the defolt query, we do not want to use url segments
	if(strlen(input()->urlSegment1)) throw new Wire404Exception();

// basic content
	files()->include('views/blog/parts/_blog-content.php');
}

?>

<!-- HERO -->
<div id='hero'>
	<?php include('parts/_blog-links.php') ?>
</div>
