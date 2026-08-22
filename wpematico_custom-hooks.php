<?php
/**
 * Plugin Name: WPeMatico Custom Hooks
 * Requires Plugins: wpematico
 * Plugin URI:  https://etruel.com/downloads/wpematico-custom-hooks/
 * Description: WPeMatico Add-on starter point WPeMatico Custom Hooks plugin 
 * Version:     1.3
 * Author:      etruel
 * Author URI:  https://www.netmdp.com
 * Text Domain: wpematico-custom-hooks
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * 
 *  
  WPeMatico Custom Hooks is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  any later version.

  WPeMatico Custom Hooks is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with WPeMatico Custom Hooks. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Plugin version
if (!defined('WPEMATICOHK_VER')) {
	define('WPEMATICOHK_VER', '1.3');
}

// Minimum required WPeMatico version
if (!defined('WPEMATICOHK_REQ_WPEMATICO')) {
	define('WPEMATICOHK_REQ_WPEMATICO', '2.7.7');
}

if (!class_exists('wpematicohk')) {

	/**
	 * Main wpematicohk class
	 *
	 * @since       1.0.0
	 */
	class wpematicohk {

		/**
		 * @var         wpematicohk $instance The one true wpematicohk
		 * @since       1.0.0
		 */
		private static $instance;

		/**
		 * Get active instance
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      object self::$instance The one true wpematicohk
		 */
		public static function instance() {
			if (!self::$instance) {
				self::$instance = new self();
				self::$instance->setup_constants();
				self::$instance->includes();
				// WP 6.7 warns when a text domain is loaded before init, and this class boots
				// on plugins_loaded 999. See load_textdomain().
				add_action('init', array(__CLASS__, 'load_textdomain'));
			}

			return self::$instance;
		}

		/**
		 * Setup plugin constants
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      void
		 */
		public static function setup_constants() {
			// Plugin root file
			if (!defined('WPEMATICOHK_ROOT_FILE')) {
				define('WPEMATICOHK_ROOT_FILE', __FILE__);
			}
			// Plugin path
			if (!defined('WPEMATICOHK_DIR')) {
				define('WPEMATICOHK_DIR', plugin_dir_path(__FILE__));
			}
			// Plugin URL
			if (!defined('WPEMATICOHK_URL')) {
				define('WPEMATICOHK_URL', plugin_dir_url(__FILE__));
			}
			if (!defined('WPEMATICOHK_STORE_URL')) {
				define('WPEMATICOHK_STORE_URL', 'https://etruel.com');
			}
			if (!defined('WPEMATICOHK_ITEM_NAME')) {
				define('WPEMATICOHK_ITEM_NAME', 'wpematico-custom-hooks');
			}
		}

		/**
		 * Include necessary files
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      void
		 */
		public static function includes() {
			// plugin_functions.php first: it declares the core-version helpers the rest uses.
			require_once WPEMATICOHK_DIR . 'includes/plugin_functions.php';
			require_once WPEMATICOHK_DIR . 'includes/wpematicohk_settings.php';
			require_once WPEMATICOHK_DIR . 'includes/wpematicohk_sintax.php';
			require_once WPEMATICOHK_DIR . 'includes/wpematicohk_execute_action_filter.php';
		}

		public static function add_updater($args) {
			if (empty($args['wpematicohk'])) {
				$args['wpematicohk'] = array();
				$args['wpematicohk']['api_url'] = WPEMATICOHK_STORE_URL;
				$args['wpematicohk']['plugin_file'] = WPEMATICOHK_ROOT_FILE;
				$args['wpematicohk']['api_data'] = array(
					'version' => WPEMATICOHK_VER, // current version number
					'item_name' => WPEMATICOHK_ITEM_NAME, // name of this plugin
					'author' => 'Esteban Truelsegaard'  // author of this plugin
				);
			}
			return $args;
		}

		/**
		 * Internationalization
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      void
		 */
		public static function load_textdomain() {
			// Set filter for language directory
			$lang_dir = WPEMATICOHK_DIR . '/languages/';
			$lang_dir = apply_filters('wpematicohk_languages_directory', $lang_dir);

			// Traditional WordPress plugin locale filter
			$locale = apply_filters('plugin_locale', get_locale(), 'wpematico-custom-hooks');
			$mofile = sprintf('%1$s-%2$s.mo', 'wpematico-custom-hooks', $locale);

			// Setup paths to current locale file
			$mofile_local = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/wpematico-custom-hooks/' . $mofile;

			if (file_exists($mofile_global)) {
				// Look in global /wp-content/languages/wpematicohk/ folder
				load_textdomain('wpematico-custom-hooks', $mofile_global);
			} elseif (file_exists($mofile_local)) {
				// Look in local /wp-content/plugins/wpematico-custom-hooks/languages/ folder
				load_textdomain('wpematico-custom-hooks', $mofile_local);
			} else {
				// Load the default language files
				load_plugin_textdomain('wpematico-custom-hooks', false, $lang_dir);
			}
		}

		/**
		 * Add settings
		 *
		 * @access      public
		 * @since       1.0.0
		 * @param       array $settings The existing EDD settings array
		 * @return      array The modified EDD settings array
		 */
		public static function settings($settings) {
			$new_settings = array(
				array(
					'id' => 'wpematicohk_settings',
					'name' => '<strong>' . __('Plugin Name Settings', 'wpematico-custom-hooks') . '</strong>',
					'desc' => __('Configure Plugin Name Settings', 'wpematico-custom-hooks'),
					'type' => 'header',
				)
			);

			return array_merge($settings, $new_settings);
		}

	}

} // End if class_exists check

/**
 * The main function responsible for returning the one true wpematicohk
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      \wpematicohk The one true wpematicohk
 *
 * @todo        Inclusion of the activation code below isn't mandatory, but
 *              can prevent any number of errors, including fatal errors, in
 *              situations where your extension is activated but EDD is not
 *              present.
 */
function wpematicohk_load() {
	if (!class_exists('WPeMatico')) {
		if (!class_exists('WPeMatico_Extension_Activation')) {
			require_once 'includes/class.extension-activation.php';
		}

		$activation = new WPeMatico_Extension_Activation(plugin_dir_path(__FILE__), basename(__FILE__));
		$activation = $activation->run();
		deactivate_plugins(plugin_basename(__FILE__));
		return;
	}

	// Core is present but too old for this addon. Warn and stay out of the way: the hooks screen
	// and the eval engine both assume APIs that older cores do not have.
	if (defined('WPEMATICO_VERSION') && version_compare(WPEMATICO_VERSION, WPEMATICOHK_REQ_WPEMATICO, '<')) {
		add_action('admin_notices', 'wpematicohk_outdated_core_notice');
		return;
	}

	return wpematicohk::instance();
}

/**
 * Notice shown when the installed WPeMatico core is older than this addon requires.
 */
function wpematicohk_outdated_core_notice() {
	if (!current_user_can('activate_plugins')) {
		return;
	}
	printf(
			'<div class="notice notice-error"><p>%s</p></div>',
			sprintf(
					/* translators: 1: required WPeMatico version, 2: installed WPeMatico version */
					esc_html__('WPeMatico Custom Hooks needs WPeMatico %1$s or newer to run. You have %2$s installed, so the Hooks screen is disabled until you update.', 'wpematico-custom-hooks'),
					esc_html(WPEMATICOHK_REQ_WPEMATICO),
					esc_html(WPEMATICO_VERSION)
			)
	);
}

add_action('plugins_loaded', 'wpematicohk_load', 999);

/**
 * The activation hook is called outside of the singleton because WordPress doesn't
 * register the call from within the class, since we are preferring the plugins_loaded
 * hook for compatibility, we also can't reference a function inside the plugin class
 * for the activation function. If you need an activation function, put it here.
 *
 * @since       1.0.0
 * @return      void
 */
function wpematicohk_activation() {
	/* Activation functions here */
}

register_activation_hook(__FILE__, 'wpematicohk_activation');
