<?php
	/** 
 *  @package WPeMatico Custom Hooks
 *	functions to add a tab with custom options in wpematico settings 
	**/

if ( !defined('ABSPATH')) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if( !class_exists( 'wpematico_hooks_settings' ) ) :
class wpematico_hooks_settings {

	/**
	* Static function hooks
	* @access public
	* @return void
	* @since 1.0.1
	*/
	public static function hooks() {
		add_action( 'admin_enqueue_scripts', array(__CLASS__, 'enqueue_scripts'), 999 );
		add_action( 'admin_post_wpematicohk_options', array(__CLASS__, 'options_callback') );
		add_filter('wpematico_settings_tabs', array(__CLASS__, 'tabs'),10,1);
		add_action('wpematico_settings_tab_wpematico_hooks', array(__CLASS__, 'page'));
	}

	public static function enqueue_scripts() {
		$screen = get_current_screen();
		if(get_option('wpematicohk_theme_editor')) $wpematicohk_theme_editor = get_option('wpematicohk_theme_editor'); else $wpematicohk_theme_editor='monokai';

		global  $wp_version;

		if ($screen->id == 'wpematico_page_wpematico_settings') {
			//Style
			wp_enqueue_style( 'wpematicohk-settings-styles', WPEMATICOHK_URL.'assets/css/wpehk_settings.css');
			if($wp_version<4.9){
				wp_enqueue_style( 'wpematicohk-codemirror_style', WPEMATICOHK_URL.'assets/codemirror/css/codemirror.css');
			}
			wp_enqueue_style( 'wpematicohk-monokai', WPEMATICOHK_URL.'assets/codemirror/css/monokai.css');
			wp_enqueue_style( 'wpematicohk-colbat', WPEMATICOHK_URL.'assets/codemirror/css/colbat.css' );
			wp_enqueue_style( 'wpematicohk-blackboard', WPEMATICOHK_URL.'assets/codemirror/css/blackboard.css' );
			//Scripts
			if($wp_version<4.9){
				wp_enqueue_script( 'wpematicohk-mirrorcode', WPEMATICOHK_URL.'assets/codemirror/js/codemirror.js', array( 'jquery'), WPEMATICOHK_VER, true );
				wp_enqueue_script( 'wpematicohk-javascript', WPEMATICOHK_URL.'assets/codemirror/js/javascript.js', array( 'wpematicohk-mirrorcode'), WPEMATICOHK_VER, true);
				wp_enqueue_script( 'wpematicohk-xml', WPEMATICOHK_URL.'assets/codemirror/js/xml.js', array( 'wpematicohk-mirrorcode'), WPEMATICOHK_VER, true);
				wp_enqueue_script( 'wpematicohk-php', WPEMATICOHK_URL.'assets/codemirror/js/php.js', array( 'wpematicohk-mirrorcode'), WPEMATICOHK_VER, true);
				wp_enqueue_script( 'wpematicohk-htmlmixed', WPEMATICOHK_URL.'assets/codemirror/js/htmlmixed.js', array( 'wpematicohk-mirrorcode','wpematicohk-xml','wpematicohk-php'), WPEMATICOHK_VER, true);
				wp_enqueue_script( 'wpematicohk-settings', WPEMATICOHK_URL.'assets/js/wpehk_settings.js', array( 'wpematicohk-mirrorcode','wpematicohk-xml','wpematicohk-php'), WPEMATICOHK_VER, true);
			}else{
				wp_enqueue_script( 'wpematicohk-settings', WPEMATICOHK_URL.'assets/js/wpehk_settings.js', array('jquery'), WPEMATICOHK_VER, true);
				wp_enqueue_code_editor( 
					array( 'type' => 'text/html',
						'codemirror' => array(
					    'theme'=> $wpematicohk_theme_editor,
						),
				));
				wp_add_inline_script('wpematicohk-settings','var wpversion=true; ');
			}
			wp_localize_script( 'wpematicohk-settings', 'wpematicohk_object',
				array(
						'theme_editor'  		=> $wpematicohk_theme_editor,
						'nonce' 				=> wp_create_nonce('wpematicohk_nonce'),
						'text_checking_syntax'	=> __('Checking syntax errors...', 'wpematico-custom-hooks'),
						'text_no_error_syntax'	=> __('No syntax errors found', 'wpematico-custom-hooks'),
					)
				);

		}
	}

	/**
	* Static function options_callback
	* @access public
	* @return void
	* @since 1.0.1
	*/
	public static function options_callback() {
		if(current_user_can('edit_plugins') || current_user_can('edit_themes')) {
			check_admin_referer('wpematicohk_admin_nonce');
			$wpematico_hooks = array();
			if (!empty($_POST['wpematicohk_options_action_filters']) && is_array($_POST['wpematicohk_options_action_filters'])){
				foreach ($_POST['wpematicohk_options_action_filters'] as $key => $value) {
					$wpematico_hooks[] = sanitize_text_field($value);
				}
			}
			$functions_parameters = array();
			if (!empty($_POST['wpematicohk_functions_parameters']) && is_array($_POST['wpematicohk_functions_parameters'])){
				foreach ($_POST['wpematicohk_functions_parameters'] as $key => $value) {
					$functions_parameters[] = intval($value);
				}
			}
			$action_filters = array();
			if (!empty($_POST['wpematicohk_functions_action_filter']) && is_array($_POST['wpematicohk_functions_action_filter'])){
				foreach ($_POST['wpematicohk_functions_action_filter'] as $key => $value) {
					$action_filters[] = sanitize_text_field($value);
				}
			}

			$options_functions = array();
			if (!empty($_POST['wpematicohk_options_functions']) && is_array($_POST['wpematicohk_options_functions'])){
				foreach ($_POST['wpematicohk_options_functions'] as $key => $value) {
					$options_functions[] = wp_unslash($value);
				}
			}
			$type_hook = array();
			if (!empty($_POST['wpematicohk_type_hook']) && is_array($_POST['wpematicohk_type_hook'])){
				foreach ($_POST['wpematicohk_type_hook'] as $key => $value) {
					$type_hook[] = sanitize_text_field($value);
				}
			}
			
			$wpematicohk_options = array(
					'wpematicohk_options_action_filters'=> $wpematico_hooks,
					'wpematicohk_functions_parameters'=> $functions_parameters,
					'wpematicohk_functions_action_filter'=> $action_filters,
					'wpematicohk_options_functions'=> $options_functions,
					'wpematicohk_type_hook'=> $type_hook
				);
			update_option('wpematicohk_datahooks', $wpematicohk_options);
			update_option('wpematicohk_theme_editor', sanitize_text_field($_POST['wpematicohk_theme_editor']));
			wp_redirect('edit.php?post_type=wpematico&page=wpematico_settings&tab=wpematico_hooks');
			exit;
		} else {
			wp_die(__( 'Security check.', 'wpematico-custom-hooks' ));
		}
			
	}
	/**
	* Static function tabs
	* @access public
	* @return void
	* @since 1.0.1
	*/
	public static function tabs($tabs) {
		if(current_user_can('edit_plugins') || current_user_can('edit_themes')){
			$tabs['wpematico_hooks'] = __( 'Hooks', 'wpematico-custom-hooks' );
		}
		return $tabs;
	}

	/**
	* Static function 
	* @access public
	* @return void
	* @since 1.0.1
	*/
	public static function page() {
		if(!current_user_can('edit_plugins') && !current_user_can('edit_themes')){
			wp_die(__( 'Security check.', 'wpematico-custom-hooks' ));
		}
		$wpematicohk_options_admin = get_option('wpematicohk_datahooks');
		$wpematicohk_theme_editor = get_option('wpematicohk_theme_editor');
		$wpematicohk_theme_editor = isset($wpematicohk_theme_editor) ? $wpematicohk_theme_editor : '';
		$wpematicohk_nonce = wp_create_nonce('wpematicohk_nonce');
		include("data_load/wpematicohk_array_hooks.php");

		?>
		<div id="wpematicohk_sintax_error">
			
		</div>
		<form  method="POST" id="wpematicohk_form" action="<?php print(admin_url('admin-post.php')); ?>">
			<?php 
			$wpematicohk_admin_nonce = wp_create_nonce('wpematicohk_admin_nonce');
			?>
			<input type="hidden" name="action" value="wpematicohk_options">
			<input type="hidden" name="_wpnonce" value="<?php echo $wpematicohk_admin_nonce; ?>">
			<div class="wrap2">
				<h2><?php _e( 'WPeMatico Custom Hooks', 'wpematico-custom-hooks' );?></h2>
				<div id="poststuff" class="metabox-holder has-right-sidebar">
					<div id="side-info-column" class="inner-sidebar">
						<div id="side-sortables" class="meta-box-sortables ui-sortable">
							<div class="postbox inside">
								<button type="button" class="handlediv button-link" aria-expanded="true">
									<span class="screen-reader-text"><?php _e('Click to toggle'); ?></span>
									<span class="toggle-indicator" aria-hidden="true"></span>
								</button>
								<h3 class="handle"><?php _e( 'About WPeMatico Custom Hooks', 'wpematico-custom-hooks' );?></h3>
								<div class="inside">
									<p id="left1" onmouseover="jQuery(this).css('opacity',0.9);" onmouseout="jQuery(this).css('opacity',0.5);" style="text-align:center;opacity: 0.5;">
										<a href="http://www.wpematico.com" target="_Blank" title="Go to new WPeMatico WebSite">
											<img style="width: 100%;" src="<?php echo WPeMatico :: $uri ; ?>/images/wpematico-hooks_200x100.png" title="">
										</a><br />
										<b>WPeMatico Custom Hooks <?php echo WPEMATICOHK_VER; ?></b></p>
									<p><?php _e( 'Thanks for test, use and enjoy this plugin.', 'wpematico' );?></p>
									<p></p>
									<p><?php _e( 'If you like it and want to thank, you can write a 5 star review on Wordpress.', 'wpematico' );?></p>
									<style type="text/css">#linkrate:before { content: "\2605\2605\2605\2605\2605";font-size: 18px;}
									#linkrate { font-size: 18px;}</style>
									<p style="text-align: center;">
										<a href="https://wordpress.org/support/plugin/wpematico-custom-hooks/reviews?filter=5&rate=5#new-post" id="linkrate" class="button" target="_Blank" title="Click here to rate the plugin on Wordpress">  Rate </a>
									</p>
									<p></p>
								</div>
							</div>
							<div class="postbox inside">
								<h3 class="handle"><?php _e( 'Settings', 'wpematico-custom-hooks' );?></h3>
								<div class="inside">
									<p><?php _e('Select the editor theme and the filter you want to hook with a function.','wpematico-custom-hooks'); ?></p>
									
									<p><strong><?php _e('Select theme for the editor','wpematico-custom-hooks'); ?></strong></p>
									<select id="wpematicohk_themes_selection_editor" name="wpematicohk_theme_editor"> 
										<option value=""><?php _e('Colors Scheme','wpematico-custom-hooks'); ?></option>
										<option value="monokai" <?php selected('monokai', $wpematicohk_theme_editor, true) ?>>Monokai</option>
										<option value="blackboard" <?php selected('blackboard', $wpematicohk_theme_editor, true) ?>>Blackboard</option>
										<option value="cobalt" <?php selected('cobalt', $wpematicohk_theme_editor, true) ?>>Cobalt</option>
									</select>
									<br>
									<p><strong><?php _e('Select the hooks','wpematico-custom-hooks'); ?></strong></p>
									<select class="wpematicohk_select_actions_filters">
										<option value=""><?php _e('All Hooks','wpematico-custom-hooks'); ?></option>
										<?php foreach ($wpematicohk_data_filter_action as $key_hooks) { ?>
										<option tagtypehook='<?php echo esc_attr(strtolower($key_hooks['type'])); ?>' tagtemplateparameter='<?php echo esc_attr(isset($key_hooks["template_parameter"]) ? $key_hooks["template_parameter"]: ""); ?>' tagparameters='<?php echo esc_attr($key_hooks['parameters']); ?>' value="<?php echo esc_attr($key_hooks['value']); ?>"><?php echo esc_html($key_hooks['name']); ?></option>
										<?php }  ?>
									</select>
									<br>
									<br>
									<input type="button"  class="button button-primary wpematicohk_button_addfunctions" value="<?php _e('Add Functions','wpematico-custom-hooks'); ?>">
									<input type="button" class="button button-primary" id="wpematicohk_save_settings" value="<?php _e('Save Data','wpematico-custom-hooks'); ?>">
								</div>
							</div>
							<div class="postbox inside">
								<button type="button" class="handlediv button-link" aria-expanded="true">
									<span class="screen-reader-text"><?php _e('Click to toggle'); ?></span>
									<span class="toggle-indicator" aria-hidden="true"></span>
								</button>
								<h3 class="handle"><?php _e( 'Enjoy it', 'wpematico-custom-hooks' );?></h3>
								<div class="inside">
									<p style="text-align: center;"><?php _e( 'If you enjoy it please donate few dollars', 'wpematico-custom-hooks' );?>
										<input type="button" class="button-secondary" name="donate" value="<?php _e( 'Click to Donate', 'wpematico-custom-hooks' );?>" onclick="javascript:window.open('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=B8V39NWK3NFQU');return false;"/>
									</p>
									<p></p>
									<p style="text-align: center;">
										<input type="button" class="button-primary" name="buypro" value="<?php _e( 'WPeMatico Perfect Package', 'wpematico-custom-hooks' );?>" onclick="javascript:window.open('https://etruel.com/downloads/wpematico-perfect/');return false;"/>
									</p>
									<p></p>
								</div>
							</div>
							
						</div>
					</div>
					
					<div id="post-body">
						<div id="post-body-content">
							<div id="normal-sortables" class="meta-box-sortables ui-sortable">
								<?php $i=0; foreach ($wpematicohk_data_filter_action as $key_hooks) { ?>
								<div  class="postbox wpematicohk_dinamic_metabox wpematicohk_dinamic_chaplain <?php echo esc_attr($key_hooks['value']); ?>">
									<h3 class="hndle hook-name"><span><?php echo esc_html($key_hooks["name"]); ?></span> <span class="hook-type"><?php echo esc_html(strtolower($key_hooks['type'])); ?></span></h3>
									<p class="hook-description"><?php echo esc_html($key_hooks["description"]); ?></p>
									<div class="inside">
										<?php 
											$content_action_filter = isset($wpematicohk_options_admin['wpematicohk_functions_action_filter'][$i]) ? $wpematicohk_options_admin['wpematicohk_functions_action_filter'][$i] : '';
											$content_action_filter = esc_attr($content_action_filter);
											$content_code_function = isset($wpematicohk_options_admin['wpematicohk_options_functions'][$i]) ? $wpematicohk_options_admin['wpematicohk_options_functions'][$i] : ''; 
											$content_code_function = esc_textarea($content_code_function);

										?>
										<input type="hidden" class="wpematicohk_options_action_filters" name="wpematicohk_options_action_filters[]" value="<?php echo esc_attr($key_hooks["value"]); ?>">
										<input type="hidden" class="wpematicohk_functions_parameters" name="wpematicohk_functions_parameters[]" value="<?php echo esc_attr(isset($key_hooks["parameters"]) ? $key_hooks["parameters"] : 0); ?>">
										<input type="hidden" name="wpematicohk_functions_action_filter[]" class='wpematicohk_codemirror_<?php echo esc_attr($key_hooks["value"]); ?>' value="<?php echo $content_action_filter; ?>">
										<input type="hidden" name="wpematicohk_type_hook[]" value="<?php echo esc_attr($key_hooks["type"]); ?>">
									
										<textarea name="wpematicohk_options_functions[]" class="wpematico-textarea-codemirror" id="wpematicohk_codemirror_<?php echo esc_attr($key_hooks["value"]); ?>"><?php echo $content_code_function; ?></textarea>
									</div>
								</div>
								<?php $i++; } ?>
							</div>				
						</div>
					</div>

				</div>
			</div>
		</form>

	<?php		
	}	

}
endif;
wpematico_hooks_settings::hooks();


	
	

