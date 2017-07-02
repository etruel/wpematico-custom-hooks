<?php
	/** 
 *  @package WPeMatico Custom Hooks
 *	functions to add a tab with custom options in wpematico settings 
	**/

	if ( !defined('ABSPATH')) 
	{
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	add_action( 'admin_enqueue_scripts', 'wpematicohk_admin_enqueue_scripts', 999 );
	function wpematicohk_admin_enqueue_scripts()
	{
	//Style
		wp_enqueue_style( 'wpematicohk-codemirror_style',plugin_dir_url( __FILE__ ).'../assets/codemirror/css/codemirror.css');
		wp_enqueue_style( 'wpematicohk-monokai',plugin_dir_url(__FILE__ ).'../assets/codemirror/css/monokai.css');
		wp_enqueue_style( 'wpematicohk-colbat',plugin_dir_url(__FILE__ ).'../assets/codemirror/css/colbat.css' );
		wp_enqueue_style( 'wpematicohk-blackboard',plugin_dir_url(__FILE__ ).'../assets/codemirror/css/blackboard.css' );
	//Scripts
		wp_enqueue_script( 'wpematicohk-mirrorcode',plugin_dir_url(__FILE__ ).'../assets/codemirror/js/codemirror.js', array( 'jquery') );
		wp_enqueue_script( 'wpematicohk-javascript',plugin_dir_url(__FILE__ ).'../assets/codemirror/js/javascript.js', array( 'wpematicohk-mirrorcode'));
		wp_enqueue_script( 'wpematicohk-xml',plugin_dir_url(__FILE__ ).'../assets/codemirror/js/xml.js', array( 'wpematicohk-mirrorcode'));
		wp_enqueue_script( 'wpematicohk-php',plugin_dir_url(__FILE__ ).'../assets/codemirror/js/php.js', array( 'wpematicohk-mirrorcode'));
		wp_enqueue_script( 'wpematicohk-htmlmixed',plugin_dir_url(__FILE__ ).'../assets/codemirror/js/htmlmixed.js', array( 'wpematicohk-mirrorcode','wpematicohk-xml','wpematicohk-php'));
	}

	add_action( 'admin_post_wpematicohk_options', 'wpematicohk_options_callback' );
	function wpematicohk_options_callback($post){
		check_admin_referer('wpematicohk_admin_nonce');
		$wpematicohk_options = array(
			'wpematicohk_options_action_filters'=> $_POST['wpematicohk_options_action_filters'],
			'wpematicohk_functions_parameters'=> $_POST['wpematicohk_functions_parameters'],
			'wpematicohk_functions_action_filter'=> $_POST['wpematicohk_functions_action_filter'],
			'wpematicohk_options_functions'=> str_replace('\\','',$_POST['wpematicohk_options_functions']),
			'wpematicohk_type_hook'=>$_POST['wpematicohk_type_hook']
			);
		update_option('wpematicohk_datahooks',$wpematicohk_options);
		update_option('wpematicohk_theme_editor',$_POST['wpematicohk_theme_editor']);
		wp_redirect('edit.php?post_type=wpematico&page=wpematico_settings&tab=wpematico_hooks');

	}


	add_filter('wpematico_settings_tabs','wpematicohk_new_tab',10,1);
	function wpematicohk_new_tab($tabs)
	{

		if(current_user_can('edit_plugins') || current_user_can('edit_themes')){
			$tabs['wpematico_hooks'] = __( 'Hooks', 'wpematico_custom-hooks' );
		}
		return $tabs;
		
	}

	add_action('wpematico_settings_tab_wpematico_hooks','wpematico_custom_hooks_page');
	function wpematico_custom_hooks_page()
	{
		if(!current_user_can('edit_plugins') && !current_user_can('edit_themes')){
			wp_die(__( 'Security check.', 'wpematico_custom-hooks' ));
		}
		$wpematicohk_options_admin = get_option('wpematicohk_datahooks');
		$wpematicohk_theme_editor = get_option('wpematicohk_theme_editor');
		$wpematicohk_theme_editor = isset($wpematicohk_theme_editor) ? $wpematicohk_theme_editor : '';
		$wpematicohk_nonce = wp_create_nonce('wpematicohk_nonce');
		include("data_load/wpematicohk_array_hooks.php");

		?>
		<div id="wpematicohk_sintax_error" style="display:none;text-aling:center; padding:15px 15px; color:#44494F; background-color:white; border:1px solid #F0F0F0;border-left:4px solid #FFBA00; ">
			
		</div>
		<form  method="POST" id="wpematicohk_form" action="<?php print(admin_url('admin-post.php')); ?>">
			<?php 
			$wpematicohk_admin_nonce = wp_create_nonce('wpematicohk_admin_nonce');
			?>
			<input type="hidden" name="action" value="wpematicohk_options">
			<input type="hidden" name="_wpnonce" value="<?php echo $wpematicohk_admin_nonce; ?>">
			<div class="wrap2">
				<h2><?php _e( 'WPeMatico Custom Hooks', 'wpematico_custom-hooks' );?></h2>
				<div id="poststuff" class="metabox-holder has-right-sidebar">
					<div id="side-info-column" class="inner-sidebar">
						<div id="side-sortables" class="meta-box-sortables ui-sortable">
							<div class="postbox inside">
								<h3 class="handle"><?php _e( 'WPeMatico Hooks', 'wpematico_custom-hooks' );?></h3>
								<div class="inside">
									<p><?php _e('In this section we can put some example description to test','wpematico_custom-hooks'); ?></p>
									<br>
									<p><strong><?php _e('Select theme for the editor','wpematico_custom-hooks'); ?></strong></p>
									<select id="wpematicohk_themes_selection_editor" name="wpematicohk_theme_editor"> 
										<option value=""><?php _e('Colors Scheme','wpematico_custom-hooks'); ?></option>
										<option value="monokai" <?php selected('monokai', $wpematicohk_theme_editor, true) ?>>Monokai</option>
										<option value="blackboard" <?php selected('blackboard', $wpematicohk_theme_editor, true) ?>>Blackboard</option>
										<option value="cobalt" <?php selected('cobalt', $wpematicohk_theme_editor, true) ?>>Cobalt</option>
									</select>
									<br>
									<p><strong><?php _e('Select the hooks','wpematico_custom-hooks'); ?></strong></p>
									<select class="wpematicohk_select_actions_filters">
										<option value=""><?php _e('All Hooks','wpematico_custom-hooks'); ?></option>
										<?php foreach ($wpematicohk_data_filter_action as $key_hooks) { ?>
										<option tagtypehook='<?php echo strtolower($key_hooks['type']); ?>' tagtemplateparameter='<?php echo isset($key_hooks["template_parameter"]) ? $key_hooks["template_parameter"]: ""; ?>' tagparameters='<?php echo $key_hooks['parameters'] ?>' value="<?php echo $key_hooks['value']; ?>"><?php echo $key_hooks['name']; ?></option>
										<?php }  ?>
									</select>
									<br>
									<br>
									<input type="button"  class="button button-primary wpematicohk_button_addfunctions" value="<?php _e('Add Functions','wpematico_custom-hooks'); ?>">
									<input type="button" class="button button-primary" id="wpematicohk_save_settings" value="<?php _e('Save Data','wpematico_custom-hooks'); ?>">
								</div>
							</div>
						</div>
					</div>
					
					<div id="post-body">
						<div id="post-body-content">
							<div id="normal-sortables" class="meta-box-sortables ui-sortable">
								<?php $i=0; foreach ($wpematicohk_data_filter_action as $key_hooks) { ?>
								<div  class="postbox wpematicohk_dinamic_metabox wpematicohk_dinamic_chaplain <?php echo $key_hooks['value']; ?>">
									<h3 class="hndle" style="font-size:20px;"><span><?php _e(''.$key_hooks["name"].'', 'wpematico_custom-hooks' ); ?></span> <span style="float:right; background-color:#0073AA; color:white; padding:5px; font-size:14px !important;"><?php echo strtolower($key_hooks['type']); ?></span></h3>
									<p style="padding-left:10px;"><?php _e(''.$key_hooks["description"].'', 'wpematico_custom-hooks' ); ?></p>
									<div class="inside">
										<input type="hidden" class="wpematicohk_options_action_filters" name="wpematicohk_options_action_filters[]" value="<?php echo $key_hooks["value"]; ?>">
										<input type="hidden" class="wpematicohk_functions_parameters" name="wpematicohk_functions_parameters[]" value="<?php echo isset($key_hooks["parameters"]) ? $key_hooks["parameters"] : 0; ?>">
										<input type="hidden" name="wpematicohk_functions_action_filter[]" class='wpematicohk_codemirror_<?php echo $key_hooks["value"]; ?>' value="<?php echo $wpematicohk_options_admin['wpematicohk_functions_action_filter'][$i]; ?>">
										<input type="hidden" name="wpematicohk_type_hook[]" value="<?php echo $key_hooks["type"]; ?>">
										<textarea name="wpematicohk_options_functions[]" class="wpematico-textarea-codemirror" id="wpematicohk_codemirror_<?php echo $key_hooks["value"]; ?>" style="width:100%; height:100px;"><?php echo isset($wpematicohk_options_admin['wpematicohk_options_functions'][$i]) ? $wpematicohk_options_admin['wpematicohk_options_functions'][$i] : ''; ?></textarea>
									</div>
								</div>
								<?php $i++; } ?>
							</div>				
						</div>
					</div>

				</div>
			</div>
		</form>
		<style type="text/css">
		.CodeMirror{
			width: 100% !important;
		}
		</style>
		<script type="text/javascript">
		var codemirror_editor = Array();
		jQuery(document).ready(function($){
			
		//create template function
		$(document).on('click','.wpematicohk_button_addfunctions',function(){
			wpematicohk_select_text = $('.wpematicohk_select_actions_filters').val()+"_callback";
			idtemp = 'wpematicohk_codemirror_'+$('.wpematicohk_select_actions_filters').val();
			tagtypehook = $('.wpematicohk_select_actions_filters option:selected').attr('tagtypehook');
			template_parameter =  $('.wpematicohk_select_actions_filters option:selected').attr('tagtemplateparameter');
			template_function='\nfunction '+wpematicohk_select_text+'('+template_parameter+'){';
			//IF ACTION ON FILTER
			if(tagtypehook=='filter'){
				varparameter = template_parameter.split(',');
				if(varparameter[0]=='') varparameter[0] = '""';
				template_function+='\n \treturn '+varparameter[0]+';\n';
			}

			template_function+='\n}';
			//refresh codemirror editor
			addCodemirrorFunction(idtemp,template_function);
			wpematicohk_codemirror_line_function(idtemp);
			$("textarea#"+idtemp).text(wpematicohkget_codemirror(idtemp));
		});
		$(document).on('click','#wpematicohk_save_settings',function(){
			$(".wpematico-textarea-codemirror").each(function(){
				idtemp = $(this).attr("id");
				wpematicohk_codemirror_line_function(idtemp);
				$("textarea#"+idtemp).text(wpematicohkget_codemirror(idtemp));
			});
			$("#wpematicohk_sintax_error").css({'border-left':"4px solid #FFBA00"});
			$("#wpematicohk_sintax_error").text('<?php _e("Checking syntax errors....."); ?>');
			$("#wpematicohk_sintax_error").fadeIn(300);
			wpematicohk_run_sintax();
			
		});

		$(document).on('change','.wpematicohk_select_actions_filters',function(){
			wpematicohk_select_text = $('.wpematicohk_select_actions_filters').val();
			if(wpematicohk_select_text!=''){
				$(".wpematicohk_dinamic_chaplain").hide(0);
				$("."+wpematicohk_select_text).show(0);
			}else{
				$(".wpematicohk_dinamic_chaplain").show(0);
			}
		});
		//select theme editor
		$(document).on('change','#wpematicohk_themes_selection_editor',function(){
			mytheme = $(this).val();
			$(".wpematico-textarea-codemirror").each(function(){
				idtemp = $(this).attr("id");
				wpematicohk_selectTheme(mytheme,idtemp);
			});	
		});

		function wpematicohk_codemirror_line_function(idtemp){
			cont_lines_code = 0;
			function_lines_code = '';
			$("textarea#"+idtemp+"").parent().find('.CodeMirror pre.CodeMirror-line').each(function(i){
				if($(this).find('span').text().indexOf(' function')>-1){
					//none
				}else if($(this).find('span').text().indexOf('function')>-1){
					fn = $(this).find('span').text()+'}';
					fnStr = fn.toString().substr('function '.length),
					result_function = fnStr.substr(0, fnStr.indexOf('('));
						if(cont_lines_code>0){function_lines_code+=','+result_function; }else{function_lines_code+=result_function};
						cont_lines_code++;
					}
				});
			//add functions split ,
			$("."+idtemp).val(function_lines_code);
		}

		//create Multiple Editors in codemirror javascript each
		function multiple_codemirror(){
			$(".wpematico-textarea-codemirror").each(function(){
				idtemp = $(this).attr("id");
				codemirror_editor[idtemp] = editor(idtemp);
				codemirror_editor[idtemp].refresh();
			});	
		}
		//creating ajax function sintax ejecute
		function wpematicohk_run_sintax(){
			wpematico_textarea_codemirror = Array();
			wpematicohk_options_action_filters = Array();
			wpematicohk_functions_parameters = Array();
			wpematicohk_functions_action_filter = Array();

			$('.wpematicohk_options_action_filters').map(function(i, el) {
				wpematicohk_options_action_filters.push(el.value);
			});
			$('textarea.wpematico-textarea-codemirror').map(function(i, el) {
				wpematico_textarea_codemirror.push(el.value);
			});
			$('.wpematicohk_functions_parameters').map(function(i, el) {
				wpematicohk_functions_parameters.push(el.value);
			});
			$('.wpematicohk_functions_action_filter').map(function(i, el) {
				wpematicohk_functions_action_filter.push(el.value);
			});
			
			var data = {
				'action': 'wpematicohk_sintax',
				_ajax_nonce : "<?php echo $wpematicohk_nonce; ?>",
				'wpematicohk_options_functions':wpematico_textarea_codemirror,
				'wpematicohk_options_action_filters':wpematicohk_options_action_filters,
				'wpematicohk_functions_parameters':wpematicohk_functions_parameters,
				'wpematicohk_functions_action_filter':wpematicohk_functions_action_filter
				
			};
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				if(response.indexOf('no-error-hook')==(-1)){
					$("#wpematicohk_sintax_error").css({'border-left':"4px solid #C00000"});
					$("#wpematicohk_sintax_error").html(response);
				}else{
					$("#wpematicohk_sintax_error").text("<?php _e('No syntax errors found');  ?>");
					$("#wpematicohk_sintax_error").css({'border-left':"4px solid #446320"});
					$("#wpematicohk_form").submit();
				}
			});
		}


		multiple_codemirror();
	});

	//Create Multiple Editors in CodeMirror
	function editor(id)
	{
		return CodeMirror.fromTextArea(document.getElementById(id), {
			lineNumbers: true,
			mode : "xml",
			theme: "<?php echo $wpematicohk_theme_editor; ?>",
			indentWithTabs: false,
			htmlMode: true,
			readOnly: false,
		});
	}
	function wpematicohk_selectTheme(theme,id){
		codemirror_editor[id].setOption("theme", theme);
	}
	function addCodemirrorFunction(id,myfunction){
		codemirror_editor[id].setValue(codemirror_editor[id].getValue()+myfunction);
	}
	function wpematicohkget_codemirror(id){
		return codemirror_editor[id].getValue();
	}
	</script>
	<?php		
} 