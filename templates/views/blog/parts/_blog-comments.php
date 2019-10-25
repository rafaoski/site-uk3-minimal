<?php namespace ProcessWire; ?>

<div class='uk-container uk-container-small uk-margin-medium-top'>
<?php
// Find comments that don't have a parent ( parent_id=0 )
$comments = page()->comments->find("parent_id=0");

// Show Comments ( https://processwire.com/talk/topic/21926-paginating-comments-using-pw-built-in-pagination-in-uikit-3-siteblog-profile/ )
echo ukComments($comments, ['paginate' => true, 'limit' => 12]);

// Comment form
echo ukHeading3(setting('post-comment'), "icon=comment");
echo ukCommentForm(page()->comments);
?>
</div>
