=== WPeMatico Custom Hooks ===
Contributors: albertdesinger,sniuk,etruel
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=B8V39NWK3NFQU
Tags: wpematico, WPeMatico Custom Hooks, autoblog, rss, feed, read, matic
Requires at least: 4.1
Tested up to: 4.9
Stable tag: 1.0.1

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
= 1.0.1 =
* Limitados los archivos de scripts y styles para enqueue en solo el setting page del custom hooks.
* Limitar el acceso directo a los archivos del plugin.
* Removidas las descripciones de ejemplos que no describen nada.
* Limitar la ejecucion de acciones de guardado y de verificacion de sintaxis a solo usuarios que puedan modificar los temas o los plugin.
* Se ha limpiado el guardado de las variables en las opciones.
* Solucionado el problema de que no se ejecutaba los hooks en el run manualmente del WPeMatico.
* Ahora el codigo no se ejecutara en el chequeo de sintaxis.
* Se ha separado los codigos JavaScript y CSS del PHP, y se ha escapado las impreciones en el HTML.

= 1.0 =
* initial release

== Upgrade Notice ==
1.0 * initial release