<?php

if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

if (!class_exists('wpehk_filter_and_actions')) :

	/**
	 * Attaches the administrator's saved snippets to their WPeMatico hooks.
	 *
	 * This runs on every request, front end included, so it stays as cheap as it can: it reads a
	 * single option and never loads the hooks catalogue unless a stored row is missing its
	 * parameter count.
	 *
	 * @since 1.0.1
	 */
	class wpehk_filter_and_actions {

		/**
		 * Problems found while attaching, reported to the administrator after init.
		 * Kept as structured data because this class runs on plugins_loaded, where translating
		 * would trigger WP 6.7's _load_textdomain_just_in_time notice.
		 *
		 * @var array
		 */
		protected static $problems = array();

		/**
		 * Static function execute
		 * @access public
		 * @return void
		 * @since 1.0.1
		 */
		public static function execute() {
			if (!self::is_executable()) {
				return;
			}

			$options = get_option('wpematicohk_datahooks');
			if (!is_array($options) || empty($options['wpematicohk_options_action_filters']) || !is_array($options['wpematicohk_options_action_filters'])) {
				return;
			}

			$codes		= self::column($options, 'wpematicohk_options_functions');
			$callbacks	= self::column($options, 'wpematicohk_functions_action_filter');
			$types		= self::column($options, 'wpematicohk_type_hook');
			$parameters = self::column($options, 'wpematicohk_functions_parameters');

			// The five arrays are positional and nothing keeps them the same length, so every
			// read by index is guarded.
			foreach ($options['wpematicohk_options_action_filters'] as $i => $hook) {
				if (empty($hook) || !is_string($hook) || empty($codes[$i]) || !is_string($codes[$i])) {
					continue;
				}

				$code = wp_unslash($codes[$i]);
				if ('' === trim($code)) {
					continue;
				}

				$names = isset($callbacks[$i]) ? array_filter(array_map('trim', explode(',', (string) $callbacks[$i]))) : array();
				if (empty($names)) {
					continue;
				}

				$already = array();
				foreach ($names as $name) {
					if (function_exists($name)) {
						$already[] = $name;
					}
				}

				if (empty($already)) {
					try {
						eval($code);
					} catch (\Throwable $e) {
						self::$problems[] = array('type' => 'error', 'hook' => $hook, 'detail' => $e->getMessage());
						continue;
					}
				} elseif (count($already) !== count($names)) {
					// Part of the snippet is already declared elsewhere. Evaluating it would raise
					// "Cannot redeclare", which is an uncatchable fatal in PHP 8 and would take the
					// whole site down, front end included. Skip and tell the administrator. (issue #8)
					self::$problems[] = array('type' => 'duplicate', 'hook' => $hook, 'detail' => implode(', ', $already));
					continue;
				}

				$accepted  = self::accepted_args($hook, isset($parameters[$i]) ? $parameters[$i] : null);
				$is_filter = (isset($types[$i]) && 'filter' === $types[$i]);

				foreach ($names as $name) {
					// The snippet may not have declared what the editor scraped out of it.
					if (!function_exists($name)) {
						self::$problems[] = array('type' => 'missing', 'hook' => $hook, 'detail' => $name);
						continue;
					}
					if ($is_filter) {
						add_filter($hook, $name, 10, $accepted);
					} else {
						add_action($hook, $name, 10, $accepted);
					}
				}
			}

			if (!empty(self::$problems) && is_admin()) {
				add_action('admin_notices', array(__CLASS__, 'print_problems'));
			}
		}

		/**
		 * Whether the saved snippets should be attached on this request.
		 *
		 * The Hooks screen and its endpoints are deliberately excluded so that broken saved code
		 * cannot lock the administrator out of the only screen where it can be fixed.
		 *
		 * @return bool
		 */
		protected static function is_executable() {
			// Nothing is ever skipped outside the admin. The presence of a "tab" in the query
			// string used to be enough on its own, and that is not a screen: any visitor could
			// append ?tab=1 to any front end URL and every saved hook stopped running for that
			// request, whatever the administrator had written it to do.
			if (!is_admin()) {
				return true;
			}

			$action = (isset($_REQUEST['action']) && is_string($_REQUEST['action'])) ? $_REQUEST['action'] : '';
			if ('wpematicohk_sintax' === $action || 'wpematicohk_options' === $action) {
				return false;
			}

			// This plugin's own screen, so saved code that misbehaves cannot lock the
			// administrator out of the only place where it can be fixed. Both core lines put the
			// screen at the same page and tab, only the file they hang off differs.
			$page = (isset($_REQUEST['page']) && is_string($_REQUEST['page'])) ? $_REQUEST['page'] : '';
			$tab  = (isset($_REQUEST['tab']) && is_string($_REQUEST['tab'])) ? $_REQUEST['tab'] : '';

			return !('wpematico_settings' === $page && 'wpematico_hooks' === $tab);
		}

		/**
		 * One of the positional arrays of the option, normalised to an array.
		 *
		 * @param  array  $options Stored option.
		 * @param  string $key     Array to read.
		 * @return array
		 */
		protected static function column($options, $key) {
			return (isset($options[$key]) && is_array($options[$key])) ? $options[$key] : array();
		}

		/**
		 * Accepted argument count for a hook.
		 *
		 * Uses the value stored with the row, and only falls back to the catalogue when that value
		 * is missing or unusable — loading the catalogue means 92 translated strings on a request
		 * that has no reason to pay for them.
		 *
		 * @param  string $hook   Hook name.
		 * @param  mixed  $stored Value saved alongside the row.
		 * @return int
		 */
		protected static function accepted_args($hook, $stored) {
			if (is_numeric($stored) && (int) $stored >= 0) {
				return (int) $stored;
			}
			return self::catalogue_parameters($hook);
		}

		/**
		 * Parameter count declared for a hook in the catalogue.
		 *
		 * @param  string $hook Hook name.
		 * @return int
		 */
		protected static function catalogue_parameters($hook) {
			static $map = null;

			if (null === $map) {
				$map							= array();
				$wpematicohk_data_filter_action = array();
				include WPEMATICOHK_DIR . 'includes/data_load/wpematicohk_array_hooks.php';
				foreach ((array) $wpematicohk_data_filter_action as $entry) {
					if (isset($entry['value'], $entry['parameters'])) {
						$map[$entry['value']] = (int) $entry['parameters'];
					}
				}
			}

			return isset($map[$hook]) ? $map[$hook] : 1;
		}

		/**
		 * Reports what could not be attached, with a link to the screen where it is fixed.
		 *
		 * @return void
		 */
		public static function print_problems() {
			if (!current_user_can('edit_plugins') && !current_user_can('edit_themes')) {
				return;
			}

			foreach (self::$problems as $problem) {
				switch ($problem['type']) {
					case 'duplicate':
						$message = sprintf(
								/* translators: 1: hook name, 2: comma separated function names */
								__('WPeMatico Custom Hooks skipped the code for %1$s: the function %2$s is already declared somewhere else. Rename it, or remove it from one of the two hooks.', 'wpematico-custom-hooks'),
								'<code>' . esc_html($problem['hook']) . '</code>',
								'<code>' . esc_html($problem['detail']) . '</code>'
						);
						break;

					case 'missing':
						$message = sprintf(
								/* translators: 1: function name, 2: hook name */
								__('WPeMatico Custom Hooks could not attach %1$s to %2$s: the code saved for that hook does not declare it.', 'wpematico-custom-hooks'),
								'<code>' . esc_html($problem['detail']) . '</code>',
								'<code>' . esc_html($problem['hook']) . '</code>'
						);
						break;

					default:
						$message = sprintf(
								/* translators: 1: hook name, 2: PHP error message */
								__('WPeMatico Custom Hooks could not run the code saved for %1$s: %2$s', 'wpematico-custom-hooks'),
								'<code>' . esc_html($problem['hook']) . '</code>',
								esc_html($problem['detail'])
						);
				}

				printf(
						'<div class="notice notice-error"><p>%s <a href="%s">%s</a></p></div>',
						wp_kses_post($message),
						esc_url(wpematicohk_settings_url()),
						esc_html__('Edit hooks', 'wpematico-custom-hooks')
				);
			}
		}

	}

	endif;

wpehk_filter_and_actions::execute();
