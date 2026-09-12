<?php

if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

if (!class_exists('wpematicohk_sintax')) :

	/**
	 * Syntax check for the code typed on the Hooks screen, run over AJAX before saving.
	 *
	 * Until 1.2 this wrote the submitted code to includes/wpematicohk_file_phpchecker.php and
	 * then wp_remote_post()ed itself to see whether the file parsed. That failed on every host
	 * that blocks loopback HTTP (wp_remote_post() returned a WP_Error which was then indexed as
	 * an array, issue #7) and it left a publicly reachable .php file holding arbitrary code on
	 * disk. token_get_all() with TOKEN_PARSE runs the real parser without executing anything,
	 * needs no temp file and no HTTP request.
	 *
	 * @since 1.0.1
	 */
	class wpematicohk_sintax {

		/**
		 * Static function hooks
		 * @access public
		 * @return void
		 * @since 1.0.1
		 */
		public static function hooks() {
			add_action('wp_ajax_wpematicohk_sintax', array(__CLASS__, 'ajax_callback'));
		}

		/**
		 * Checks every submitted snippet and answers the editor.
		 *
		 * @access public
		 * @return void
		 * @since 1.0.1
		 */
		public static function ajax_callback() {
			if (!current_user_can('edit_plugins') && !current_user_can('edit_themes')) {
				wp_send_json_error(array('message' => __('Security check.', 'wpematico-custom-hooks')), 403);
			}
			check_ajax_referer('wpematicohk_nonce');

			$hooks = isset($_POST['wpematicohk_options_action_filters']) ? (array) wp_unslash($_POST['wpematicohk_options_action_filters']) : array();
			$codes = isset($_POST['wpematicohk_options_functions']) ? (array) wp_unslash($_POST['wpematicohk_options_functions']) : array();

			// Function name => hook that declares it. "Cannot redeclare" is an uncatchable fatal in
			// PHP 8, so a duplicate has to be refused here rather than discovered at runtime on the
			// front end. (issue #8)
			$declared = array();

			foreach ($hooks as $i => $hook) {
				if (empty($codes[$i]) || !is_string($codes[$i])) {
					continue;
				}

				$error = self::check($codes[$i]);
				if (true !== $error) {
					wp_send_json_error(array(
						'message' => $error,
						'hook'	  => sanitize_text_field($hook),
					));
				}

				$repeated = self::repeated_parameter($codes[$i]);
				if ('' !== $repeated) {
					wp_send_json_error(array(
						'message' => sprintf(
								/* translators: %s: parameter name */
								__('The parameter %s is named twice in the same function. PHP refuses to compile that, and the error cannot be caught, so it would take the whole site down.', 'wpematico-custom-hooks'),
								$repeated
						),
						'hook'	  => sanitize_text_field($hook),
					));
				}

				foreach (self::declared_functions($codes[$i]) as $name) {
					if (isset($declared[$name])) {
						wp_send_json_error(array(
							'message' => sprintf(
									/* translators: 1: function name, 2: the other hook's name */
									__('The function %1$s is already declared in the code for %2$s. Two hooks cannot declare the same function name — rename one of them.', 'wpematico-custom-hooks'),
									$name . '()',
									$declared[$name]
							),
							'hook'	  => sanitize_text_field($hook),
						));
					}

					if (function_exists($name)) {
						wp_send_json_error(array(
							'message' => sprintf(
									/* translators: %s: function name */
									__('The function %s already exists in WordPress or in another plugin. Declaring it again would be a fatal error — pick a different name.', 'wpematico-custom-hooks'),
									$name . '()'
							),
							'hook'	  => sanitize_text_field($hook),
						));
					}

					$declared[$name] = $hook;
				}
			}

			wp_send_json_success(array('message' => __('No syntax errors found', 'wpematico-custom-hooks')));
		}

		/**
		 * Parses a snippet without executing it.
		 *
		 * The stored snippet carries no opening tag, and the tag is prepended on the same line so
		 * the reported line numbers still match what the editor shows.
		 *
		 * @access public
		 * @param  string $mycode Code typed by the administrator.
		 * @return true|string    True when it parses, otherwise the error message.
		 * @since 1.0.1
		 */
		public static function check($mycode) {
			if (!is_string($mycode) || '' === trim($mycode)) {
				return true;
			}

			try {
				token_get_all('<?php ' . $mycode, TOKEN_PARSE);
			} catch (\ParseError $e) {
				return sprintf(
						/* translators: 1: parser message, 2: line number */
						__('Parse error: %1$s on line %2$d', 'wpematico-custom-hooks'),
						$e->getMessage(),
						$e->getLine()
				);
			} catch (\Throwable $e) {
				return sprintf(
						/* translators: %s: error message */
						__('The code could not be checked: %s', 'wpematico-custom-hooks'),
						$e->getMessage()
				);
			}

			return true;
		}

		/**
		 * First parameter name a function of the snippet declares twice, or '' when there is none.
		 *
		 * token_get_all() cannot see this: the code parses, and PHP only rejects it when it
		 * compiles -- as an E_COMPILE_ERROR that try/catch around the eval() does NOT catch, so
		 * the site dies on every request, front end included. Same failure as "Cannot redeclare"
		 * (issue #8), and it has to be refused here for the same reason.
		 *
		 * @access public
		 * @param  string $mycode Code typed by the administrator.
		 * @return string         The repeated parameter, or '' when the snippet is fine.
		 * @since 1.4
		 */
		public static function repeated_parameter($mycode) {
			if (!is_string($mycode) || '' === trim($mycode)) {
				return '';
			}

			try {
				$tokens = token_get_all('<?php ' . $mycode);
			} catch (\Throwable $e) {
				return '';
			}

			$count = count($tokens);

			for ($i = 0; $i < $count; $i++) {
				if (!is_array($tokens[$i]) || T_FUNCTION !== $tokens[$i][0]) {
					continue;
				}

				// Walk to the opening parenthesis of the parameter list, then collect the
				// variables it declares. A type hint is a T_STRING and a default value holds no
				// variable, so every T_VARIABLE in there is a parameter.
				$j = $i + 1;
				while ($j < $count && '(' !== $tokens[$j]) {
					$j++;
				}

				$depth = 0;
				$seen  = array();

				for (; $j < $count; $j++) {
					$token = $tokens[$j];

					if (!is_array($token)) {
						if ('(' === $token) {
							$depth++;
						} elseif (')' === $token) {
							$depth--;
							if (0 === $depth) {
								break;
							}
						}
						continue;
					}

					if (T_VARIABLE === $token[0] && 1 === $depth) {
						if (isset($seen[$token[1]])) {
							return $token[1];
						}
						$seen[$token[1]] = true;
					}
				}

				// A closure that imports a variable it already takes as a parameter is the same
				// uncatchable compile error, worded differently ("Cannot use lexical variable
				// $x as a parameter name").
				for ($k = $j + 1; $k < $count; $k++) {
					$after = $tokens[$k];
					if (is_array($after) && in_array($after[0], array(T_WHITESPACE, T_COMMENT, T_DOC_COMMENT), true)) {
						continue;
					}
					if (is_array($after) && T_USE === $after[0]) {
						$depth = 0;
						for ($k++; $k < $count; $k++) {
							$token = $tokens[$k];
							if (!is_array($token)) {
								if ('(' === $token) {
									$depth++;
								} elseif (')' === $token) {
									$depth--;
									if (0 === $depth) {
										break;
									}
								}
								continue;
							}
							if (T_VARIABLE === $token[0] && 1 === $depth && isset($seen[$token[1]])) {
								return $token[1];
							}
						}
						$j = $k;
					}
					break;
				}

				$i = $j;
			}

			return '';
		}

		/**
		 * Top level function names declared by a snippet.
		 *
		 * Read off the token stream rather than matched with a regular expression, so closures,
		 * methods and the word "function" inside a string or a comment are not mistaken for
		 * declarations. Nested declarations are ignored: they only exist once their parent runs.
		 *
		 * @access public
		 * @param  string $mycode Code typed by the administrator.
		 * @return array          Function names, in order of appearance.
		 * @since 1.3
		 */
		public static function declared_functions($mycode) {
			$names = array();

			if (!is_string($mycode) || '' === trim($mycode)) {
				return $names;
			}

			try {
				$tokens = token_get_all('<?php ' . $mycode);
			} catch (\Throwable $e) {
				return $names;
			}

			$depth = 0;
			$count = count($tokens);

			for ($i = 0; $i < $count; $i++) {
				$token = $tokens[$i];

				if (!is_array($token)) {
					if ('{' === $token) {
						$depth++;
					} elseif ('}' === $token) {
						$depth--;
					}
					continue;
				}

				if (T_CURLY_OPEN === $token[0] || T_DOLLAR_OPEN_CURLY_BRACES === $token[0]) {
					$depth++;
					continue;
				}

				if (T_FUNCTION !== $token[0] || 0 !== $depth) {
					continue;
				}

				// Skip whitespace, comments and the by-reference ampersand to reach the name.
				for ($j = $i + 1; $j < $count; $j++) {
					$next = $tokens[$j];
					if (is_array($next) && in_array($next[0], array(T_WHITESPACE, T_COMMENT, T_DOC_COMMENT), true)) {
						continue;
					}
					// PHP 8.1 turned the by-reference "&" into an array token
					// (T_AMPERSAND_NOT_FOLLOWED_BY_VAR_OR_VARARG), so both shapes are checked.
					if ('&' === $next || (is_array($next) && isset($next[1]) && '&' === $next[1])) {
						continue;
					}
					if (is_array($next) && T_STRING === $next[0]) {
						$names[] = $next[1];
					}
					// Anything else here means a closure, which declares no name.
					break;
				}
			}

			return $names;
		}

	}

	endif;

wpematicohk_sintax::hooks();
