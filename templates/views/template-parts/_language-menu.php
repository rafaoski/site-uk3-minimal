<?php namespace ProcessWire;

// if the language modules are installed, show the language menu
if(!page()->getLanguages()) return;
if (!modules()->isInstalled("LanguageSupportPageNames")) return;
?>

<!-- LANGUAGE MENU -->
<div id='lang-menu' class='lang-menu uk-margin-left uk-margin-right uk-overflow-auto'>
	<ul class="uk-subnav uk-flex uk-flex-nowrap">
		<?php
			foreach(languages() as $language) {
				if(!page()->viewable($language)) continue; // is page viewable in this language?
				$class = $language->id == user()->language->id ? 'uk-active' : 'no-current';
				$url = page()->localUrl($language);
				$hreflang = setting('home')->getLanguageValue($language, 'name');
				if($hreflang == 'home') $hreflang = setting('lang-code');
				// Show Menu
				echo "\t\t<li class='$class'>
							<a class='lang-item $language->title' hreflang='$hreflang' href='$url'>$language->title</a>
						</li>\n";
			}
		?>
	</ul>
</div>
