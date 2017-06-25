<?php
		if(!isset($_REQUEST['tab'])){
			if(!isset($_REQUEST['action'])){
				$wpematicohk_options = get_option('wpematicohk_datahooks');
				for($i=0; $i<count($wpematicohk_options['wpematicohk_options_action_filters']);$i++){
					if($wpematicohk_options['wpematicohk_options_functions'][$i]!=''){
					 	$wpematicohk_all_function_filters = explode(',',$wpematicohk_options['wpematicohk_functions_action_filter'][$i]);
					 	for($j=0; $j<count($wpematicohk_all_function_filters);$j++){
					 		if($wpematicohk_options['wpematicohk_type_hook']!='filter'){
					 			add_action($wpematicohk_options['wpematicohk_options_action_filters'][$i],$wpematicohk_all_function_filters[$j],10,0);
					 		}else{
					 			add_filter($wpematicohk_options['wpematicohk_options_action_filters'][$i],$wpematicohk_all_function_filters[$j],10,$wpematicohk_options['wpematicohk_functions_parameters'][$i]);
					 		}//close type hook
					 	}
					 	$wpematicohk_code = $wpematicohk_options['wpematicohk_options_functions'][$i];	
						eval($wpematicohk_code);
					}
					
				}//cierre del for
			}
		}//closed get tab

?>