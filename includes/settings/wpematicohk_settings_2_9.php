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

<div class="meta-box-sortables ui-sortable">
	<?php
	// Single column: the 2.9 settings screen provides the navigation sidebar itself, so the
	// $printmb placement dance of the legacy layout does not apply here.
	wpematico_hooks_settings::selects_metabox();
	wpematico_hooks_settings::hook_boxes($wpematicohk_options_admin);
	wpematico_hooks_settings::about_box();
	wpematico_hooks_settings::donate_box();
	?>
</div>
