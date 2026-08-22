<?php
/**
 * Hooks screen chrome for WPeMatico core older than 2.9.
 *
 * That core renders the tab inside a plain <div class="metabox-holder">, so the screen owns its
 * own <form> and its own two column layout.
 *
 * Included from wpematico_hooks_settings::page(). In scope: $wpematicohk_options_admin, $printmb,
 * and the $wpematicohk_data_filter_action / $wpematicohk_theme_editor globals.
 *
 * @package WPeMatico Custom Hooks
 */
if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}
?>
<div id="wpematicohk_sintax_error"></div>

<form method="POST" id="wpematicohk_form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
	<input type="hidden" name="action" value="wpematicohk_options">
	<?php wp_nonce_field('wpematicohk_admin_nonce'); ?>

	<div class="wrap2">
		<h2><?php _e('WPeMatico Custom Hooks', 'wpematico-custom-hooks'); ?></h2>
		<div id="poststuff" class="metabox-holder has-right-sidebar">

			<div id="side-info-column" class="inner-sidebar">
				<div id="side-sortables" class="meta-box-sortables ui-sortable">
					<?php
					wpematico_hooks_settings::about_box();
					// With code already saved the selector goes to the sidebar; on an empty screen
					// it sits in the middle, where it is the only thing to interact with.
					if (true === $printmb) {
						wpematico_hooks_settings::selects_metabox();
					}
					wpematico_hooks_settings::donate_box();
					?>
				</div>
			</div>

			<div id="post-body">
				<div id="post-body-content">
					<?php
					if (false === $printmb) {
						wpematico_hooks_settings::selects_metabox();
					}
					wpematico_hooks_settings::hook_boxes($wpematicohk_options_admin);
					?>
				</div>
			</div>

		</div>
	</div>
</form>
