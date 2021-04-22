<?php

if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

if (!class_exists('wpehk_filter_and_actions')) :

	class wpehk_filter_and_actions {

		/**
		 * Static function execute
		 * @access public
		 * @return void
		 * @since 1.0.1
		 */
		public static function execute() {
			include("data_load/wpematicohk_array_hooks.php");
			$is_executable = true;
			$parameters = null;
			if (isset($_REQUEST['action'])) {
				if ($_REQUEST['action'] == 'wpematicohk_sintax' || $_REQUEST['action'] == 'wpematicohk_options') {
					$is_executable = false;
				}
			}
			if (isset($_REQUEST['tab'])) {
				$is_executable = false;
			}

			if ($is_executable) {
				$wpematicohk_options = array();
				$wpematicohk_all_function_filters = array();
				$wpematicohk_options = get_option('wpematicohk_datahooks');
				if (isset($wpematicohk_options['wpematicohk_options_action_filters'])) {
					foreach ($wpematicohk_options['wpematicohk_options_action_filters'] as $i => $value) {
						if (!empty(wp_unslash($wpematicohk_options['wpematicohk_options_functions'][$i]))) {
							//get parameters
							$parameters = self::wpemticohk_hook_get_parameter($wpematicohk_options['wpematicohk_options_action_filters'][$i], $wpematicohk_data_filter_action);
							if (isset($wpematicohk_options['wpematicohk_functions_action_filter'][$i])) {
								$wpematicohk_all_function_filters = explode(',', $wpematicohk_options['wpematicohk_functions_action_filter'][$i]);
							}
							if (!empty($wpematicohk_all_function_filters[0])) {
								for ($j = 0; $j < count($wpematicohk_all_function_filters); $j++) {
									if ($wpematicohk_options['wpematicohk_type_hook'][$i] != 'filter') {
										add_action($wpematicohk_options['wpematicohk_options_action_filters'][$i], $wpematicohk_all_function_filters[$j], 10, $parameters);
									} else {
										add_filter($wpematicohk_options['wpematicohk_options_action_filters'][$i], $wpematicohk_all_function_filters[$j], 10, $parameters);
									}
								}
								$wpematicohk_code = wp_unslash($wpematicohk_options['wpematicohk_options_functions'][$i]);
								eval($wpematicohk_code);
							}//closed if isset wpematico all functions filters
						}
					}//closed forearch
				}//isset array foreach
			}//closed is executable
		}

		public static function wpemticohk_hook_get_parameter($hook, $wpematicohk_data_filter_action) {
			$compare = null;
			foreach ($wpematicohk_data_filter_action as $key_hooks) {
				if ($key_hooks['value'] == $hook) {
					$compare = $key_hooks['parameters'];
				}
			}
			return $compare;
		}

	}

	endif;
wpehk_filter_and_actions::execute();
?>