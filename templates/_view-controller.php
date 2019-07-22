<?php namespace ProcessWire;
// Explode to get first template folder
$inc_parts = explode("-", page('template'));
// Include Folder Template
wireIncludeFile('views/' . $inc_parts[0] . '/' . page('template') . '.php');
