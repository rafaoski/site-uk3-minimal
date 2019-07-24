<?php namespace ProcessWire;
// explode to get first template folder
$inc_parts = explode("-", page('template'));
// include folder template
wireIncludeFile('views/' . $inc_parts[0] . '/' . page('template') . '.php');
