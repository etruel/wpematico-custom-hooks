<?php

if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

/**
 * Whether the running WPeMatico core is 2.9 or newer.
 *
 * 2.9 moved the admin menu under the top level wpematico_dashboard page and wrapped every
 * settings tab in its own <form>, so the screen has to be rendered differently.
 *
 * Always version_compare(): a string comparison reports '2.10' as lower than '2.9'.
 *
 * @return bool
 */
function wpematicohk_core_is_29() {
	return defined('WPEMATICO_VERSION') && version_compare(WPEMATICO_VERSION, '2.9', '>=');
}

/**
 * URL of the WPeMatico settings screen for the running core.
 *
 * @param string $tab Tab to open. Empty for the settings landing page.
 * @return string
 */
function wpematicohk_settings_url($tab = 'wpematico_hooks') {
	$page = wpematicohk_core_is_29() ? 'admin.php?page=wpematico_settings' : 'edit.php?post_type=wpematico&page=wpematico_settings';
	if (!empty($tab)) {
		$page .= '&tab=' . rawurlencode($tab);
	}
	return admin_url($page);
}

add_action('admin_init', 'wpematicohk_admin_init');

function wpematicohk_admin_init() {
	add_filter('plugin_row_meta', 'wpematicohk_init_row_meta', 10, 2);
	add_filter('plugin_action_links_' . plugin_basename(WPEMATICOHK_ROOT_FILE), 'wpematicohk_init_action_links');
}

/** * Deactivate WPeMatico Custom Hooks on Deactivate Plugin  */
register_deactivation_hook(plugin_basename(WPEMATICOHK_ROOT_FILE), 'wpematicohk_deactivate');

function wpematicohk_deactivate() {
	if (class_exists('WPeMatico')) {
		$notice = __('WPeMatico Custom Hooks DEACTIVATED.', 'wpematico-custom-hooks');
		WPeMatico::add_wp_notice(array('text' => $notice, 'below-h2' => false));
	}
}

/*
  register_uninstall_hook( plugin_basename( __FILE__ ), 'wpematicohk_uninstall' );
  function wpematicohk_uninstall() {

  }
 */

/**
 * Actions-Links del Plugin
 *
 * @param   array   $data  Original Links
 * @return  array   $data  modified Links
 */
function wpematicohk_init_action_links($data) {
	if (!current_user_can('manage_options')) {
		return $data;
	}
	return array_merge(
			$data,
			array(
				'<a href="' . esc_url(wpematicohk_settings_url()) . '" title="' . esc_attr__('Go to WPeMatico Custom Hooks Settings Page', 'wpematico-custom-hooks') . '">' . esc_html__('Settings', 'wpematico-custom-hooks') . '</a>',
			)
	);
}

/**
 * Meta-Links del Plugin
 *
 * @param   array   $data  Original Links
 * @param   string  $page  plugin actual
 * @return  array   $data  modified Links
 */
function wpematicohk_init_row_meta($data, $page) {
	if (basename($page) != 'wpematico_custom-hooks.php') {
		return $data;
	}
	return array_merge(
			$data,
			array(
				'<a href="https://etruel.com/" target="_blank">' . __('etruel Store') . '</a>',
				'<a href="https://etruel.com/my-account/support/" target="_blank">' . __('Support') . '</a>',
				'<a href="https://wordpress.org/support/view/plugin-reviews/wpematico?filter=5&rate=5#postform" target="_Blank" title="Rate 5 stars on Wordpress.org">' . __('Rate Plugin') . '</a>'
			)
	);
}
