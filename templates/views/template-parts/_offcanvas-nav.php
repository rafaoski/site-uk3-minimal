<?php namespace ProcessWire ?>

<div class="uk-offcanvas-bar">
  <button class="uk-offcanvas-close" type="button" data-uk-close></button>
  <h3 class='uk-h4'><a aria-label='Home' href='<?= setting('home')->url ?>'><?= pages('options')->site_name ?></a></h3>
  <?php
  // offcanvas navigation
  // example of caching generated markup (for 600 seconds/10 minutes)
  echo cache()->get('offcanvas-nav', 10, function() {
    return ukNav(pages('/')->children(), [
      'depth' => 2,
      'accordion' => true,
      // 'blockParents' => [ 'blog' ],
      'repeatParent' => true,
      'noNavQty' => 20,
      'maxItems' => 16,
    ]);
  });
  ?>
</div>