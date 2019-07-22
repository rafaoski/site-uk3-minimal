<?php namespace ProcessWire;
$ifPages = page('meta_title') || page('meta_description');
?>

<div id="hero-content" class='hero-content uk-flex uk-flex-center uk-flex-middle uk-text-center' data-uk-grid>
  <?php if ($img): ?>
    <div id="hero-image" class='hero-image <?php if($ifPages) echo 'uk-width-1-3@m'?>'>
      <?php if($img) echo "<img data-src='{$img->url}' alt='{$img_alt}' data-uk-img>"; ?>
    </div>
  <?php endif; ?>

<?php if ($ifPages): ?>
  <div id="hero-text" class='hero-text uk-width-2-3@m'>
    <div class='uk-card uk-card-body uk-card-primary'>
      <?= page()->if("meta_title", "<h1>{meta_title}</h1>") ?>
      <?= page()->if("meta_description", "<h2 class='uk-text-lead uk-text-left'>{meta_description}</h2>") ?>
    </div>
  </div>
<?php endif; ?>
</div>
