=== WPeMatico Custom Hooks ===
Contributors: albertdesinger,sniuk,etruel
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=B8V39NWK3NFQU
Tags: wpematico, WPeMatico Custom Hooks, autoblog, rss, feed, read, matic
Requires at least: 4.1
Tested up to: 5.0
Stable tag: trunk

Addon for WPeMatico. Allows you to execute PHP actions and filters right from your WordPress admin panel in order to create custom behaviors in your campaigns.

== Description ==

WPeMatico Custom Hooks is an addon of the main WPeMatico plugin that allows you to execute actions and filters provided by WPeMatico in order to create custom behavior in the execution of your campaigns, right from your WordPress admin panel. It's very interesting because it will let you see the functionalities of this powerful autoblogging plugin in greater depth, as well as its extensions on the development level. 

= How it works =

This addon allows you to add the actions and filters that WPeMatico possesses in order to make personalized changes in the campaigns you execute or actions that require a specific change in behavior.

== FEATURES ==

* Hooks updates from WPeMatico Core.
* Integration of Hooks through the installed WPeMatico extension.
* Help templates with the function for each filter or action.
* Elegant code editor with code highlighter for programmers.
* Syntax error check before saving the code for the functions.

= Requirements =
This WPeMatico addon requires the WPeMatico base plugin to be installed and activated.  
PHP 5.3 or higher

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
= 1.2 Jun 20, 2020 =
* Added new filters.
* Bump version 5.4.1 WP.

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
