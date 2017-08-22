<?php

if ( !defined('ABSPATH')) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if( !class_exists( 'wpehk_filter_and_actions' ) ) :
class wpehk_filter_and_actions {

	/**
	* Static function execute
	* @access public
	* @return void
	* @since 1.0.1
	*/
	public static function execute() {
		if(!isset($_REQUEST['tab'])){
			if(!isset($_REQUEST['action'])) {
				$wpematicohk_options = array();
				$wpematicohk_all_function_filters = array();
				$wpematicohk_options = get_option('wpematicohk_datahooks');
				if(isset($wpematicohk_options['wpematicohk_options_action_filters'])){
					foreach ($wpematicohk_options['wpematicohk_options_action_filters'] as $i => $value) {
							if($wpematicohk_options['wpematicohk_options_functions'][$i]!=''){
							 	if(isset($wpematicohk_options['wpematicohk_functions_action_filter'][$i])){
							 		$wpematicohk_all_function_filters = explode(',',$wpematicohk_options['wpematicohk_functions_action_filter'][$i]);
							 	}
							 	if(!empty($wpematicohk_all_function_filters[0])){
								 	for($j=0; $j<count($wpematicohk_all_function_filters);$j++){
								 		if($wpematicohk_options['wpematicohk_type_hook'][$i]!='filter'){
								 			add_action($wpematicohk_options['wpematicohk_options_action_filters'][$i],$wpematicohk_all_function_filters[$j],10,$wpematicohk_options['wpematicohk_functions_parameters'][$i]);
								 		}else{
								 			add_filter($wpematicohk_options['wpematicohk_options_action_filters'][$i],$wpematicohk_all_function_filters[$j],10,$wpematicohk_options['wpematicohk_functions_parameters'][$i]);
								 		}//close type hook
								 	}
								 	$wpematicohk_code = $wpematicohk_options['wpematicohk_options_functions'][$i];	
									eval($wpematicohk_code);
								}//closed if isset wpematico all functions filters
							}
					}
				}//isset array foreach
			}
		}//closed get tab
	}

}
endif;
wpehk_filter_and_actions::execute();
?>