<?php
/**
 * Hooks screen chrome for WPeMatico core 2.9 and newer.
 *
 * ★ No <form> here on purpose. WPeMatico_Settings::settings_header() already opened
 * <form id="wpematico-settings-form" action="admin-post.php"> and fires the tab action inside it.
 * A nested form is discarded by the browser, so the save button would post to core's form and
 * nothing would be stored — silently. Instead we emit our own hidden "action" field after core's:
 * duplicate field names mean PHP keeps the last one, so the submit reaches
 * admin_post_wpematicohk_options. This is the pattern the Professional addon established in
 * includes/settings/prosettings_2_9.php.
 *
 * ★ No #poststuff / #post-body-content either — core already opened both, and repeating them
 * duplicates element ids.
 *
 * Because core's own "Save settings" button lives in that same form, it also submits this tab.
 * That is why the syntax check is bound to the form's submit event rather than to our button.
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

<input type="hidden" name="action" value="wpematicohk_options" />
<?php wp_nonce_field('wpematicohk_admin_nonce'); ?>

<div class="meta-box-sortables ui-sortable wpe-hk-settings">

	<div id="wpematicohk-header" class="postbox">
		<button type="button" class="handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text"><?php esc_html_e('Click to toggle', 'wpematico-custom-hooks'); ?></span>
			<span class="toggle-indicator" aria-hidden="true"></span>
		</button>

		<h3 class="hndle">
			<span class="wpemhk-mark" aria-hidden="true">?&gt;</span>
			<?php esc_html_e('Custom Hooks', 'wpematico-custom-hooks'); ?>
		</h3>

		<div class="inside">
			<p class="wpe-hk-intro">
				<?php esc_html_e('Runs your own PHP on any of the hooks WPeMatico fires while a campaign works — to change a title, filter an item, add a custom field. What you write is checked before it is saved, so a mistake is reported instead of taking the site down.', 'wpematico-custom-hooks'); ?>
				<span class="wpe-hk-intro-help"><?php esc_html_e('Details in the Help tab, top right.', 'wpematico-custom-hooks'); ?></span>
			</p>
		</div>
	</div>

	<?php
	// ★ Single column, and the About / Enjoy-it boxes are not here. They are this
	// add-on's own sidebar from the legacy layout: printed in 2.9's content column they
	// stretch it past the page -- the rating button alone is 317px wide in a 280px
	// column. On 2.9 they belong in core's sidebar, registered through the widget
	// registry (see settings/wpematicohk_widgets.php).
	wpematico_hooks_settings::selects_metabox();
	wpematico_hooks_settings::hook_boxes($wpematicohk_options_admin);
	?>
</div>
