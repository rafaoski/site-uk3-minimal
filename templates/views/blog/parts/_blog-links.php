<?php namespace ProcessWire;
// You should change the authors url slug in the _init.php file ( 'authors' => __('Authors') ) if the page has a different name than the authors
$authorsUrlSlug = sanitizer()->pageName(setting('authors'));
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
<div class='blog-links uk-container uk-container-expand'>
  <div class='uk-flex uk-flex-wrap uk-grid-small' data-uk-grid>
    <?php foreach ($blogLinks as $key => $link): 
     $dataTurbolinks = $blogIcons[$key] == 'rss' ?  " data-turbolinks='false'" : '';
    ?>
    <div>
  
      <a href='<?php if($blogIcons[$key] == 'user') {
              echo $link->url . "$authorsUrlSlug/";
              } else if($blogIcons[$key] == 'copy') {
                echo $link->url . "$archivesUrlSlug/";
              } else {
                echo $link->url;
              } ?>'
              data-uk-tooltip="<?php if($blogIcons[$key] == 'user') {
                echo setting('authors');
              } else if($blogIcons[$key] == 'copy') {
                echo setting('archives');
              } else {
                echo $link->title;
              } ?>"<?= $dataTurbolinks ?>>
                  
        <div class='uk-card uk-card-body uk-card-small uk-card-default uk-card-hover'>
            <span data-uk-icon="icon: <?= $blogIcons[$key] ?>; ratio: 1.3"></span>
        </div>

      </a>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<!-- /BLOG LINKS -->
