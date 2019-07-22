<?php namespace ProcessWire;

// Get Year / Month from url segments
$y = input()->urlSegment(2);
$m = input()->urlSegment(3);

// Date to search archives
$date_s = "$y/$m/01";
$date_e = "$y/$m/31";

// find archives
$items = pages()->find("template=blog-post, date>=$date_s, date<=$date_e, sort=-date, limit=12");

// If url segmments 3 ( month ) without any items && not find any archive items
if(strlen(input()->urlSegment3) && count($items) == 0) {

  throw new Wire404Exception();

}

// If no found any items
if( count($items) == 0 ) {

// Find All items to show in archive page /archives/ 
$items = pages()->find("template=blog-post, sort=-date, limit=12");

// Get year for archives date text (<h1 id='archive-date'>Y</h1>)
$y =  wireDate('Y', $items->first()->getUnformatted("date"));

// Get montch for archives date text (<h1 id='archive-date'>Date: Y/m</h1>)
$m =  wireDate('m', $items->first()->getUnformatted("date"));

}

// if URL segments archive like: ( /archives/2019/0-6/ )
if(strlen(input()->urlSegment3)) {
  // Uikit icon  
    $iconReply = ukIcon('reply', ['ratio' => '2.5', 'class' => 'blog-post-icon']);  
  // Title seo date  
    $archivesSeoDate =  " - $y/$m";
  // Link to archives page
    $archivesName = "<a href='" . page()->url . input()->urlSegment1 . "/'>" . input()->urlSegment1 . ' ' . $iconReply . "</a>";
  // if archive page  
  } else {
  // Reset variables
    $archivesSeoDate = '';
  // Simple name  
    $archivesName = setting('archives');
}

?>

<head id='html-head' data-pw-append>
    <meta name="robots" content="noindex,follow" />
</head>

<title id='title'><?= setting('archives') . $archivesSeoDate ?></title>

<meta name="description" id='description' data-pw-remove/>

<p id='site-name-text'>
    / <?= $archivesName ?>
</p>

<div id='bredcrumb' class='breadcrumb uk-container uk-margin-small-top uk-visible@m' data-pw-replace>
    <div class='uk-float-right'>
        <ul class="uk-breadcrumb">
            <?php foreach (page()->parents->and(page()) as $key):?>
            <li><a href="<?= $key->url ?>"><?= $key->title ?></a></li>
            <?php endforeach; ?>
            <?php if( !strlen(input()->urlSegment3) ): ?>
            <li><span><?= input()->urlSegment1 ?></li></span>
            <?php else: ?>
            <li><a href='<?= page()->url . $archivesUrlSlug ?>/'><?= setting('archives') ?></a>
            <li><span><?= "$y/$m" ?></span></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<div id='content-body'>

<form action="./">

  <select style='background:#bab5af; color:black;' class="uk-select" name='form'
          onchange='location = this.options[this.selectedIndex].value;'>

  <option value='#'><?=setting('select-archives');?></option>

    <?= blogArchive() ?>

  </select>

</form>


<h1 id='archive-date'><?= sprintf(setting('archives-date'),$y, $m ) ?></h1>

<?php // Pagination
  echo ukPagination($items, ['baseUrl' => "./"]);
?>

<div class='uk-flex uk-flex-center uk-child-width-1-2@m' data-uk-grid>
<?php
// Blog Posts
foreach ($items as $item) {
  files()->include('views/blog/parts/_blog-article.php', ['item' => $item]);
}
?>
</div>

<?php // Pagination
  echo ukPagination($items, ['baseUrl' => "./"]); 
?>

</div>
