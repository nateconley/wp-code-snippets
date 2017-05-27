=== WP Code Snippets ===
Contributors: nateconley
Author URI: http://nateconley.com
Tags: syntax, code, snippets
Requires at least: 4.0
Tested up to: 4.8
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily add code snippets in 120+ languages inside of the WordPress post editor or a using a shortcode.

== Description ==

Easily add code snippets in 120+ languages inside of the WordPress post editor or using a shortcode.

WP Code Snippets uses the amazing [PrismJS](http://prismjs.com/).

The easiest way to insert a snippet is to press the ```</>``` in the post editor. You can also highlight the entire shortcode and content to have the editor populated when you press ```</>```.

To use a shortcode, use the following format:
```[wp_code_snippets language="LANGUAGE_SLUG"]
<pre>
YOUR SNIPPET GOES HERE
</pre>
[/wp_code_snippets]
```
It is important to note that the inner content of the shortcode must be wrapped in a ```pre``` tag to maintain spacing.

== Installation ==

Upload WP Code Snippets to your site, activate it, then start adding snippets!

You can also change the theme and choose whether to include line-numbers or not.

== Frequently Asked Questions ==

= What languages are supported? =

You can view the list of 120+ supported languages [here](http://prismjs.com/#languages-list).

= Can I use this with Beaver Builder? =

You sure can! WP Code Snippets works well with the text editor module.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0.0 =
* Initial release
