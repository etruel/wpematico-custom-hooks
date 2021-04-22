var codemirror_editor = Array();
jQuery(document).ready(function ($) {

	//create template function
	$(document).on('click', '.wpematicohk_button_addfunctions', function () {
		wpematicohk_select_text = $('.wpematicohk_select_actions_filters').val() + "_callback";
		idtemp = 'wpematicohk_codemirror_' + $('.wpematicohk_select_actions_filters').val();
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
	});
	$(document).on('click', '#wpematicohk_save_settings', function () {
		$(".wpematico-textarea-codemirror").each(function () {
			idtemp = $(this).attr("id");
			wpematicohk_codemirror_line_function(idtemp);
			$("textarea#" + idtemp).text(wpematicohkget_codemirror(idtemp));
		});
		$("#wpematicohk_sintax_error").css({'border-left': "4px solid #FFBA00"});
		$("#wpematicohk_sintax_error").text(wpematicohk_object.text_checking_syntax);
		$("#wpematicohk_sintax_error").fadeIn(300);
		wpematicohk_run_sintax();

	});

	var idArray = [];
	var count = 0;
	$('.wpematicohk_dinamic_metabox').each(function () {
		idArray.push(this.id);
		if ($('#wpematicohk_codemirror_' + idArray[count]).val() != '') {
			$('#' + idArray[count]).show();
		} else {
			$('#' + idArray[count]).hide();
		}
		count++;
	});

	$(document).on('change', '.wpematicohk_select_actions_filters', function () {
		wpematicohk_select_text = $('.wpematicohk_select_actions_filters').val();
		if (wpematicohk_select_text != '') {
			$(".wpematicohk_dinamic_chaplain").hide(0);
			$("." + wpematicohk_select_text).show(0);
		} else {
			$(".wpematicohk_dinamic_chaplain").show(0);
		}
	});
	//select theme editor
	$(document).on('change', '#wpematicohk_themes_selection_editor', function () {
		mytheme = $(this).val();
		$(".wpematico-textarea-codemirror").each(function () {
			idtemp = $(this).attr("id");
			wpematicohk_selectTheme(mytheme, idtemp);
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

	//create Multiple Editors in codemirror javascript each
	function multiple_codemirror() {
		$(".wpematico-textarea-codemirror").each(function () {
			idtemp = $(this).attr("id");
			codemirror_editor[idtemp] = editor(idtemp);
			codemirror_editor[idtemp].refresh();
		});
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

		String.prototype.replaceAll = function (search, replacement) {
			var target = this;
			return target.split(search).join(replacement);
		};
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function (response) {
			if (response.indexOf('no-error-hook') == (-1)) {
				$("#wpematicohk_sintax_error").css({'border-left': "4px solid #C00000"});
				response = response.replaceAll('&lt;br /&gt;', '<br />');
				response = response.replaceAll('&lt;b&gt;', '<b>');
				response = response.replaceAll('&lt;/b&gt;', '</b>');
				$("#wpematicohk_sintax_error").html(response);
			} else {
				$("#wpematicohk_sintax_error").text(wpematicohk_object.text_no_error_syntax);
				$("#wpematicohk_sintax_error").css({'border-left': "4px solid #446320"});
				$("#wpematicohk_form").submit();
			}
		});
	}


	multiple_codemirror();
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