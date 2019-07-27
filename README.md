### [Uikit3](https://getuikit.com/) / Minimal Profile For [ProcessWire 3x](https://processwire.com/) with include new API additions like:
#### [New “Unique” status for pages](https://processwire.com/blog/posts/pw-3.0.127/)
#### [New $page->if() method](https://processwire.com/blog/posts/pw-3.0.126/)
#### [API setting()](https://processwire.com/blog/posts/processwire-3.0.119-and-new-site-updates/#new-functions-api-setting-function)
#### [$page->links()](https://processwire.com/blog/posts/processwire-3.0.107-core-updates/#page-gt-links)
#### [MarkupRegions](https://processwire.com/blog/posts/processwire-3.0.49-introduces-a-new-template-file-strategy/)
#### [FunctionsAPI](https://processwire.com/blog/posts/processwire-3.0.39-core-updates/#new-functions-api)
#### [Pagination and SEO](https://processwire.com/blog/posts/processwire-2.6.18-updates-pagination-and-seo/#pagination-and-seo-in-processwire)
#### [URL segments](https://processwire.com/docs/front-end/how-to-use-url-segments/)
#### [Methods for sanitizing and validating](https://processwire.com/api/ref/sanitizer/)
#### [$files->render() method](https://processwire.com/api/ref/wire-file-tools/render/)
#### [$files->include() method](https://processwire.com/api/ref/wire-file-tools/include/)
#### [Multiple language support](https://processwire.com/docs/multi-language-support/)
#### [Pagination metadata](https://weekly.pw/issue/222/#weekly-tips-and-tricks-adding-pagination-metadata-to-site-the-easy-way)

### How To Install
1. Download the [zip file](https://github.com/rafaoski/site-uk3-minimal/archive/master.zip) at Github or clone directly the repo: ```git clone https://github.com/rafaoski/site-uk3-minimal.git```
2. Extract the folder **site-uk3-minimal-master** into a fresh ProcessWire installation root folder.
3. During the installation of ProcessWire, choose the profile **Uikit3 / Minimal Profile**.

### Basic Info
1. Most of the profile settings and translates are in the ``` _init.php ``` file.
2. Functions can be found in the ``` _func.php, _uikit.php ``` file.
3. The entire view is rendered in the ``` _main.php ``` file that uses [markup regions](https://processwire.com/docs/front-end/output/markup-regions/).
4. You can easily add [hooks](https://processwire.com/docs/modules/hooks/) using the ``` ready.php ``` file.
5. Options page added with the new [“Unique”](https://processwire.com/blog/posts/pw-3.0.127/) status, which you can use in this simple way like:  
 ``` pages('options')->site_name ```  
  ``` pages->get('options')->site_name ```
6. The Author's website's blog entries and Archives page use URL segments `/authors/author-name/`, `/archives/Year/Month/`, see `views/blog/blog.php` for more info.
7. This profile has additional functions (_uikit.php) from the [regular uikit3](https://processwire.com/blog/posts/introducing-a-new-processwire-site-profile/) profile, which is located in the basic ProcessWire installer (
there are minor changes, such as adding translations from _init.php )

#### All images ( svg ) on the pages come from:
[Icofont](https://icofont.com/)  
[Simpleicons ( ProcessWire Logo ) ](https://simpleicons.org/?q=processwire)

#### References:
[Uikit 3](https://getuikit.com/)   
[AddToAny - Universal Sharing Buttons](https://www.addtoany.com/)  

####  License
2019 byHumans under the [MIT license](LICENSE).
