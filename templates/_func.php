<?php namespace ProcessWire;

/**
 * Return site head
 *
 * @param array|string $options Options to modify default behavior:
 *  - `css` (url): CSS files url.
 *  - `js` (url): JS files url.
 *  - `favicon` (url): Favicon url.
 *  - `title` (string): Meta title.
 *  - `description` (string): Meta description.
 *
 */
function siteHead($options = array())
{

	// $out is where we store the markup we are creating in this function
	$out = '';

	// Default Options
	$defaults = array(
		'css' => setting('css-files'),
		'js' => setting('js-files'),
		'favicon' => setting('favicon'),
		'title' => page('meta_title|title'),
		'description' => page('meta_description')
	);
	// Merge Options
	$options = _ukMergeOptions($defaults, $options);

	// disable turbolinks if the user is logged in
	if (user()->isLoggedin()) {
		unset($options['js'][0]); // unset turbolinks
	}

	$out.= "<meta http-equiv='content-type' content='text/html; charset=utf-8'>";
	$out.= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
	$out.= "<link rel='icon' href='$options[favicon]'/>";
	$out.= "<title id='title'>$options[title]</title>";
	$out.= "<meta id='description' name='description' content='$options[description]'/>";
	$out.= $options['css']->each("<link rel='stylesheet' href='{value}'>\n");
	$out.= $options['js']->each("<script src='{value}' defer></script>\n");
	$out.= hreflang(page()); // the hreflang parameter
	$out.= seoPagination(); // seo meta robots ( 'noindex, follow' ) or seo pagination

	return $out;
}

/**
 * Return the hreflang parameter
 *
 * @param Page $page
 *
 */
function hreflang(Page $page)
{

// $out is where we store the markup we are creating in this function
	$out = '';

	if(!$page->getLanguages()) return;
	if (!modules()->isInstalled("LanguageSupportPageNames")) return;
// handle output of 'hreflang' link tags for multi-language
	foreach(languages() as $language) {
	// if this page is not viewable in the language, skip it
		if(!$page->viewable($language)) continue;
	// get the http URL for this page in the given language
		$url = $page->localHttpUrl($language);
	// hreflang code for language uses language name from homepage
		$hreflang = setting('home')->getLanguageValue($language, 'name');
		if($hreflang == 'home') $hreflang = setting('lang-code');
	// output the <link> tag: note that this assumes your language names are the same as required by hreflang.
		$out .= "<link rel='alternate' hreflang='$hreflang' href='$url' />\n";
	}
	return $out;
}

/**
 * Return seo meta robots ( 'noindex, follow' ) or seo pagination
 *
 * @return mixed
 *
 */
function seoPagination()
{
// If not any pageNum or pageHeaderTags
if( input()->pageNum == null || config()->pagerHeadTags == null ) return;

// $out is where we store the markup we are creating in this function
	$out = '';

// https://processwire.com/blog/posts/processwire-2.6.18-updates-pagination-and-seo/
		if (input()->pageNum > 1) {
				$out .= "<meta name='robots' content='noindex,follow'>\n";
		}
// https://weekly.pw/issue/222/
		if (config()->pagerHeadTags) {
				$out .= config()->pagerHeadTags . "\n";
		}
		return $out;
}

/**
 * Return background image
 *
 * @param array|string $options Options to modify default behavior:
 *  - `img` (url): Image url.
 *
 */
function backgroundImage($options = array())
{

// Default Options
	$defaults = array(
		'img' => null,
	);
// Merge Options
	$options = _ukMergeOptions($defaults, $options);

	if ( setting('background-image') && $options['img'] ) {
		return  " style='background-image: linear-gradient( rgba(255, 255, 255, 0.92), rgba(216, 216, 216, 0.88) ), url({$options['img']->url});'";
	}
}

/**
 * Return site name or page title
 *
 * @param array|string $options Options to modify default behavior:
 *  - `id` (string): Selector id.
 *  - `class` (string): Selector class.
 *
 */
function siteName($options = array())
{
// $out is where we store the markup we are creating in this function
$out = '';

// Default Options
$defaults = array(
	'id' => 'site-name',
	'class' => 'site-name',
  );
// Merge Options
$options = _ukMergeOptions($defaults, $options);

$out .= "<p id='$options[id]' class='$options[class]'>";

	if (page('template')->name == 'home') {
		$out .= pages('options')->site_name;
	} else {
		$out .= ' / ' . page('title') . ' / ';
	}

$out .= "</p>";

return $out;
}

/**
 * Return Defer CSS https://www.giftofspeed.com/defer-loading-css/
 *
 * @param array|string $options Options to modify default behavior:
 *  - `custom_css` (link): link to custom css files.
 *  - `uikit_css` (link): link to uikit css files.
 *
 */
function deferCss($options = array())
{
// $out is where we store the markup we are creating in this function
$out = '';

// numbers important for loop
$i = 0;

// Default Options
$defaults = array(
	'custom_css' => urls('templates') . 'assets/css/custom.css',
	'uikit_css' => urls()->uikit_css,
);

// Merge Options
$options = _ukMergeOptions($defaults, $options);

$out .= "\n<!-- The below Javascript snippet will be defer any CSS file you want: -->\n";
$out .= "<script>\n";
	foreach ($options as $link) {
$i++;

		$out .= "/* {$i} CSS File */\n";
		$out .= "\tvar giftofspeed{$i} = document.createElement('link');\n";
		$out .= "\tgiftofspeed{$i}.rel = 'stylesheet';\n";
		$out .= "\tgiftofspeed{$i}.href = '{$link}';\n";
		$out .= "\tgiftofspeed{$i}.type = 'text/css';\n";
		$out .= "\tvar godefer{$i} = document.getElementsByTagName('link')[0];\n";
		$out .= "\tgodefer{$i}.parentNode.insertBefore(giftofspeed{$i}, godefer{$i});\n";

	}
$out .= "</script>\n\n";

$out .= "<!-- This will ensure that devices or browsers that do not support Javascript can load the CSS files as well -->\n";
$out .= "<noscript>\n";
$out .= "\t<link rel='stylesheet' type='text/css' href='$options[uikit_css]' />\n";
$out .= "\t<link rel='stylesheet' type='text/css' href='$options[custom_css]' />\n";
$out .= "</noscript>\n\n";

	return $out;
}

/**
 * Return Blog Archives
 *
 * @param array|string $options Options to modify default behavior:
 *  - `end_date` (date): or whenever you want it to end like 2019.
 *  - `start_date` (date): or whenever you want it to start like 2017.
 *  - `count_months` (number): How many show the monthly archives in the sidebar of the blog.
 *
 */
function blogArchive($options = array())
{

// $out is where we store the markup we are creating in this function
$out = '';
// Get blog page
$blogPage = pages()->get("template=blog-posts");

// Default Options
$defaults = array(
// Like First Blog Post ( 2016 )
	'start_date' => wireDate('Y', $blogPage->children()->last()->getUnformatted("date")),
// Like Last Blog Post ( 2019 )
	'end_date' => wireDate('Y', $blogPage->children()->first()->getUnformatted("date")),
// How many show the monthly archives in the sidebar of the blog.
	'count_months' => 12,
);
// Merge Options
$options = _ukMergeOptions($defaults, $options);

// CODE FROM => https://processwire.com/talk/topic/263-creating-archives-for-newsblogs-sections/
		for ($year = $options['end_date']; $year >= $options['start_date']; $year--) {

				for ($month = 12; $month > 0; $month--) {
						$startTime = strtotime("$year-$month-01"); // 2011-12-01 example
						if ($startTime > time()) {
								continue; // don't bother with future dates
						}
						if ($month == 12) {
								$endTime = strtotime(($year+1) . "-01-01");
						} else {
								$endTime = strtotime("$year-" . ($month+1) . "-01");
						}
						// All archive entries
						$entries = $blogPage->children("date>=$startTime, date<$endTime");
						// Get item url slug date
						$date = date("Y/m", $startTime);
						// Archive url slug
						$url = pages()->get("template=blog")->url . sanitizer()->pageName(setting('archives')) . '/' . $date . '/';
						// If count entries bigger than 0
						if (count($entries) > 0) {
						// if is archive page show form option value
							if(input()->urlSegment1 == sanitizer()->pageName(setting('archives'))) {
								$out .= "<option value='$url'>$date - (" . count($entries) . ")</option>";
							} else {
						// How many show the monthly archives in the sidebar of the blog ( $options['count_months'] )
							if(count($entries) <= $options['count_months']) {
								$out .= "<li><a class='uk-button uk-button-text uk-text-left' href='$url'>$date - (" . count($entries) . ")</a></li>";
							}

							}
						}
				}
		}

		return $out;
}

/**
 * Return Site Logo
 *
 * @param array|string $options Options to modify default behavior:
 *  - `home_url` (link): Home Page URL.
 *  - `logo_url` (link): Site logo URL.
 *  - `logo_alt` (string): Loago alt text.
 *  - `id` (string): Selector id.
 *  - `class` (string): Selector class.
 */
function siteLogo($options = array())
{
// Default Options
	$defaults = array(
		'home_url' => setting('home')->url,
		'logo_url' => pages('options')->logo ? pages('options')->logo->url : '',
		'logo_alt' => pages('options')->site_name,
		'id' => 'logo',
		'class' => 'logo'
	);
// Merge Options
	$options = _ukMergeOptions($defaults, $options);
// Display logo
	return "<div id='$options[id]' class='$options[class]'>
	        <a href='$options[home_url]'>
			<img src='$options[logo_url]' alt='$options[logo_alt]'></a>
			</div>\n";
}

/**
 * Return Google Webmaster Tools Verification Code
 *
 * @param string $code
 *
 */
function gwCode($code)
{
// If code is empty return null
if(!$code) return;
// Return Google Verification Code
return "<meta name='google-site-verification' content='$code' />\n";
}

/**
 * Return Google Analytics Tracking Code
 * https://developers.google.com/analytics/devguides/collection/analyticsjs/
 *
 * @param string $code {your-google-analytics-code}
 *
 */
function gaCode($code)
{
// If code is empty return null
if(!$code) return;
// Return Google Analytics Tracking Code
return "<script defer src='https://www.googletagmanager.com/gtag/js?id=UA-{$code}'></script>
<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-{$code}');
</script>\n\n";
}

/**
 * Return Social Profiles
 *
 * @param string $items Url social profiles separate with comma like:
 * https://facebook.com/,
 * https://twitter.com/processwire,
 * https://youtube.com/,
 * https://instagram.com/,
 * https://github.com/processwire/processwire
 *
 */
function socialProfiles($items)
{
// If all items is empty return null
if(!$items) return;
// $out is where we store the markup we are creating in this function
$out = '';
// Explode to array
$items = explode(',', $items);
// Remove NULL, FALSE and Empty Strings ("") ( https://www.php.net/manual/en/function.array-filter.php#Hcom111091 )
$items = array_filter($items, 'strlen');
// Start loop
foreach ($items as $item) {
// Get clean url
	$getUrl = sanitizer()->text($item, ['reduceSpace' => true]);
// Remove ( https:// ) from url like ( https://twitter.com )
	$profileName = substr($getUrl, 8);
// Get first position ( .com )
	$pos = strpos($profileName, '.com/');
// Show clean icon name like: ( 'twitter', 'facebook')
	$profileName = substr($profileName, 0, $pos);

// Or cut the profileName in this way
	// $pos = strpos($getUrl, '.com/');
	// $profileName = substr($getUrl, 8, $pos - 8);

// Prepare link to social profiles
$out .= "\n\t\t<a class='social-icon $profileName uk-icon-link uk-margin-small-right' title='$profileName'
	href='$getUrl' target='_blank' rel='noopener noreferrer' data-uk-icon='icon:$profileName; ratio:1.5'></a>\n";
}
// Return all Social Profiles
	return $out;
}

/**
 * Return Privacy Policy Page
 *
 * @param array|string $options Options to modify default behavior:
 *  - `privacy_page` (link): URL to privacy page.
 *  - `read_more` (string): Read more text.
 *	- `id` (string): Selector id.
 *  - `class` (string): Selector class.
 *
 */
function privacyPolicy($options = array())
{

// Default Options
$defaults = array(
	'privacy_page' => pages()->get("template=privacy-policy"),
	'read_more' => setting('read-more'),
	'id' => 'privacy-policy',
	'class' => 'privacy-policy',
  );
// Merge Options
$options = _ukMergeOptions($defaults, $options);

return "
<p id='$options[id]' class='$options[class]'>
	<span data-uk-icon='icon:info; ratio:1.5'></span>&nbsp;
	{$options['privacy_page']->meta_title}&nbsp;
	<a href='{$options['privacy_page']->url}'>
			$options[read_more]
	</a>
</p>
";
}

/**
 * Return Google Fonts
 *
 * @param array|string $options Options to modify default behavior:
 *  - `fonts` (array): Font families from google fonts ( https://fonts.google.com/ ).
 *
 */
function googleFonts($options = array()) {

	// Default Options
	$defaults = array(
		'fonts' => ['Nunito:200,600','Hanalei','Butcherman'],
	);
	// Merge Options
	$options = _ukMergeOptions($defaults, $options);

	$fonts = "'" . implode("','" , $options['fonts']) . "'";

	return "<script>
	/* ADD GOOGLE FONTS WITH WEBFONTLOADER
		https://github.com/typekit/webfontloader
	*/
	WebFontConfig = {
					google: {
					families: [$fonts]
			}
	};
	(function(d) {
			var wf = d.createElement('script'), s = d.scripts[0];
			wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore(wf, s);
	})(document);
	</script>\n\n";
}

/**
 * Return Previous Next Button Page
 * Basic Example echo prNx($page)
 *
 * @param Page $item
 *
 */
function prNx(Page $item)
{
// If  item is empty return null
if(!$item) return;

// $out is where we store the markup we are creating in this function
$out = '';

// Prev Next Button
		$p_next = $item->next();
		$p_prev = $item->prev();

// link to the prev blog post, if there is one
		if ($p_prev->id) {
		$out .= "<a class='uk-button uk-button-text uk-text-large uk-margin-small' href='$p_prev->url'>";
		$out .= ukIcon('arrow-left') . $p_prev->title . "</a>";
		}

// link to the next blog post, if there is one
		if ($p_next->id) {
				$out .= "<a class='uk-button uk-button-text uk-text-large' href='$p_next->url'>";
				$out .= $p_next->title . ukIcon('arrow-right') . "</a>";
		}

		return $out;
}

/**
 * Return AddToAny social share buttons script
 * https://www.addtoany.com/
 *
 * @param array $options Basic Usage toAny(['twitter' => true'])
 * 'twitter' => true,
 * 'facebook' => true,
 * 'google_plus' => false,
 * 'linkedin' => false,
 * 'rreddit' => false,
 * 'email' => false,
 * 'google_gmail' => false,
 * 'share_all' => true,
 *
 */
function toAny($options = array())
{
// If setting 'to-any' is not set true ( see _init.php setting() ) return null
	if( setting('to-any') == false ) return;
// $out is where we store the markup we are creating in this function
	$out = '';
// Reset variables
	$buttonLinks = '';
// Default share links
	$links = [
		'twitter' => "<a class='a2a_button_twitter'></a>",
		'facebook' => "<a class='a2a_button_facebook'></a>",
		'google_plus' => "<a class='a2a_button_google_plus'></a>",
		'linkedin' => "<a class='a2a_button_linkedin'></a>",
		'rreddit' => "<a class='a2a_button_reddit'></a>",
		'email' => "<a class='a2a_button_email'></a>",
		'google_gmail' => "<a class='a2a_button_google_gmail'></a>",
		'share_all' => "<a class='a2a_dd' href='https://www.addtoany.com/share'></a>"
	];
// Foreach Items
	foreach ($options as $key => $value) {
		if($options[$key] == true) {
			$buttonLinks .= $links[$key];
		}
	}
// Start Content
	$out .= "<!-- AddToAny BEGIN -->
	<div class='a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style'
			 style='left:0px; top:100px; background-color: #2e2d2d99;'>";
	$out .= $buttonLinks; // Show Links
	$out .= "</div>
	<script async src='https://static.addtoany.com/menu/page.js'></script>
	<!-- /AddToAny END -->";
	return $out;
}

/**
 * Return Link to Edit Page
 *
 * @param array|string $options Options to modify default behavior:
 *  - `id` (string): Selector id.
 *  - `div_class` (string): Selector div class.
 *  - `link_class` (string): Selector link class.
 *  - `edit_text` (string): The name of the buttont.
 *  - `edit_url` (link): Url to edit the page
 *
 */
function editPage($options = array())
{
// if not Page Editable return null
if(!page()->editable()) return;

// Default Options
$defaults = array(
	'id' => 'edit-btn',
	'div_class' => 'edit-btn uk-flex uk-flex-center uk-padding-small',
	'link_class' => 'uk-button uk-button-large uk-button-primary',
	'edit_text' => setting('edit'),
	'edit_url' => page()->editURL,
);
// Merge Options
$options = _ukMergeOptions($defaults, $options);

// Display region debugging info
return "<div id='$options[id]' class='$options[div_class]'>
<a class='$options[link_class]' href='$options[edit_url]'>$options[edit_text]</a></div>";
}

/**
 * Return region debugging info
 *
 * @param array|string $options Options to modify default behavior:
 *  - `id` (string): Selector id.
 *  - `class` (string): Selector class.
 *
 */
function debugInfo($options = array())
{
// Default Options
$defaults = array(
	'id' => 'debug-bar',
	'class' => 'debug-bar'
);
// Merge Options
$options = _ukMergeOptions($defaults, $options);
// display region debugging info
	if(config()->debug && user()->isSuperuser()) {
		return "<div id='$options[id]' class='$options[class]'><!--PW-REGION-DEBUG--></div>";
	}
}
