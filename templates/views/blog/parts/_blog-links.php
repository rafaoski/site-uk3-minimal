<?php namespace ProcessWire;
// Authors url slug
$authorsUrlSlug = sanitizer()->pageName(setting('authors'));
// Archives url slug
$archivesUrlSlug = sanitizer()->pageName(setting('archives'));
// Get Blog Pages
$blogLinks = [
// Categories
  0 => pages()->get("template=blog-categories"),
// Tags
  1 => pages()->get("template=blog-tags"),
// List All Posts
  2 => pages()->get("template=blog"),
// Authors
  3 => pages()->get("template=blog-posts"),
// Archives
  4 => pages()->get("template=blog"),
// RSS
  5 => pages()->get("template=blog-rss"),
// 'archives' => pages()->get("template=blog-archives"),
];
// Icons
$blogIcons = ['hashtag','tag','user', 'forward','copy','rss']
?>

<!-- BLOG LINKS -->
<div id='blog-links' class='blog-links uk-container uk-overflow-auto'>
  <div class=''>
    <ul class="uk-subnav uk-flex uk-flex-nowrap">
      <?php foreach ($blogLinks as $key => $link):
        $dataTurbolinks = $blogIcons[$key] == 'rss' ?  " data-turbolinks='false'" : '';
        // title / aria-label / link url
          if($blogIcons[$key] == 'user') {
              $title = setting('authors');
              $link_url = $link->url . "$authorsUrlSlug/";
            } else if($blogIcons[$key] == 'copy') {
              $title = setting('archives');
              $link_url = $link->url . "$archivesUrlSlug/";
            } else {
              $title = $link->title;
              $link_url = $link->url;
            }
      ?>
      <li class='blog-links-item'>
        <a class='uk-button uk-button-text' href='<?= $link_url ?>' aria-label="<?= $title ?>" <?= $dataTurbolinks ?>>
        <span class='uk-icon-button' data-uk-icon="icon: <?= $blogIcons[$key] ?>;"></span>
        <span><?php   echo $title ?></span>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<!-- /BLOG LINKS -->
