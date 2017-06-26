<?php
add_action( 'wp_ajax_wpematicohk_sintax', 'wpematicohk_sintax_callback' );
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
	$response = wp_remote_post($url_file, array(
		'method' => 'POST',
		'timeout' => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' =>  array(),
		'cookies' => array()
	    )
	);
	//clear file
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
				$wpmaticohk_sintax_result = wpematicohk_apisintax($code,$_POST['wpematicohk_options_action_filters'][$i]);
				if(strpos($wpmaticohk_sintax_result['body'],'no-error-hook')===false){
			    	echo $wpmaticohk_sintax_result['body']."<br><strong> In hook: ".$_POST['wpematicohk_options_action_filters'][$i]."</strong>";
					wp_die();
			    }
			}
		}
		echo "no-error-hook";
		wp_die();
		
}


