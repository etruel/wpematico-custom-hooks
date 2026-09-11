<?php
/**
 *  @package WPeMatico Custom Hooks
 * 	functions to add a tab with custom options in wpematico settings
 * */
if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

if (!class_exists('wpematico_hooks_settings')) :

	class wpematico_hooks_settings {

		/**
		 * Static function hooks
		 * @access public
		 * @return void
		 * @since 1.0.1
		 */
		public static function hooks() {
			add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_scripts'), 999);
			add_action('admin_post_wpematicohk_options', array(__CLASS__, 'options_callback'));
			add_filter('wpematico_settings_tabs', array(__CLASS__, 'tabs'), 10, 1);
			add_filter('wpematico_settings_icons', array(__CLASS__, 'settings_icon'));
			add_action('current_screen', array(__CLASS__, 'help_tabs'));
			add_action('wpematico_settings_tab_wpematico_hooks', array(__CLASS__, 'page'));
		}

		/**
		 * Whether the screen being rendered is our tab.
		 *
		 * The screen id is the same on both core lines: 2.9 moved the settings page under the top
		 * level wpematico_dashboard menu, but WP builds the hookname from the parent menu's title,
		 * which is still "WPeMatico".
		 *
		 * @return bool
		 */
		protected static function is_hooks_screen() {
			$screen = get_current_screen();
			if (!$screen || 'wpematico_page_wpematico_settings' !== $screen->id) {
				return false;
			}
			return (isset($_GET['tab']) && 'wpematico_hooks' === $_GET['tab']);
		}

		public static function enqueue_scripts() {
			if (!self::is_hooks_screen()) {
				return;
			}

			$wpematicohk_theme_editor = get_option('wpematicohk_theme_editor');
			if (empty($wpematicohk_theme_editor)) {
				$wpematicohk_theme_editor = 'monokai';
			}

			global $wp_version;

			// WordPress convention: the readable file while SCRIPT_DEBUG is on, the
			// minified one otherwise. Keep both in step when either changes.
			$min = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

			//Style
			wp_enqueue_style('wpematicohk-settings-styles', WPEMATICOHK_URL . 'assets/css/wpehk_settings' . $min . '.css', array(), WPEMATICOHK_VER);
			if ($wp_version < 4.9) {
				wp_enqueue_style('wpematicohk-codemirror_style', WPEMATICOHK_URL . 'assets/codemirror/css/codemirror' . $min . '.css', array(), WPEMATICOHK_VER);
			}
			wp_enqueue_style('wpematicohk-monokai', WPEMATICOHK_URL . 'assets/codemirror/css/monokai' . $min . '.css', array(), WPEMATICOHK_VER);
			wp_enqueue_style('wpematicohk-colbat', WPEMATICOHK_URL . 'assets/codemirror/css/colbat' . $min . '.css', array(), WPEMATICOHK_VER);
			wp_enqueue_style('wpematicohk-blackboard', WPEMATICOHK_URL . 'assets/codemirror/css/blackboard' . $min . '.css', array(), WPEMATICOHK_VER);
			//Scripts
			if ($wp_version < 4.9) {
				wp_enqueue_script('wpematicohk-mirrorcode', WPEMATICOHK_URL . 'assets/codemirror/js/codemirror.js', array('jquery'), WPEMATICOHK_VER, true);
				wp_enqueue_script('wpematicohk-javascript', WPEMATICOHK_URL . 'assets/codemirror/js/javascript.js', array('wpematicohk-mirrorcode'), WPEMATICOHK_VER, true);
				wp_enqueue_script('wpematicohk-xml', WPEMATICOHK_URL . 'assets/codemirror/js/xml.js', array('wpematicohk-mirrorcode'), WPEMATICOHK_VER, true);
				wp_enqueue_script('wpematicohk-php', WPEMATICOHK_URL . 'assets/codemirror/js/php.js', array('wpematicohk-mirrorcode'), WPEMATICOHK_VER, true);
				//we import the clike file because the documentation recommends it, but apparently it does not require it, link post https://codemirror.net/mode/php/
				//wp_enqueue_script('wpematicohk-clike', WPEMATICOHK_URL . 'assets/codemirror/js/clike.js', array('wpematicohk-mirrorcode'), WPEMATICOHK_VER, true);
				wp_enqueue_script('wpematicohk-htmlmixed', WPEMATICOHK_URL . 'assets/codemirror/js/htmlmixed.js', array('wpematicohk-mirrorcode', 'wpematicohk-xml', 'wpematicohk-php'), WPEMATICOHK_VER, true);
				wp_enqueue_script('wpematicohk-settings', WPEMATICOHK_URL . 'assets/js/wpehk_settings.js', array('wpematicohk-mirrorcode', 'wpematicohk-xml', 'wpematicohk-php'), WPEMATICOHK_VER, true);
			} else {
				wp_enqueue_script('wpematicohk-settings', WPEMATICOHK_URL . 'assets/js/wpehk_settings.js', array('jquery'), WPEMATICOHK_VER, true);
				wp_enqueue_code_editor(
						array(
							'type' => 'text/x-php', //previously 'text / html'
							'codemirror' => array(
								'theme' => $wpematicohk_theme_editor,
							),
				));
				wp_add_inline_script('wpematicohk-settings', 'var wpversion=true; ');
			}
			wp_localize_script('wpematicohk-settings', 'wpematicohk_object',
					array(
						'theme_editor' => $wpematicohk_theme_editor,
						'nonce' => wp_create_nonce('wpematicohk_nonce'),
						// On core 2.9 the tab is rendered inside core's own form, so there is no
						// form of ours to submit. See includes/settings/wpematicohk_settings_2_9.php
						'form_selector' => wpematicohk_core_is_29() ? '#wpematico-settings-form' : '#wpematicohk_form',
						'text_checking_syntax' => __('Checking syntax errors...', 'wpematico-custom-hooks'),
						'text_no_error_syntax' => __('No syntax errors found', 'wpematico-custom-hooks'),
						'text_generic_error' => __('The syntax check could not be completed. Please try again.', 'wpematico-custom-hooks'),
						'text_in_hook' => __('In hook:', 'wpematico-custom-hooks'),
					)
			);
		}

		/**
		 * A repeated form field, re-indexed from zero.
		 *
		 * @param  string $key Field name.
		 * @return array
		 */
		protected static function posted_array($key) {
			if (empty($_POST[$key]) || !is_array($_POST[$key])) {
				return array();
			}
			return array_values($_POST[$key]);
		}

		/**
		 * Static function options_callback
		 * @access public
		 * @return void
		 * @since 1.0.1
		 */
		public static function options_callback() {
			if (current_user_can('edit_plugins') || current_user_can('edit_themes')) {
				check_admin_referer('wpematicohk_admin_nonce');

				$posted_hooks	   = self::posted_array('wpematicohk_options_action_filters');
				$posted_parameters = self::posted_array('wpematicohk_functions_parameters');
				$posted_callbacks  = self::posted_array('wpematicohk_functions_action_filter');
				$posted_code	   = self::posted_array('wpematicohk_options_functions');
				$posted_types	   = self::posted_array('wpematicohk_type_hook');

				$wpematico_hooks	  = array();
				$functions_parameters = array();
				$action_filters		  = array();
				$options_functions	  = array();
				$type_hook			  = array();

				// Built row by row so the five stored arrays cannot come out of step: they are read
				// back positionally, and every bug reported against this option so far came from
				// one of them being shorter than the others.
				foreach ($posted_hooks as $i => $hook) {
					$code = isset($posted_code[$i]) ? wp_unslash($posted_code[$i]) : '';
					if (!is_string($code)) {
						$code = '';
					}

					// The callback names posted by the editor come from scraping the CodeMirror
					// lines for the word "function", which misses indented or otherwise unusual
					// declarations. Read them off the token stream instead, and fall back to the
					// scraped value only when the code declares nothing we can see.
					$names	   = class_exists('wpematicohk_sintax') ? wpematicohk_sintax::declared_functions($code) : array();
					$callbacks = !empty($names) ? implode(',', $names) : (isset($posted_callbacks[$i]) ? sanitize_text_field($posted_callbacks[$i]) : '');

					$wpematico_hooks[]		= sanitize_text_field($hook);
					$functions_parameters[] = isset($posted_parameters[$i]) ? intval($posted_parameters[$i]) : 0;
					$action_filters[]		= $callbacks;
					$options_functions[]	= $code;
					$type_hook[]			= isset($posted_types[$i]) ? sanitize_text_field($posted_types[$i]) : '';
				}

				$wpematicohk_options = array(
					'wpematicohk_options_action_filters' => $wpematico_hooks,
					'wpematicohk_functions_parameters' => $functions_parameters,
					'wpematicohk_functions_action_filter' => $action_filters,
					'wpematicohk_options_functions' => $options_functions,
					'wpematicohk_type_hook' => $type_hook
				);
				update_option('wpematicohk_datahooks', $wpematicohk_options);
				// Read with isset(): on PHP 8 an @-suppressed or undefined index still lands in
				// error_get_last(), which makes WP paint the php-error gap above the admin menu.
				$theme_editor = isset($_POST['wpematicohk_theme_editor']) ? sanitize_text_field($_POST['wpematicohk_theme_editor']) : 'monokai';
				update_option('wpematicohk_theme_editor', $theme_editor);
				wp_safe_redirect(wpematicohk_settings_url());
				exit;
			} else {
				wp_die(__('Security check.', 'wpematico-custom-hooks'));
			}
		}

		/**
		 * Static function tabs
		 * @access public
		 * @return void
		 * @since 1.0.1
		 */
		/**
		 * The Help tabs of this screen.
		 *
		 * On current_screen, against the screen being rendered -- never a WP_Screen::get()
		 * of a hardcoded id, and without asking for a post_type the 2.9 menu no longer puts
		 * in the URL.
		 *
		 * @param WP_Screen $screen
		 * @return void
		 */
		public static function help_tabs($screen = null) {
			if (!is_object($screen) || !method_exists($screen, 'add_help_tab')) {
				return;
			}
			if (!isset($_GET['page']) || 'wpematico_settings' !== $_GET['page']) {
				return;
			}
			if (!isset($_GET['tab']) || 'wpematico_hooks' !== $_GET['tab']) {
				return;
			}

			$screen->add_help_tab(array(
				'id'	  => 'wpematicohk_overview',
				'title'	  => __('Overview', 'wpematico-custom-hooks'),
				'content' =>
					'<h3>' . __('What this does', 'wpematico-custom-hooks') . '</h3>'
					. '<p>' . __('WPeMatico announces every step of its work through hooks: it is about to read an item, it has built a title, it is ready to insert a post. This plugin lets you write PHP that runs at those moments, without a child theme and without an FTP client.', 'wpematico-custom-hooks') . '</p>'
					. '<p>' . __('Pick a hook, press <strong>Add Functions</strong>, and an editor opens with the function signature already written. Fill in the body and save.', 'wpematico-custom-hooks') . '</p>'
					. '<p><em>' . __('Only users who may edit plugins or themes can reach this screen: the code written here runs with the rights of the site itself.', 'wpematico-custom-hooks') . '</em></p>',
			));

			$screen->add_help_tab(array(
				'id'	  => 'wpematicohk_writing',
				'title'	  => __('Writing the code', 'wpematico-custom-hooks'),
				'content' =>
					'<h3>' . __('What goes in the editor', 'wpematico-custom-hooks') . '</h3>'
					. '<p>' . __('The function body, and the function itself &mdash; the signature the editor writes for you already carries the parameters that hook receives, in the right order. Do not rename it: that name is what gets attached to the hook.', 'wpematico-custom-hooks') . '</p>'
					. '<p><b>' . __('Filters must return something', 'wpematico-custom-hooks') . '</b> &mdash; '
					. __('a filter is asked for a value and whatever it answers replaces the original. A filter that returns nothing empties the thing it was filtering. Actions return nothing and are just told that something happened.', 'wpematico-custom-hooks') . '</p>'
					. '<p><b>' . __('The badge next to each hook says which it is', 'wpematico-custom-hooks') . '</b> &mdash; '
					. __('<em>filter</em> or <em>action</em>, so you can tell at a glance whether a return is expected.', 'wpematico-custom-hooks') . '</p>'
					. '<p><b>' . __('The code is checked before it is saved', 'wpematico-custom-hooks') . '</b> &mdash; '
					. __('a syntax error is reported with its line and reason and nothing is stored, so a typo cannot leave the site unable to load. The check runs in place and needs no connection back to your own server, which is what makes it work on managed and firewalled hosting.', 'wpematico-custom-hooks') . '</p>'
					. '<p><b>' . __('One function per hook', 'wpematico-custom-hooks') . '</b> &mdash; '
					. __('each entry declares its own function, so two entries must not declare functions of the same name. PHP cannot recover from that.', 'wpematico-custom-hooks') . '</p>',
			));

			$screen->add_help_tab(array(
				'id'	  => 'wpematicohk_editor',
				'title'	  => __('The editor', 'wpematico-custom-hooks'),
				'content' =>
					'<h3>' . __('Working in the editor', 'wpematico-custom-hooks') . '</h3>'
					. '<p>' . __('It is the same code editor WordPress uses for its own file editors, with PHP highlighting, bracket matching and line numbers.', 'wpematico-custom-hooks') . '</p>'
					. '<p><b>' . __('Colour scheme', 'wpematico-custom-hooks') . '</b> &mdash; '
					. __('Monokai, Blackboard or Cobalt. It changes nothing but how the editor looks, and it is remembered for you alone.', 'wpematico-custom-hooks') . '</p>'
					. '<p><b>' . __('The hook filter above the list', 'wpematico-custom-hooks') . '</b> &mdash; '
					. __('narrows the long list to one hook while you work, so you are not scrolling past the ones you are not using. It does not delete or disable anything.', 'wpematico-custom-hooks') . '</p>'
					. '<p><b>' . __('Saving', 'wpematico-custom-hooks') . '</b> &mdash; '
					. __('either button on this screen saves the whole tab, and both run the check first.', 'wpematico-custom-hooks') . '</p>',
			));
		}

		/**
		 * A tab with no icon of its own falls back to the generic settings one.
		 *
		 * @param array $icons
		 * @return array
		 */
		public static function settings_icon($icons) {
			// The add-on's own mark, which no dashicon draws. Never write that mark in a
			// // comment: PHP leaves php mode there and the rest of the class is lost.
			$icons['wpematico_hooks'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">'
				. '<text x="12" y="17" text-anchor="middle" font-family="Menlo,Consolas,monospace" font-size="15" font-weight="700">?&gt;</text>'
				. '</svg>';
			return $icons;
		}

		public static function tabs($tabs) {
			if (current_user_can('edit_plugins') || current_user_can('edit_themes')) {
				$tabs['wpematico_hooks'] = __('Hooks', 'wpematico-custom-hooks');
			}
			return $tabs;
		}

		/**
		 * Hook names that currently carry code, keyed by name.
		 *
		 * @access public
		 * @param  array $options_admin Normalised stored option.
		 * @return array
		 */
		public static function used_hooks($options_admin) {
			$used = array();
			if (empty($options_admin['wpematicohk_options_action_filters']) || !is_array($options_admin['wpematicohk_options_action_filters'])) {
				return $used;
			}
			foreach ($options_admin['wpematicohk_options_action_filters'] as $idx => $hook) {
				if (!is_string($hook) || '' === $hook) {
					continue;
				}
				$code = isset($options_admin['wpematicohk_options_functions'][$idx]) ? $options_admin['wpematicohk_options_functions'][$idx] : '';
				if ('' !== trim((string) $code)) {
					$used[$hook] = true;
				}
			}
			return $used;
		}

		/**
		 * Static function
		 * @access public
		 * @param  array $options_admin Normalised stored option, to tell the hooks in use apart.
		 * @return void
		 * @since 1.0.1
		 */
		public static function selects_metabox($options_admin = array()) {
			global $wpematicohk_theme_editor, $wpematicohk_data_filter_action;

			$used	 = self::used_hooks($options_admin);
			$in_use   = array();
			$available = array();
			foreach ($wpematicohk_data_filter_action as $key_hooks) {
				if (isset($used[$key_hooks['value']])) {
					$in_use[] = $key_hooks;
				} else {
					$available[] = $key_hooks;
				}
			}
			?>
			<div class="postbox inside">
				<h3 class="handle"><?php _e('Add a hook', 'wpematico-custom-hooks'); ?></h3>
				<div class="inside">
					<p class="description"><?php _e('Pick the hook you want to run code on and press Add Functions: an editor opens below with the signature already written for you. The theme only changes how that editor looks.', 'wpematico-custom-hooks'); ?></p>

					<p><strong><?php _e('Select theme for the editor', 'wpematico-custom-hooks'); ?></strong></p>
					<select id="wpematicohk_themes_selection_editor" name="wpematicohk_theme_editor">
						<option value=""><?php _e('Colors Scheme', 'wpematico-custom-hooks'); ?></option>
						<option value="monokai" <?php selected('monokai', $wpematicohk_theme_editor, true) ?>>Monokai</option>
						<option value="blackboard" <?php selected('blackboard', $wpematicohk_theme_editor, true) ?>>Blackboard</option>
						<option value="cobalt" <?php selected('cobalt', $wpematicohk_theme_editor, true) ?>>Cobalt</option>
					</select>
					<br>
					<p><strong><?php _e('Select the hooks', 'wpematico-custom-hooks'); ?></strong></p>
					<select class="wpematicohk_select_actions_filters">
						<option value=""><?php _e('&mdash; Hooks in use &mdash;', 'wpematico-custom-hooks'); ?></option>
						<?php
						// Two groups so the list itself answers "which hooks am I already running
						// code on": picking one below reveals its editor, and only that one.
						$groups = array(
							array('label' => sprintf(__('In use (%d)', 'wpematico-custom-hooks'), count($in_use)), 'hooks' => $in_use),
							array('label' => sprintf(__('Available (%d)', 'wpematico-custom-hooks'), count($available)), 'hooks' => $available),
						);
						foreach ($groups as $group) {
							if (empty($group['hooks'])) {
								continue;
							}
							?>
							<optgroup label="<?php echo esc_attr($group['label']); ?>">
								<?php foreach ($group['hooks'] as $key_hooks) { ?>
									<option tagtypehook='<?php echo esc_attr(strtolower($key_hooks['type'])); ?>' tagtemplateparameter='<?php echo esc_attr(isset($key_hooks["template_parameter"]) ? $key_hooks["template_parameter"] : ""); ?>' tagparameters='<?php echo esc_attr($key_hooks['parameters']); ?>' value="<?php echo esc_attr($key_hooks['value']); ?>"><?php echo esc_html($key_hooks['value']); ?></option>
								<?php } ?>
							</optgroup>
						<?php } ?>
					</select>
					<p class="wpematicohk-actions">
						<input type="button"  class="button button-primary wpematicohk_button_addfunctions" value="<?php _e('Add Functions', 'wpematico-custom-hooks'); ?>">
						<?php if (!wpematicohk_core_is_29()) { ?>
							<input type="button" class="button button-primary" id="wpematicohk_save_settings" value="<?php _e('Save Data', 'wpematico-custom-hooks'); ?>">
						<?php } ?>
					</p>
				</div>
			</div>
			<?php
		}

		/**
		 * The "About" sidebar box.
		 *
		 * @access public
		 * @return void
		 */
		public static function about_box() {
			?>
			<div class="postbox inside">
				<button type="button" class="handlediv button-link" aria-expanded="true">
					<span class="screen-reader-text"><?php _e('Click to toggle', 'wpematico-custom-hooks'); ?></span>
					<span class="toggle-indicator" aria-hidden="true"></span>
				</button>
				<h3 class="handle"><?php _e('About WPeMatico Custom Hooks', 'wpematico-custom-hooks'); ?></h3>
				<div class="inside">
					<a href="https://wordpress.org/plugins/wpematico-custom-hooks/" target="_blank" title="<?php esc_attr_e('Go to the plugin page on WordPress.org', 'wpematico-custom-hooks'); ?>">
						<img style="width: 100%;" src="<?php echo esc_url(WPEMATICOHK_URL . 'assets/img/wpematico-custom-hooks-256x128.jpg'); ?>" alt="WPeMatico Custom Hooks" />
					</a><br />
					<p><b>WPeMatico Custom Hooks <?php echo esc_html(WPEMATICOHK_VER); ?></b></p>
					<p><?php _e('Thanks for test, use and enjoy this plugin.', 'wpematico-custom-hooks'); ?></p>
					<p><?php _e('If you like it and want to thank, you can write a 5 star review on Wordpress.', 'wpematico-custom-hooks'); ?></p>
					<style type="text/css">#linkrate:before { content: "\2605\2605\2605\2605\2605";font-size: 18px;}
						#linkrate { font-size: 18px;}</style>
					<p style="text-align: center;">
						<a href="https://wordpress.org/support/plugin/wpematico-custom-hooks/reviews?filter=5&rate=5#new-post" id="linkrate" class="button" target="_blank" title="<?php esc_attr_e('Click here to rate the plugin on Wordpress', 'wpematico-custom-hooks'); ?>"><?php esc_html_e('Rate', 'wpematico-custom-hooks'); ?></a>
					</p>
				</div>
			</div>
			<?php
		}

		/**
		 * The "Enjoy it" sidebar box.
		 *
		 * @access public
		 * @return void
		 */
		public static function donate_box() {
			?>
			<div class="postbox inside">
				<button type="button" class="handlediv button-link" aria-expanded="true">
					<span class="screen-reader-text"><?php _e('Click to toggle', 'wpematico-custom-hooks'); ?></span>
					<span class="toggle-indicator" aria-hidden="true"></span>
				</button>
				<h3 class="handle"><?php _e('Enjoy it', 'wpematico-custom-hooks'); ?></h3>
				<div class="inside">
					<p style="text-align: center;"><?php _e('If you enjoy it please donate few dollars', 'wpematico-custom-hooks'); ?>
						<input type="button" class="button-secondary" name="donate" value="<?php esc_attr_e('Click to Donate', 'wpematico-custom-hooks'); ?>" onclick="javascript:window.open('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=B8V39NWK3NFQU');return false;"/>
					</p>
					<p style="text-align: center;">
						<input type="button" class="button-primary" name="buypro" value="<?php esc_attr_e('WPeMatico Perfect Package', 'wpematico-custom-hooks'); ?>" onclick="javascript:window.open('https://etruel.com/downloads/wpematico-perfect/');return false;"/>
					</p>
				</div>
			</div>
			<?php
		}

		/**
		 * One collapsible editor per catalogue entry.
		 *
		 * @access public
		 * @param  array $options_admin Normalised stored option.
		 * @return void
		 */
		public static function hook_boxes($options_admin) {
			global $wpematicohk_data_filter_action;

			// ★ Look the stored code up by hook name, never by catalogue position. The catalogue
			// grows and shrinks with the active addons (see the array_search() blocks in
			// data_load/wpematicohk_array_hooks.php), so a row saved while Professional was on
			// lands at a different index once it is off. Reading positionally showed everyone's
			// code under the wrong hook, and the next save then moved it there for real.
			$stored = array();
			foreach ($options_admin['wpematicohk_options_action_filters'] as $idx => $stored_hook) {
				if (!is_string($stored_hook) || '' === $stored_hook) {
					continue;
				}
				$stored[$stored_hook] = array(
					'code'	   => isset($options_admin['wpematicohk_options_functions'][$idx]) ? $options_admin['wpematicohk_options_functions'][$idx] : '',
					'callbacks' => isset($options_admin['wpematicohk_functions_action_filter'][$idx]) ? $options_admin['wpematicohk_functions_action_filter'][$idx] : '',
					'parameters' => isset($options_admin['wpematicohk_functions_parameters'][$idx]) ? $options_admin['wpematicohk_functions_parameters'][$idx] : 0,
					'type'	   => isset($options_admin['wpematicohk_type_hook'][$idx]) ? $options_admin['wpematicohk_type_hook'][$idx] : '',
				);
			}
			$used = self::used_hooks($options_admin);
			?>
			<?php if (empty($used)) { ?>
				<div id="wpematicohk-empty-state" class="postbox wpematicohk-empty-state">
					<div class="inside">
						<p><strong><?php _e('No hook is running code yet.', 'wpematico-custom-hooks'); ?></strong></p>
						<p class="description"><?php _e('Pick a hook in the box above and press Add Functions. Its editor opens here, with the function signature already written for you.', 'wpematico-custom-hooks'); ?></p>
					</div>
				</div>
			<?php } ?>
			<div id="normal-sortables" class="meta-box-sortables ui-sortable">
				<?php foreach ($wpematicohk_data_filter_action as $key_hooks) {
					$has_code = isset($used[$key_hooks['value']]);
					?>
					<div id="<?php echo esc_attr($key_hooks['value']); ?>" class="postbox wpematicohk_dinamic_metabox wpematicohk_dinamic_chaplain<?php echo $has_code ? ' wpematicohk-has-code' : ''; ?> <?php echo esc_attr($key_hooks['value']); ?>">
						<h3 class="hndle hook-name"><span><?php echo esc_html($key_hooks["value"]); ?></span> <span class="hook-type"><?php echo esc_html(strtolower($key_hooks['type'])); ?></span><?php if ($has_code) { ?> <span class="hook-state"><?php _e('in use', 'wpematico-custom-hooks'); ?></span><?php } ?></h3>
						<div class="inside">
							<p class="hook-description"><?php echo esc_html($key_hooks["description"]); ?></p>
							<?php
							$row				   = isset($stored[$key_hooks['value']]) ? $stored[$key_hooks['value']] : array('code' => '', 'callbacks' => '');
							$content_action_filter = $row['callbacks'];
							$content_code_function = $row['code'];
							?>
							<input type="hidden" class="wpematicohk_options_action_filters" name="wpematicohk_options_action_filters[]" value="<?php echo esc_attr($key_hooks["value"]); ?>">
							<input type="hidden" class="wpematicohk_functions_parameters" name="wpematicohk_functions_parameters[]" value="<?php echo esc_attr(isset($key_hooks["parameters"]) ? $key_hooks["parameters"] : 0); ?>">
							<input type="hidden" name="wpematicohk_functions_action_filter[]" class='wpematicohk_functions_action_filter wpematicohk_codemirror_<?php echo esc_attr($key_hooks["value"]); ?>' value="<?php echo esc_attr($content_action_filter); ?>">
							<input type="hidden" name="wpematicohk_type_hook[]" value="<?php echo esc_attr($key_hooks["type"]); ?>">

							<textarea name="wpematicohk_options_functions[]" class="wpematico-textarea-codemirror" id="wpematicohk_codemirror_<?php echo esc_attr($key_hooks["value"]); ?>"><?php echo esc_textarea($content_code_function); ?></textarea>
						</div>
					</div>
					<?php
					unset($stored[$key_hooks['value']]);
				} ?>
			</div>
			<?php
			// Whatever is left belongs to a hook the catalogue no longer offers — usually because
			// the addon that owns it is deactivated right now. Carry it through the form untouched
			// so saving this screen does not silently delete code the user cannot even see.
			foreach ($stored as $orphan_hook => $row) {
				if ('' === trim((string) $row['code'])) {
					continue;
				}
				?>
				<input type="hidden" name="wpematicohk_options_action_filters[]" value="<?php echo esc_attr($orphan_hook); ?>">
				<input type="hidden" name="wpematicohk_functions_parameters[]" value="<?php echo esc_attr($row['parameters']); ?>">
				<input type="hidden" name="wpematicohk_functions_action_filter[]" value="<?php echo esc_attr($row['callbacks']); ?>">
				<input type="hidden" name="wpematicohk_type_hook[]" value="<?php echo esc_attr($row['type']); ?>">
				<textarea name="wpematicohk_options_functions[]" style="display:none;"><?php echo esc_textarea($row['code']); ?></textarea>
				<?php
			}
		}

		/**
		 * Display the settings page for Custom Hooks.
		 * Called via wpematico_settings_tab_wpematico_hooks action.
		 *
		 * @access public
		 * @since 1.0.1
		 * @return void
		 */
		public static function page() {
			global $wpematicohk_theme_editor, $wpematicohk_data_filter_action;

			// Check user capabilities
			if (!current_user_can('edit_plugins') && !current_user_can('edit_themes')) {
				wp_die(__('Security check.', 'wpematico-custom-hooks'));
			}

			// Define default options structure
			$default_options = array(
				'wpematicohk_options_action_filters' => array(),
				'wpematicohk_functions_parameters'   => array(),
				'wpematicohk_functions_action_filter' => array(),
				'wpematicohk_options_functions'      => array(),
				'wpematicohk_type_hook'              => array()
			);

			// The option is false until the first save, which is what issues #9 and #11 were.
			$wpematicohk_options_admin = get_option('wpematicohk_datahooks', $default_options);

			if (!is_array($wpematicohk_options_admin)) {
				$wpematicohk_options_admin = $default_options;
			}

			// Ensure each expected key exists and is an array
			foreach ($default_options as $key => $val) {
				if (!isset($wpematicohk_options_admin[$key]) || !is_array($wpematicohk_options_admin[$key])) {
					$wpematicohk_options_admin[$key] = array();
				}
			}

			// Load the hooks list (must be before using $wpematicohk_data_filter_action)
			include("data_load/wpematicohk_array_hooks.php");
			if (!isset($wpematicohk_data_filter_action) || !is_array($wpematicohk_data_filter_action)) {
				$wpematicohk_data_filter_action = array();
			}

			// Editor theme setting
			$wpematicohk_theme_editor = get_option('wpematicohk_theme_editor', 'monokai');

			// Determine if we have any stored function code (to decide sidebar placement)
			$printmb = false;
			foreach ($wpematicohk_options_admin['wpematicohk_options_functions'] as $func) {
				if (!empty($func)) {
					$printmb = true;
					break;
				}
			}

			// The screen chrome differs per core line: 2.9 renders the tab inside its own <form>
			// and has already opened #poststuff, so it cannot be reused for 2.8.
			if (wpematicohk_core_is_29()) {
				include WPEMATICOHK_DIR . 'includes/settings/wpematicohk_settings_2_9.php';
			} else {
				include WPEMATICOHK_DIR . 'includes/settings/wpematicohk_settings_legacy.php';
			}
		}

	}

	endif;
wpematico_hooks_settings::hooks();
