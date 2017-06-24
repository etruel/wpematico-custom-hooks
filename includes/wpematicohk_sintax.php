<?php
add_action( 'wp_ajax_wpematicohk_sintax', 'wpematicohk_sintax_callback' );
sleep(3);
function wpematicohk_apisintax($mycode,$myfilter){
	$response = '';
	$path = dirname(__FILE__) . '/wpematicohk_file_phpchecker.php';
    if (($h = fopen($path, "w")) !== FALSE) {
    	$string = "<?php ".$mycode."\n ?>";
        fwrite($h,$string);
        fclose($h);
    }


	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => plugins_url()."/wpematico_custom-hooks/includes/wpematicohk_file_phpchecker.php",
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
	$response;
	return $response;
}

function wpematicohk_sintax_callback(){
		check_ajax_referer('wpematicohk_nonce');
		$cont_errors_ver = 0;
		$post_filter = 0;
		$wpmaticohk_sintax_result = '';
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
				if($cont_errors_ver==0){
					$wpmaticohk_sintax_result = wpematicohk_apisintax($code,$_POST['wpematicohk_options_action_filters'][$i]);
					$post_filter = $i;
				}
				if(strpos('error',$wpmaticohk_sintax_result)>0){
					$cont_errors_ver++;
				}
			}
		}
		echo $wpmaticohk_sintax_result."<br><strong> In filter: ".$_POST['wpematicohk_options_action_filters'][$post_filter]."</strong>";
		wp_die();
}


