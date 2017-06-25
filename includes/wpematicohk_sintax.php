<?php
add_action( 'wp_ajax_wpematicohk_sintax', 'wpematicohk_sintax_callback' );
sleep(3);
function wpematicohk_apisintax($mycode,$myfilter){
	$response = '';
	$path = dirname(__FILE__) . '/wpematicohk_file_phpchecker.php';
	$end_file = 'echo "no-error-hook";';
    if (($h = fopen($path, "w")) !== FALSE) {
    	$string = "<?php ".$mycode."\n".$end_file." ?>";
        fwrite($h,$string);
        fclose($h);
    }
    $url_file = WPEMATICOHK_URL."includes/wpematicohk_file_phpchecker.php";
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url_file,
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
	if (($h = fopen($path, "w")) !== FALSE) {
    	$string = '';
        fwrite($h,$string);
        fclose($h);
    }
	$response;
	return $response;
}

function wpematicohk_sintax_callback(){
		check_ajax_referer('wpematicohk_nonce');
		$cont_errors_ver = 0;
		$post_filter = 0;
		$wpmaticohk_sintax_result = '';
		foreach ($_POST['wpematicohk_options_action_filters'] as $i => $value) {
			if (!isset($_POST['wpematicohk_options_functions'][$i])){
				$_POST['wpematicohk_options_functions'][$i] = '';
			}
			if($_POST['wpematicohk_options_functions'][$i]!=''){
				if (!isset($_POST['wpematicohk_functions_action_filter'][$i])){
					$_POST['wpematicohk_functions_action_filter'][$i] = '';
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
				echo $wpmaticohk_sintax_result."<br><strong> In hook: ".$_POST['wpematicohk_options_action_filters'][$post_filter]."</strong>";
				wp_die();
			}
		}
		
}


