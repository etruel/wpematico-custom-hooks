var codemirror_editor = Array();
jQuery(document).ready(function ($) {

	//create template function
	$(document).on('click', '.wpematicohk_button_addfunctions', function () {
		var hook = $('.wpematicohk_select_actions_filters').val();
		if (!hook) {
			return; // nothing picked: the placeholder is the "hooks in use" view, not a hook
		}
		wpematicohk_select_text = hook + "_callback";
		idtemp = 'wpematicohk_codemirror_' + hook;
		// The box may be hidden and its editor not built yet, so reveal first: CodeMirror sizes
		// itself on creation and comes out 0px tall inside a display:none parent.
		wpematicohk_reveal(hook);
		tagtypehook = $('.wpematicohk_select_actions_filters option:selected').attr('tagtypehook');
		template_parameter = $('.wpematicohk_select_actions_filters option:selected').attr('tagtemplateparameter');
		template_function = '\nfunction ' + wpematicohk_select_text + '(' + template_parameter + '){';
		//IF ACTION ON FILTER
		if (tagtypehook == 'filter') {
			varparameter = template_parameter.split(',');
			if (varparameter[0] == '')
				varparameter[0] = '""';
			template_function += '\n\treturn ' + varparameter[0] + ';\n';
		}

		template_function += '\n}';
		//refresh codemirror editor
		addCodemirrorFunction(idtemp, template_function);
		wpematicohk_codemirror_line_function(idtemp);
		$("textarea#" + idtemp).text(wpematicohkget_codemirror(idtemp));
		$('#' + hook).addClass('wpematicohk-has-code');
	});
	// On core 2.9 the tab lives inside core's own form, so there is no form of ours to submit and
	// core's "Save settings" button submits this tab too. Everything therefore hangs off the
	// form's submit event rather than off our button, so neither button can skip the syntax check.
	var wpematicohk_form = (typeof wpematicohk_object !== 'undefined' && wpematicohk_object.form_selector) ? wpematicohk_object.form_selector : '#wpematicohk_form';
	var wpematicohk_checked = false;

	$(document).on('click', '#wpematicohk_save_settings', function () {
		$(wpematicohk_form).trigger('submit');
	});

	$(document).on('submit', wpematicohk_form, function (e) {
		if (wpematicohk_checked) {
			return; // already validated, let it through
		}
		if ($('.wpematico-textarea-codemirror').length === 0) {
			return; // not the Hooks tab, this is core's own settings form
		}

		e.preventDefault();

		$(".wpematico-textarea-codemirror").each(function () {
			idtemp = $(this).attr("id");
			if (!codemirror_editor[idtemp]) {
				return; // never opened, so its textarea still holds what was stored
			}
			wpematicohk_codemirror_line_function(idtemp);
			$("textarea#" + idtemp).text(wpematicohkget_codemirror(idtemp));
		});
		$("#wpematicohk_sintax_error").css({'border-left': "4px solid #FFBA00"});
		$("#wpematicohk_sintax_error").text(wpematicohk_object.text_checking_syntax);
		$("#wpematicohk_sintax_error").fadeIn(300);
		wpematicohk_run_sintax();
	});

	// The catalogue prints a box per hook — 90-odd of them — so the list shows the hooks that
	// carry code and the picker reveals any other one on demand. The empty option is that same
	// view, not "show all": dumping ninety empty editors was never what anyone wanted to read.
	function wpematicohk_show_used() {
		$(".wpematicohk_dinamic_chaplain").not('.wpematicohk-has-code').hide(0);
		$(".wpematicohk_dinamic_chaplain.wpematicohk-has-code").show(0).each(function () {
			wpematicohk_ensure_editor('wpematicohk_codemirror_' + this.id);
		});
	}

	function wpematicohk_reveal(hook) {
		$(".wpematicohk_dinamic_chaplain").hide(0);
		$("#wpematicohk-empty-state").hide();
		$("#" + hook).show(0);
		wpematicohk_ensure_editor('wpematicohk_codemirror_' + hook);
	}

	wpematicohk_show_used();

	$(document).on('change', '.wpematicohk_select_actions_filters', function () {
		var hook = $(this).val();
		if (hook) {
			wpematicohk_reveal(hook);
		} else {
			$("#wpematicohk-empty-state").show();
			wpematicohk_show_used();
		}
	});
	//select theme editor
	$(document).on('change', '#wpematicohk_themes_selection_editor', function () {
		mytheme = $(this).val();
		$(".wpematico-textarea-codemirror").each(function () {
			idtemp = $(this).attr("id");
			if (codemirror_editor[idtemp]) {
				wpematicohk_selectTheme(mytheme, idtemp);
			}
		});
	});

	function wpematicohk_codemirror_line_function(idtemp) {
		cont_lines_code = 0;
		function_lines_code = '';
		$("textarea#" + idtemp + "").parent().find('.CodeMirror pre.CodeMirror-line').each(function (i) {
			if ($(this).find('span').text().indexOf(' function') > -1) {
				//none
			} else if ($(this).find('span').text().indexOf('function') > -1) {
				fn = $(this).find('span').text() + '}';
				fnStr = fn.toString().substr('function '.length),
						result_function = fnStr.substr(0, fnStr.indexOf('('));
				if (cont_lines_code > 0) {
					function_lines_code += ',' + result_function;
				} else {
					function_lines_code += result_function
				}
				;
				cont_lines_code++;
			}
		});
		//add functions split ,
		$("." + idtemp).val(function_lines_code);
	}

	// One CodeMirror per catalogue entry meant ~90 editors built on every page load to edit one.
	// They are built the first time their box is shown instead, and refreshed after, because an
	// editor created while hidden measures itself as empty.
	function wpematicohk_ensure_editor(idtemp) {
		if (!document.getElementById(idtemp)) {
			return null;
		}
		if (!codemirror_editor[idtemp]) {
			codemirror_editor[idtemp] = editor(idtemp);
		}
		codemirror_editor[idtemp].refresh();
		return codemirror_editor[idtemp];
	}
	//creating ajax function sintax ejecute
	function wpematicohk_run_sintax() {
		wpematico_textarea_codemirror = Array();
		wpematicohk_options_action_filters = Array();
		wpematicohk_functions_parameters = Array();
		wpematicohk_functions_action_filter = Array();

		$('.wpematicohk_options_action_filters').map(function (i, el) {
			wpematicohk_options_action_filters.push(el.value);
		});
		$('textarea.wpematico-textarea-codemirror').map(function (i, el) {
			wpematico_textarea_codemirror.push(el.value);
		});
		$('.wpematicohk_functions_parameters').map(function (i, el) {
			wpematicohk_functions_parameters.push(el.value);
		});
		$('.wpematicohk_functions_action_filter').map(function (i, el) {
			wpematicohk_functions_action_filter.push(el.value);
		});

		var data = {
			'action': 'wpematicohk_sintax',
			_ajax_nonce: wpematicohk_object.nonce,
			'wpematicohk_options_functions': wpematico_textarea_codemirror,
			'wpematicohk_options_action_filters': wpematicohk_options_action_filters,
			'wpematicohk_functions_parameters': wpematicohk_functions_parameters,
			'wpematicohk_functions_action_filter': wpematicohk_functions_action_filter

		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		// The endpoint answers with wp_send_json_success/_error, so the message is plain text and
		// goes in with .text(): no HTML, and no need to undo entity escaping by hand.
		jQuery.post(ajaxurl, data, null, 'json').done(function (response) {
			var box = $("#wpematicohk_sintax_error");

			if (response && response.success) {
				box.text(wpematicohk_object.text_no_error_syntax);
				box.css({'border-left': "4px solid #446320"});
				wpematicohk_checked = true;
				$(wpematicohk_form).trigger('submit');
				return;
			}

			var payload = (response && response.data) ? response.data : {};
			box.css({'border-left': "4px solid #C00000"});
			box.text(payload.message || wpematicohk_object.text_generic_error);
			if (payload.hook) {
				box.append($('<strong/>').text(' ' + wpematicohk_object.text_in_hook + ' ' + payload.hook));
			}
		}).fail(function () {
			$("#wpematicohk_sintax_error")
					.css({'border-left': "4px solid #C00000"})
					.text(wpematicohk_object.text_generic_error);
		});
	}


});

//Create Multiple Editors in CodeMirror
function editor(id)
{
	if (typeof wpversion === 'undefined') {
		config = {
			lineNumbers: true,
			mode: "htmlmixed",
			theme: wpematicohk_object.theme_editor,
			indentWithTabs: false,
			htmlMode: true,
			readOnly: false,
		};
		myeditor = CodeMirror.fromTextArea(document.getElementById(id), config);
	} else {
		myeditor = wp.codeEditor.initialize(jQuery("#" + id));
		myeditor = myeditor.codemirror;
	}
	return myeditor;
}
function wpematicohk_selectTheme(theme, id) {
	codemirror_editor[id].setOption("theme", theme);
}
function addCodemirrorFunction(id, myfunction) {
	codemirror_editor[id].setValue(codemirror_editor[id].getValue() + myfunction);
}
function wpematicohkget_codemirror(id) {
	return codemirror_editor[id].getValue();
}