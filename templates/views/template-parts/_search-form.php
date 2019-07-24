<?php namespace ProcessWire;

$searchPage = pages()->get('template=search')->url;
$placeholder = setting('search-placeholder');
$searchLabel = setting('search-label');
?>

<form id='search-f' class='search-f' action='<?= $searchPage ?>' method='get'>
	<label class='uk-label uk-margin-small uk-margin-top' for='q'><?= $searchLabel ?></label>
	<input class='s-input uk-input' type='search' name='q' id='q' placeholder='<?= $placeholder ?> &hellip;' required>
</form>
