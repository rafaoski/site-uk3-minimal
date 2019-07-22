<?php namespace ProcessWire;

// look for a GET variable named 'q' and sanitize it
$q = input()->get('q');

// sanitize to text, which removes markup, newlines, too long, etc.
$q = sanitizer()->text($q);

// did $q have anything in it after sanitizing to text?
if ($q) {
    // Sanitize for placement within a selector string. This is important for any
    // values that you plan to bundle in a selector string like we are doing here.
    // It quotes them when necessary, and removes characters that might cause issues.
    $q = sanitizer()->selectorValue($q);

    // Search the title and body fields for our query text.
    // Limit the results to 50 pages. The has_parent!=2 excludes irrelevant admin
    // pages from the search, for when an admin user performs a search.
    $selector = "title|body~=$q, limit=50, has_parent!=2";

    // Find pages that match the selector
    $matches = pages()->find($selector);
} else {
    $matches = array();
}

// unset the variable that we no longer need, since it can contain user input
unset($q);
?>

<div id="hero" data-pw-remove></div>

<div id='content-body' class='flex-center search-page'>
    <?php
    // did we find any matches?
    if (count($matches)) {
        // yes we did, render them
        echo "<h3 class='uk-alert-succes' data-uk-alert>" . sprintf(setting('found-pages'), count($matches)) . '</h3>';

        echo '<ul>';
        foreach ($matches as $key) {
            echo "<li><a href='$key->url'>$key->title</a></li>";
        }
        echo '</ul>';
    } else {
        // we didn't find any
        echo "<h3 class='uk-alert-danger' data-uk-alert>" . setting('no-found') . "</h3>";
    }
    ?>
</div><!-- /#content-body -->
