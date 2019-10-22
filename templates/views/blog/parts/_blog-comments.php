<?php namespace ProcessWire; ?>

<div class='uk-container uk-container-small uk-margin-medium-top'>
<?php
// https://processwire.com/talk/topic/594-how-can-i-use-pagination-with-comments/

$limit = 12;
$start = ($input->pageNum - 1) * $limit;

// Find comments that don't have a parent ( parent_id=0 )
$comments = page()->comments->find("start=$start, limit=$limit, parent_id=0");

// Show Comments
echo ukComments($comments);

// Show navigation
if($input->pageNum > 1) {
	echo "<a class='uk-button uk-button-text' href='./page" . (input()->pageNum - 1) . "'>" .
	ukIcon('arrow-left') . setting('previous-comments') . "</a> ";
}

if($start + $limit < count(page()->comments->find("parent_id=0"))) {
	echo "<a class='uk-button uk-button-text' href='./page" . (input()->pageNum + 1) . "'>" .
	setting('next-comments') . ukIcon('arrow-right') . "</a>";
}

// comment form
echo ukHeading3(setting('post-comment'), "icon=comment");
echo ukCommentForm(page()->comments);
?>
</div>
