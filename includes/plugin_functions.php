<?php

if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
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
				'<a href="' . admin_url('edit.php?post_type=wpematico&page=wpematico_settings&tab=wpematico_hooks') . '" title="' . __('Go to WPeMatico Custom Hooks Settings Page') . '">' . __('Settings') . '</a>',
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
