<?php namespace ProcessWire;
// Translatable " Authors " text
$authText = setting('authors');
?>

<!-- CATEGORIES -->
<?php
$categories = pages()->get("template=blog-categories");
echo ukNav($categories->children('limit=9'),
      [
        'heading' => ukHeading3($categories->title, ['line' => 'left','class' => 'uk-h2']),
        'linkClass' => 'uk-button uk-button-text uk-text-left',
        'maxItems' => 9
      ]);
?>
<!-- /CATEGORIES -->

<!-- /RECENT POSTS -->
<?php
echo ukNav(page()->parent->children('limit=6'),
      [
        'heading' => ukHeading3(setting('recent-posts'), ['line' => 'left','class' => 'uk-h2']),
        'class' => 'uk-margin-medium-top',
        'linkClass' => 'uk-button uk-button-text uk-text-left'
      ]);
?>
  <p>
    <a class='uk-button uk-button-text uk-text-primary' href='<?=page()->parent->url?>'>
      <?= setting('more-posts') ?>
      <?= ukIcon('arrow-right') ?>
    </a>
  </p>
<!-- /RECENT POSTS -->


<!-- ARCHIVES -->
<?= ukHeading3(setting('archives'), ['line' => 'left', 'class' => 'uk-h2']) ?>
<ul class="uk-nav uk-nav-default">
  <?= blogArchive() ?>
</ul>
<p>
    <a class='uk-button uk-button-text uk-text-primary' 
        href='<?= pages()->get("template=blog")->url . sanitizer()->pageName(setting('archives')) . '/' ?>'>
      <?= setting('archives') ?>
      <?= ukIcon('arrow-right') ?>
    </a>
  </p>
<!-- /ARCHIVES -->

<!-- AUTHORS -->
<?php
// You should change the authors url slug in the _init.php file ( 'authors' => __('Authors') ) if the page has a different name than the authors
    $authorsUrlSlug = sanitizer()->pageName($authText, true);
    $authUrl = pages()->get("template=blog")->url . $authorsUrlSlug;
    $blogAuthors = users()->find("nick_name!='', nick_pagename!='', limit=12");
    // $blogAuthors = pages()->find("template=user, nick_name!='', nick_pagename!='', include=all, limit=2");
?>
<ul class="uk-nav uk-nav-default uk-margin-medium-top">
  <li class='uk-nav-header'><?= ukHeading3($authText, ['line' => 'left','class' => 'uk-h2']) ?></li>
  <?php foreach ($blogAuthors as $key => $author):
        $auth_url = pages()->get("template=blog")->url . $authorsUrlSlug . '/' .  $author->nick_pagename . '/';
  ?>
  <li>
    <a class='uk-button uk-button-text uk-text-left'
        href="<?= $auth_url ?>">
      / <?= $author->nick_name ?>
    </a>
  </li>
  <?php endforeach;
  // URL to blog authors page 
  echo "<li class='uk-margin-small-top'>
        <a class='uk-button uk-button-text uk-text-left uk-text-primary' uk-icon='icon: arrow-right'
                  href='$authUrl/'>$authText</a></li>"
  ?>

</ul>
<!-- /AUTHORS -->

<!-- TAGS -->
<?php
$tags = pages()->get("template=blog-tags");
echo ukNav($tags->children('limit=9'),
      [
        'heading' => ukHeading3($tags->title . '/ ', ['line' => 'left','class' => 'uk-h2']),
        'type' => 'primary',
        'divider' => false,
        'class' => 'uk-margin-medium-top uk-flex uk-flex-wrap uk-flex-around uk-flex-middle',
        'linkClass' => 'uk-button uk-button-text uk-text-left',
        'maxItems' => 9
      ]);
?>
<!-- /TAGS -->
