<?php

if ( !defined('ABSPATH')) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if( !class_exists( 'wpematicohk_sintax' ) ) :
class wpematicohk_sintax {

	/**
	* Static function hooks
	* @access public
	* @return void
	* @since 1.0.1
	*/
	public static function hooks() {
		self::clean_file();
		add_action( 'wp_ajax_wpematicohk_sintax', array(__CLASS__, 'ajax_callback') );
	}
	/**
	* Static function ajax_callback
	* @access public
	* @return void
	* @since 1.0.1
	*/
	public static function ajax_callback() {
		if(!current_user_can('edit_plugins') && !current_user_can('edit_themes')){
			wp_die(__( 'Security check.', 'wpematico_custom-hooks' ));
		}
		check_ajax_referer('wpematicohk_nonce');
		$wpmaticohk_sintax_result = '';
		foreach ($_POST['wpematicohk_options_action_filters'] as $i => $value) {

			$_POST['wpematicohk_options_action_filters'][$i] = sanitize_text_field($_POST['wpematicohk_options_action_filters'][$i]);

			if (!isset($_POST['wpematicohk_options_functions'][$i])){
				$_POST['wpematicohk_options_functions'][$i] = '';
			}


			if($_POST['wpematicohk_options_functions'][$i]!=''){
				if (!isset($_POST['wpematicohk_functions_action_filter'][$i])){
					$_POST['wpematicohk_functions_action_filter'][$i] = '';
				}
				$_POST['wpematicohk_functions_action_filter'][$i] = sanitize_text_field($_POST['wpematicohk_functions_action_filter'][$i]);
				
				$code = wp_unslash($_POST['wpematicohk_options_functions'][$i]);
					
				$wpmaticohk_sintax_result = self::check($code,$_POST['wpematicohk_options_action_filters'][$i]);
				if(strpos($wpmaticohk_sintax_result['body'],'no-error-hook')===false){
				    echo $wpmaticohk_sintax_result['body']."<br><strong> In hook: ".esc_html($_POST['wpematicohk_options_action_filters'][$i])."</strong>";
					wp_die();
				}
			}
		}
		echo "no-error-hook";
		wp_die();
	}

	/**
	* Static function check
	* @access public
	* @return @response String of response
	* @since 1.0.1
	*/
	public static function check($mycode, $myfilter){
		$response = '';
		$path = WPEMATICOHK_DIR . 'includes/wpematicohk_file_phpchecker.php';
		$start_file = 'die("no-error-hook");';
	    if (($h = fopen($path, "w")) !== FALSE) {
	    	$string = "<?php ".$start_file."\n".$mycode."\n ?>";
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
		self::clean_file();
		return $response;
		
	}
	/**
	* Static function clean_file_test
	* @access public
	* @return void
	* @since version
	*/
	public static function clean_file() {
		$path = WPEMATICOHK_DIR . 'includes/wpematicohk_file_phpchecker.php';
		//clear file
		if (($h = fopen($path, "w")) !== FALSE) {
	    	$string = '';
	        fwrite($h,$string);
	        fclose($h);
	    }
	}
}
endif;

wpematicohk_sintax::hooks();

