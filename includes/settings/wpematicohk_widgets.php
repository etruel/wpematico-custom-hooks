<?php
/**
 * The sidebar of the Hooks tab on WPeMatico 2.9 and newer.
 *
 * The legacy layout printed these boxes in a sidebar of its own. 2.9 provides the
 * sidebar, so they are registered into it instead.
 *
 * @package WPeMatico Custom Hooks
 */
if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

if (!class_exists('wpematico_hooks_widgets')) :

	class wpematico_hooks_widgets {

		public static function hooks() {
			// The registry belongs to 2.9; the legacy screen keeps its own sidebar.
			if (!function_exists('wpematicohk_core_is_29') || !wpematicohk_core_is_29()) {
				return;
			}
			add_filter('wpematico_settings_widgets_wpematico_hooks', array(__CLASS__, 'widgets'), 10, 2);
			add_filter('wpematico_settings_about_memberships', array(__CLASS__, 'hide_memberships_buttons'), 10, 2);
		}

		/**
		 * @param array  $widgets
		 * @param string $section
		 * @return array
		 */
		public static function widgets($widgets, $section = '') {
			$widgets['hooks_about'] = array('callback' => array(__CLASS__, 'about'), 'priority' => 0);

			// About the plugin as a whole, and they belong on the tabs that are.
			unset($widgets['support'], $widgets['translate'], $widgets['wp_ratings']);

			// One offer, picked by what the site already has.
			if (function_exists('wpematico_is_pro_active') && wpematico_is_pro_active(true)) {
				unset($widgets['memberships']);
			} else {
				unset($widgets['promoperfect']);
			}

			return $widgets;
		}

		/**
		 * @param bool   $show
		 * @param string $tab
		 * @return bool
		 */
		public static function hide_memberships_buttons($show, $tab = '') {
			return ('wpematico_hooks' === $tab) ? false : $show;
		}

		public static function about() {
			$reviews_url = 'https://wordpress.org/support/plugin/wpematico-custom-hooks/reviews?filter=5&rate=5#new-post';
			$plugin_url	 = 'https://wordpress.org/plugins/wpematico-custom-hooks/';
			$support_url = 'https://etruel.com/my-account/support/';
			?>
			<div id="wpemhk-about" class="postbox wpemhk-about">
				<div class="wpemhk-about-header">
					<span class="wpemhk-about-mark" aria-hidden="true">?&gt;</span>
					<div class="wpemhk-about-name">
						<strong>WPeMatico</strong>
						<span><?php esc_html_e('Custom Hooks', 'wpematico-custom-hooks'); ?></span>
					</div>
					<span class="wpemhk-about-version">v<?php echo esc_html(WPEMATICOHK_VER); ?></span>
				</div>
				<div class="inside">
					<p class="wpemhk-about-intro">
						<?php esc_html_e('Write PHP for any of the hooks WPeMatico fires, straight from here. The code is checked before it is saved, so a typo cannot take the site down.', 'wpematico-custom-hooks'); ?>
					</p>
					<ul class="wpemhk-about-links">
						<li>
							<a href="<?php echo esc_url($plugin_url); ?>" target="_blank" rel="noopener">
								<span class="dashicons dashicons-wordpress" aria-hidden="true"></span>
								<?php esc_html_e('Plugin page on WordPress.org', 'wpematico-custom-hooks'); ?>
							</a>
						</li>
						<li>
							<a href="<?php echo esc_url($support_url); ?>" target="_blank" rel="noopener">
								<span class="dashicons dashicons-sos" aria-hidden="true"></span>
								<?php esc_html_e('Support', 'wpematico-custom-hooks'); ?>
							</a>
						</li>
						<li>
							<a href="<?php echo esc_url($reviews_url); ?>" target="_blank" rel="noopener">
								<span class="dashicons dashicons-star-filled" aria-hidden="true"></span>
								<?php esc_html_e('Write a 5 star review', 'wpematico-custom-hooks'); ?>
							</a>
						</li>
					</ul>
					<p class="wpemhk-about-req">
						<?php printf(
								/* translators: %s: minimum WPeMatico version. */
								esc_html__('Needs WPeMatico %s or newer.', 'wpematico-custom-hooks'),
								esc_html(WPEMATICOHK_REQ_WPEMATICO)
						); ?>
					</p>
				</div>
			</div>
			<?php
		}
	}

endif;

wpematico_hooks_widgets::hooks();
