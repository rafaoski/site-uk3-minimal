<?php namespace ProcessWire;

// https://processwire.com/blog/posts/processwire-3.0.107-core-updates/
$links = page()->links();

// if another page has links to this page
if ($links->count()): ?>
<h3><?= setting('also-like') ?></h3>
<ul>
 	<?= $links->each("<li><a class='uk-button uk-button-text' href={url}>{title}</a></li>") ?>
</ul>
<?php endif;
