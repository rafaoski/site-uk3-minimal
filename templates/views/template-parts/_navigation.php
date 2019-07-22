<?php namespace ProcessWire;
// Get home page and home childrens
$root = pages('/')->and(pages('/')->children);
?>

<ul class="uk-subnav uk-flex uk-flex-nowrap">
  <?php foreach ($root as $item):
    $class = $item->id == wire('page')->id ? 'uk-active active' : 'basic-link';
  ?>
    <li class='<?= $class ?>'>
      <a class='nav-link' href="<?= $item->url ?>"><?= $item->title ?></a>
    </li>
  <?php endforeach; ?>
</ul>
