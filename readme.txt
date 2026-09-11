=== WPeMatico Custom Hooks ===
Contributors: etruel,sniuk,manuelge
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=B8V39NWK3NFQU
Tags: autoblog, rss, feed, code, matic
Requires at least: 4.1
Requires PHP: 7.0
Tested up to: 7.1
Stable tag: 1.4
License: GPLv2 or later.

Customize how WPeMatico builds your posts. Write PHP for any of its hooks from the WordPress admin, with a real editor and instant validation.

== Description ==

WPeMatico Custom Hooks puts WPeMatico's developer API on a screen you can actually work in, and it is completely free.

Sooner or later every autoblog needs a rule that no settings page covers: strip a particular block out of the source content, rename images before they are downloaded, skip items that mention a certain word, decide a category from the feed itself, rewrite a title before it is published. WPeMatico fires dozens of hooks for exactly that purpose. This addon lists every one of them for you, each with a description of what it does, the parameters it receives, and a ready made function template.

No FTP. No child theme. No snippet buried in a functions.php that the next theme update will wipe. You write the function in a proper code editor, the plugin validates it before it is ever stored, and it runs on your next campaign.

= How it works =

1. **Pick a hook.** Each entry tells you what it does, whether it is an action or a filter, and which parameters it receives.
2. **Let the template be written for you.** One click drops a correctly formed function into the editor, already carrying the right name, signature and return value for that hook.
3. **Write your code.** On save it is parsed on the spot, and if anything is wrong you get the exact line and reason before a single character is stored.
4. **Done.** It runs from your next campaign onwards.

The catalogue is not limited to the core. The addon detects which WPeMatico extensions you have active and adds their hooks to the list too, so Professional, Full Content, Polyglot and the rest are covered as well.

== Features ==

* **Over 90 hooks catalogued**, from WPeMatico core and its extensions, each explained in plain language.
* **Function templates generated for you**, with the correct name, parameters and return value already in place.
* **A real code editor**, with PHP syntax highlighting and selectable colour schemes.
* **Validated before saving.** Your code is parsed in place and is never stored with a syntax error.
* **Conflict detection**, so two hooks can never end up declaring the same function name.
* **Clear reporting.** If something cannot run, you are told which hook and why, with a link straight to it.
* **Extension aware.** Hooks appear automatically when their extension is active, and the code you wrote for an extension is preserved while it is not.
* **Administrators only.** Reaching or saving anything here requires permission to edit plugins or themes.

= Requirements =
This WPeMatico addon requires the WPeMatico base plugin to be installed and activated.
PHP 7.0 or higher.

== Installation ==

You can either install it automatically from the WordPress admin, or do it manually:

1. Unzip plugin file and put the folder into your plugins folder (/wp-content/plugins/).

2. Activate the plugin from the WPeMatico Extensions menu.

1) Decompress it in the WordPress plugins folder to continue with activation. You must first have WPeMatico installed.

2) Once installed, go to the WPeMatico menu  - > Configuration  

3) Then, click on the 'Hooks' tab to go to the main page of the addon


== Frequently Asked Questions ==

= Can I use this addon without the WPeMatico plugin? =

No. The addon requires WPeMatico Free Version to be installed and activated.

== Screenshots ==

1. Settings page.  Fields to fill.

== Changelog ==

= 1.4 =
* **The settings screen fits the page again on WPeMatico 2.9.** Its About and Enjoy-it boxes come from the layout this plugin used before 2.9, where they were a sidebar of their own; printed in 2.9's content column they pushed the page 47 pixels wider than the window, so the right-hand column was cut off and the whole screen scrolled sideways. On 2.9 they move into WPeMatico's own sidebar, as a panel in the plugin's colours, and the tab gets its own icon in the menu.
* **The screen now opens like the rest of WPeMatico's.** A header carrying the plugin's name and mark, a line saying what the screen is for, its own icon in the menu, and a Help tab with three pages: what hooks are and how to use one, what goes in the editor (filters must return, actions need not, one function per hook), and how the editor itself works.
* **The screen tells you which hooks you are running code on.** The picker splits into *In use* and *Available*, so the hooks that already carry code are named up front, and each box is marked with the hook's own name and an *in use* badge. Picking any hook from the list opens its editor on the spot.
* **The screen opens faster.** The editor for a hook is built when you open that hook, instead of building one for every hook in the catalogue on every visit.
* The stylesheets follow the WordPress convention: the readable file while debugging, the minified one otherwise. Both are versioned with the plugin, so an update is not served from the browser's cache.

= 1.3 Aug 22, 2026 =
A major release. The plugin has been reviewed from top to bottom, modernized and made considerably more robust, so that writing your own PHP against WPeMatico is safe and predictable on any hosting.

* **Instant, local syntax checking.** Your code is now parsed in place the moment you save, and any mistake is reported with its exact line and reason. The check no longer needs your server to be able to reach itself over HTTP, so it works reliably on every host, including managed and firewalled ones.
* **Conflict detection while you write.** If two hooks would declare a function with the same name, or the name is already taken elsewhere in WordPress, you are told immediately and pointed at the hook that already uses it.
* **Fault tolerant execution.** Should any snippet be unable to run, the plugin now reports it in the admin with a clear explanation and a direct link to edit it, while the rest of your hooks keep working normally.
* **Your code stays where you put it.** Snippets are now bound to their hook by name, so installing, activating or deactivating WPeMatico extensions never shuffles them. Code written for an extension that is currently inactive is preserved instead of being lost.
* **Smarter function detection.** The functions attached to each hook are read from your code itself, so indented, multiple and by-reference declarations are always recognized.
* **Lighter on every page load.** Editor assets are now loaded only on the Hooks screen, and the work done on regular requests has been cut down substantially.
* **Reviewed hooks catalogue,** verified against the current WPeMatico core and its extensions, including hook names and parameter signatures, so every hook offered behaves exactly as described.
* **Modernized and hardened codebase** for current PHP and WordPress versions: stricter capability and input handling on the editor, cleaner translation loading, and no temporary PHP files written to disk.

= 1.2 Apr 29, 2021 =
* Added new filters of WPeMatico and many of its extensions.
* Fixes codemirror for rich text code.
* Introducing Filters groups to find them easier.
* Improved many help tips on filter selection.
* Bump WordPress version to 5.7.1

= 1.1.3 Aug 21, 2019 =
* Improves the Settings->Hooks screens. Now all is more intuitive.
* Hide all textareas without codes or filters.
* Updated all spanish translations.

= 1.1.2 Oct 19, 2018 =
* Added function filter wpematico_addcat_description filter to change the auto category descriptions.
* Added function filter Add filter wpematico_get_item_images.
* Fixes function parameter using "$this->".
* Fixes an issue in action filters.
* Fixes a warning in area code on use tab for indentation.

= 1.1.1 Feb 27, 2018 =
* Added wpematico_imagen_src filter added in wpematico 1.9.1

= 1.1 Jan 31, 2018 =
* Added code highlight with CodeMirror library included in WordPress since version 4.9.
* Fixes a bug when WPeMatico saves an image from a running campaign.

= 1.0.2 Sep 4, 2017 =
* Fix plugin text domain to wpematico-custom-hooks.
* Added Settings and auxiliary links in the Plugin row.
* Added in WordPress Repository.

= 1.0.1 Aug 27, 2017 =
* Tweaks JavaScript and styles only loads in the settings page of the plugin.
* Tweaks to limit save and verify code syntax just for user roles with edit_plugins or edit_themes capabilities.
* Tweaks on sanitize and escape the form fields and variables to print or save.
* Tweaks for JavaScript and styles printed in the php, now have their own files .js and .css.
* Fixes the hooks didn't executed when runs manually a campaign in WPeMatico.
* Fixes the syntax error checking to avoid execute code in the process.
* Fixes to avoid direct accesses to the files.
* Removed unuseful comments and examples.

= 1.0 =
* initial release

== Upgrade Notice ==
1.3 * Recommended upgrade.
