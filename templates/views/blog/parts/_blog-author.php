<?php namespace ProcessWire;
// -- Author nick_name ( user Nick Name )
$user_nick = sanitizer()->pageName(input()->urlSegment2, true);
//  -- Get user ( author ) from users
$postUser = users()->get("nick_pagename=$user_nick");
// -- Find all Author ( user ) Blog Posts
$blogPosts = pages()->find("template=blog-post, created_users_id=$postUser->id, limit=12");
// No Items Found
if( !count($blogPosts) ) {
    files()->include('views/blog/parts/_no-found.php');
// ession()->redirect(pages()->get("template=blog")->httpUrl;
// throw new Wire404Exception();
}
// -- Pagination
$pagination = ukPagination($blogPosts, ['baseUrl' => "./"]);
?>

<head id='html-head' data-pw-append>
    <meta name="robots" content="noindex,follow" />
</head>

<title id='title'><?= $postUser->nick_name ?></title>

<meta name="description" id='description' data-pw-remove/>

<p id='site-name'>
    / <?= $postUser->nick_name ?> /
</p>

<div id='bredcrumb' class='breadcrumb uk-container uk-margin-small-top uk-visible@m' data-pw-replace>
    <div class='uk-float-right'>
        <ul class="uk-breadcrumb">
            <?php foreach (page()->parents->and(page()) as $key):?>
            <li><a href="<?= $key->url ?>"><?= $key->title ?></a></li>
            <?php endforeach; ?>
            <li><a href='<?= page()->url . $authorsUrlSlug ?>/'><?= setting('authors') ?></a></li>
            <li><span><?= $postUser->nick_name ?></span></li>
        </ul>
    </div>
</div>

<div id="content-body">

<?= $pagination ?>

<!-- BLOG POSTS -->
<div class='uk-flex uk-flex-center uk-child-width-1-2@m' data-uk-grid>
    <?php // Blog Posts Loop
    foreach ($blogPosts as $item) {
              echo files()->render('views/blog/parts/_blog-article.php',
              [
                'item' => $item,
                // 'options' => [],
              ]);
        }
    ?>
</div>
<!-- /BLOG POSTS -->

<?= $pagination ?>

</div>
