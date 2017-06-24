<?php
add_action( 'wp_ajax_wpematicohk_sintax', 'wpematicohk_sintax_callback' );

function wpematicohk_apisintax($mycode){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://phpcodechecker.com/api/?code=".$mycode."",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "cache-control: no-cache"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	$response = json_decode($response, true);
	print_r($response);

}

function wpematicohk_sintax_callback(){
		check_ajax_referer('wpematicohk_nonce');
		for($i=0; $i<count($_POST['wpematicohk_options_action_filters']);$i++){
			if($_POST['wpematicohk_options_functions'][$i]!=''){
				$wpematicohk_all_function_filters = explode(',',$_POST['wpematicohk_functions_action_filter'][$i]);
				for($j=0; $j<count($wpematicohk_all_function_filters);$j++){
					if($_POST['wpematicohk_type_hook']!='filter'){
					 	add_action($_POST['wpematicohk_options_action_filters'][$i],$wpematicohk_all_function_filters[$j],10,$_POST['wpematicohk_functions_parameters'][$i]);
					}else{
						add_filter($_POST['wpematicohk_options_action_filters'][$i],$wpematicohk_all_function_filters[$j],10,$_POST['wpematicohk_functions_parameters'][$i]);
					}
				}
				$code = str_replace('\\','',$_POST['wpematicohk_options_functions'][$i]);
				//code analizer
				//wpematicohk_apisintax($code);
			}
		}
		wp_die();
}


