<?php namespace ProcessWire;

/**
 * ProcessWire Bootstrap API Ready
 * ===============================
 * This ready.php file is called during ProcessWire bootstrap initialization process.
 * This occurs after the current page has been determined and the API is fully ready
 * to use, but before the current page has started rendering. This file receives a
 * copy of all ProcessWire API variables. This file is an idea place for adding your
 * own hook methods.
 *
 */

/** @var ProcessWire $wire */

// -- Hook Admin Custom CSS
// $wire->addHookAfter('Page::render', function($event) {
// 	if(page()->template != 'admin') return; // Check if is Admin Panel
// 	$value  = $event->return; // Return Content
// 	$templates = urls()->templates; // Get Template folder URL
// 	$style = "<link rel='stylesheet' href='{$templates}assets/css/admin.css'>"; // Add Style inside bottom head
// 	$event->return = str_replace("</head>", "\n\t$style</head>", $value); // Return All Changes
// });

// -- Save the cleaned username (author of the blog page) in the nick_pagename field based on the field named nick_name
// -- Field ( nick_pagename ) will be needed to search for a given blog author ( user ) through url segments in the page's url
wire()->addHookAfter('Pages::saveReady', function($event) {
$page = $event->arguments('page');
if ($page->template != 'user') return;
// -- Change default language nick name
	if($page->isChanged('nick_name')) {
	// -- Turn off outputFormatting
		$page->of(false);
	// -- Save Multi Language Fields ( https://processwire.com/docs/multi-language-support/multi-language-fields/ )
		if($page->getLanguages() && modules()->isInstalled("LanguageSupportPageNames")) {
			foreach (languages() as $language) {
		// -- Get language value nick_name
			$nick_name = $page->nick_name->getLanguageValue($language->name);
		// -- Set language value into nick_pagename
			$page->nick_pagename->setLanguageValue($language->name, sanitizer()->pageName($nick_name));
			}
		} else {
		// -- If no multi language
			$page->nick_pagename = sanitizer()->pageName($page->nick_name, true);
		}
	}
});
