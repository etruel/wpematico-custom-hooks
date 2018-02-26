<?php

if ( !defined('ABSPATH')) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}
	$wpematicohk_data_filter_action = array();
	
	$active_plugins = get_option( 'active_plugins' );
	$active_plugins_names = array_map('basename', $active_plugins );


	//SET ACTIONS AND FILTERS WPEMATICO CAMPAIGN
 	array_push($wpematicohk_data_filter_action,
 		array(
			'name'=>'wpematico newimgname',
			'value'=>'wpematico_newimgname',
			'parameters'=>4,
			'template_parameter'=>'$imagen_src_real, $current_item, $campaign, $item',
			'type'=>'filter',
			'description'=>''
			
		),
		array(
			'name'=>'wpematico overwrite file',
			'value'=>'wpematico_overwrite_file',
			'parameters'=>0,
			'type'=>'filter',
			'description'=>''

		),
		array(
			'name'=>'wpematico yt altimg',
			'value'=>'wpematico_yt_altimg',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_title',
			'type'=>'filter',
			'description'=> ''

		),
		array(
			'name'=>'wpematico yt thumbnails',
			'value'=>'wpematico_yt_thumbnails',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_thumbnails',
			'type'=>'filter',
			'description'=>''

		),
		array(
			'name'=>'wpematico yt description',
			'value'=>'wpematico_yt_description',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_description',
			'type'=>'filter',
			'description'=>''

		),
		array(
			'name'=>'wpematico get post content feed',
			'value'=>'wpematico_get_post_content_feed',
			'parameters'=>4,
			'template_parameter'=>'$content,$campaign,$feed,$item',
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpematico excludes',
			'value'=>'wpematico_excludes',
			'parameters'=>4,
			'template_parameter'=>'$skip,$current_item,$campaign,$item',
			'type'=>'filter',
			'description'=> ''
		),
		array(
			'name'=>'wpematico item parsers',
			'value'=>'wpematico_item_parsers',
			'parameters'=>4,
			'template_parameter'=>'$current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpem dont strip tags',
			'value'=>'wpem_dont_strip_tags',
			'parameters'=>0,
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpematico post template tag',
			'value'=>'wpematico_post_template_tag',
			'parameters'=>5,
			'template_parameter'=>'$vars, $current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpematico post template replace',
			'value'=>'wpematico_post_template_replace',
			'parameters'=>5,
			'template_parameter'=>'$replace, $current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpematico after item parsers',
			'value'=>'wpematico_after_item_parsers',
			'parameters'=>4,
			'template_parameter'=>'$current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpematico add template vars',
			'value'=>'wpematico_add_template_vars',
			'parameters'=>5,
			'template_parameter'=>'$vars, $current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpematico pretags',
			'value'=>'wpematico_pretags',
			'parameters'=>3,
			'template_parameter'=>'$current_item, $item, $cfg',
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpematico postags',
			'value'=>'wpematico_postags',
			'parameters'=>3,
			'template_parameter'=>'$current_item, $item, $cfg',
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpepro full permalink',
			'value'=>'wpepro_full_permalink',
			'parameters'=>1,
			'template_parameter'=>'$permalink',
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpematico img src url',
			'value'=>'wpematico_img_src_url',
			'parameters'=>1,
			'template_parameter'=>'$imagen_src_real',
			'type'=>'filter',
			'description'=>''
		),
		array(
			'name'=>'wpematico_imagen_src',
			'value'=>'wpematico_imagen_src',
			'parameters'=>1,
			'template_parameter'=>'$imagen_src',
			'type'=>'filter',
			'description'=>''
			
		),
		array(
			'name'=>'wpematico allowext',
			'value'=>'wpematico_allowext',
			'parameters'=>1,
			'template_parameter'=>'$allowed',
			'type'=>'filter',
			'description'=>''
		),
		array( 
			'name'=>'wpematico_end_fetching', 
			'value'=>'wpematico_end_fetching', 
			'parameters'=>2, 
			'template_parameter'=>'$campaign,$fetched_posts ', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico_simplepie_url', 
			'value'=>'wpematico_simplepie_url', 
			'parameters'=>3, 
			'template_parameter'=>'$feed, $kf, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'Wpematico_process_fetching', 
			'value'=>'Wpematico_process_fetching', 
			'parameters'=>1, 
			'template_parameter'=>' $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpematico_get_author', 
			'value'=>'wpematico_get_author', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feedurl, $item ', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpematico_get_post_content', 
			'value'=>'wpematico_get_post_content', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item ', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico_item_filters_pre_img', 
			'value'=>'wpematico_item_filters_pre_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign ', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico_set_featured_img', 
			'value'=>'wpematico_set_featured_img', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed,$item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico_get_featured_img', 
			'value'=>'wpematico_get_featured_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item_images, $current_item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico_item_filters_pos_img', 
			'value'=>'wpematico_item_filters_pos_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign ', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem_meta_data', 
			'value'=>'wpem_meta_data', 
			'parameters'=>1, 
			'template_parameter'=>'$current_item', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem_parse_title', 
			'value'=>'wpem_parse_title', 
			'parameters'=>1, 
			'template_parameter'=>'$title', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpem_parse_content', 
			'value'=>'wpem_parse_content', 
			'parameters'=>1, 
			'template_parameter'=>'$content', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem_parse_name', 
			'value'=>'wpem_parse_name', 
			'parameters'=>1, 
			'template_parameter'=>'$slug', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem_parse_content_filtered', 
			'value'=>'wpem_parse_content_filtered', 
			'parameters'=>1, 
			'template_parameter'=>'$content', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem_parse_status', 
			'value'=>'wpem_parse_status', 
			'parameters'=>1, 
			'template_parameter'=>'$status', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem_parse_post_type', 
			'value'=>'wpem_parse_post_type', 
			'parameters'=>1, 
			'template_parameter'=>'$post_type', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem_parse_authorid', 
			'value'=>'wpem_parse_authorid', 
			'parameters'=>1, 
			'template_parameter'=>'$authorid', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem_parse_date', 
			'value'=>'wpem_parse_date', 
			'parameters'=>1, 
			'template_parameter'=>'$date', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem_parse_comment_status', 
			'value'=>'wpem_parse_comment_status', 
			'parameters'=>1, 
			'template_parameter'=>'$comment_status', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpematico_pre_insert_post', 
			'value'=>'wpematico_pre_insert_post', 
			'parameters'=>2, 
			'template_parameter'=>'$args, $this->campaign', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpematico_allow_insertpost', 
			'value'=>'wpematico_allow_insertpost', 
			'parameters'=>3, 
			'template_parameter'=>'$bool, $this, $args', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico_duplicates', 
			'value'=>'wpematico_duplicates', 
			'parameters'=>3, 
			'template_parameter'=>'$dev,$campaign,$item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
		'name'=>'wpematico_inserted_post', 
		'value'=>'wpematico_inserted_post', 
		'parameters'=>3, 
		'template_parameter'=>'$post_id, $campaign, $item ', 
		'type'=>'action', 
		'description'=>'' 
		)
	);


	//WPEMATICO ADD ONS PROFESIONAL
	if(array_search( 'wpematicopro.php', $active_plugins_names )!==FALSE){
		array_push($wpematicohk_data_filter_action,
					array( 
					'name'=>'wpematico_help_settings_rrewrites', 
					'value'=>'wpematico_help_settings_rrewrites', 
					'parameters'=>0, 
					'template_parameter'=>'', 
					'type'=>'filter', 
					'description'=>''
					),
					array( 
					'name'=>'wpe_pro_ramdom_rewrites_accept_word', 
					'value'=>'wpe_pro_ramdom_rewrites_accept_word', 
					'parameters'=>4, 
					'template_parameter'=>' true, $valw, $args, $campaign', 
					'type'=>'filter', 
					'description'=>''), 
					array( 
					'name'=>'wpe_pro_ramdom_rewrites_array', 
					'value'=>'wpe_pro_ramdom_rewrites_array', 
					'parameters'=>3, 
					'template_parameter'=>'$ramdom_rewrites_array,$args,$campaign', 
					'type'=>'filter', 
					'description'=>''),
					array( 
					'name'=>'wpem_autotags_min_length', 
					'value'=>'wpem_autotags_min_length', 
					'parameters'=>1, 
					'template_parameter'=>'$length', 
					'type'=>'filter', 
					'description'=>''),

					array( 
					'name'=>'wpematico_campaign_feed_advanced_options', 
					'value'=>'wpematico_campaign_feed_advanced_options', 
					'parameters'=>4, 
					'template_parameter'=>'$feed, $campaign_data, $cfgbasic, $key', 
					'type'=>'action', 
					'description'=>'')
					);
	}
	if(array_search('wpematico_fullcontent.php', $active_plugins_names )!==FALSE){
		//WPEMATICO ADD ONS FULL CONTENT
		array_push($wpematicohk_data_filter_action,
			array( 
			'name'=>'wpemfullcontent_websites_video', 
			'value'=>'wpemfullcontent_websites_video', 
			'parameters'=>1, 
			'template_parameter'=>'$website_videos', 
			'type'=>'filter', 
			'description'=>''
			), 
			array( 
			'name'=>'wpematico_fullcontent_folder', 
			'value'=>'wpematico_fullcontent_folder', 
			'parameters'=>1, 
			'template_parameter'=>'$customconfigdir', 
			'type'=>'filter', 
			'description'=>''
			), 
			array( 
			'name'=>'wpepro_getfullcontent', 
			'value'=>'wpepro_getfullcontent', 
			'parameters'=>2, 
			'template_parameter'=>'$permalink, $campaign', 
			'type'=>'filter', 
			'description'=>''  
			), 
			array( 
			'name'=>'full_html_content', 
			'value'=>'full_html_content', 
			'parameters'=>1, 
			'template_parameter'=>'$html', 
			'type'=>'filter', 
			'description'=>'' 
			), 
			array( 
			'name'=>'wpem_unlikelyCandidates_regexp', 
			'value'=>'wpem_unlikelyCandidates_regexp', 
			'parameters'=>1, 
			'template_parameter'=>'$unlikelyCandidates', 
			'type'=>'filter', 
			'description'=>''
			), 
			array( 
			'name'=>'wpem_okMaybeItsACandidate_regexp', 
			'value'=>'wpem_okMaybeItsACandidate_regexp', 
			'parameters'=>1, 
			'template_parameter'=>'$okMaybeItsACandidate', 
			'type'=>'filter', 
			'description'=>'' 
			), 
			array( 
			'name'=>'wpem_positive_regexp', 
			'value'=>'wpem_positive_regexp', 
			'parameters'=>1, 
			'template_parameter'=>'$positive', 
			'type'=>'filter', 
			'description'=>''
			), 
			array( 
			'name'=>'wpem_negative_regexp', 
			'value'=>'wpem_negative_regexp', 
			'parameters'=>1, 
			'template_parameter'=>'$negative', 
			'type'=>'filter', 
			'description'=>''
			), 
			array( 
			'name'=>'wpem_video_regexp', 
			'value'=>'wpem_video_regexp', 
			'parameters'=>1, 
			'template_parameter'=>'$regexvideo ', 
			'type'=>'filter', 
			'description'=>''
			),

			array( 
			'name'=>'after_full_html_content', 
			'value'=>'after_full_html_content', 
			'parameters'=>5, 
			'template_parameter'=>' $html, $current_item, $campaign, $feed, $item', 
			'type'=>'action', 
			'description'=>''
			)
		);
	}
	if(array_search('wpematico_polyglot.php', $active_plugins_names )!==FALSE){
		//WPEMATICO ADD ONS Polyglot
		array_push($wpematicohk_data_filter_action,
			array( 
			'name'=>'polyglot_can_use_api', 
			'value'=>'polyglot_can_use_api', 
			'parameters'=>2, 
			'template_parameter'=>' $ret, $api', 
			'type'=>'filter', 
			'description'=>'' 
			), 
			array( 
			'name'=>'polyglot_get_apis', 
			'value'=>'polyglot_get_apis', 
			'parameters'=>1, 
			'template_parameter'=>' $list_api', 
			'type'=>'filter', 
			'description'=>'' 
			), 
			array( 
			'name'=>'polyglot_get_idioms_options', 
			'value'=>'polyglot_get_idioms_options', 
			'parameters'=>1, 
			'template_parameter'=>' $options', 
			'type'=>'filter', 
			'description'=>'' 
			), 
			array( 
			'name'=>'polyglot_process_type', 
			'value'=>'polyglot_process_type', 
			'parameters'=>2, 
			'template_parameter'=>' $process, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
			), 
			array( 
			'name'=>'polyglot_process', 
			'value'=>'polyglot_process', 
			'parameters'=>1, 
			'template_parameter'=>'$process', 
			'type'=>'filter', 
			'description'=>'' 
			)
		);
	}
	//WPEMATICO ADD ONS  BETTER EXCERPTS
	if(array_search( 'wpematico_better_excerpts.php', $active_plugins_names )!==FALSE){
		array_push($wpematicohk_data_filter_action,
			array( 
			'name'=>'wpematico_better_excerpts_checks', 
			'value'=>'wpematico_better_excerpts_checks', 
			'parameters'=>1, 
			'template_parameter'=>'$better_excerpts', 
			'type'=>'filter', 
			'description'=>'' 
			),
			array( 
			'name'=>'wpem_after_better_excerpts_fields', 
			'value'=>'wpem_after_better_excerpts_fields', 
			'parameters'=>1, 
			'template_parameter'=>'$better_excerpts', 
			'type'=>'action', 
			'description'=>'' 
			)
		);
	}
	//WPEMATICO MAKE FULL
	if(array_search( 'make-me-feed.php', $active_plugins_names )!==FALSE){
		array_push($wpematicohk_data_filter_action,

			array( 
			'name'=>'make_me_feed_pre_save_post', 
			'value'=>'make_me_feed_pre_save_post', 
			'parameters'=>1, 
			'template_parameter'=>'$mmfdata', 
			'type'=>'filter', 
			'description'=>'' 
			), 
			array( 
			'name'=>'mmf_getcontents_args', 
			'value'=>'mmf_getcontents_args', 
			'parameters'=>1, 
			'template_parameter'=>'$curl', 
			'type'=>'filter', 
			'description'=>'' 
			),
			array( 
			'name'=>'make_me_feed_metaboxes', 
			'value'=>'make_me_feed_metaboxes', 
			'parameters'=>1, 
			'template_parameter'=>'$post', 
			'type'=>'action', 
			'description'=>'' 
			), 
			array( 
			'name'=>'make_me_feed_urls_box', 
			'value'=>'make_me_feed_urls_box', 
			'parameters'=>0, 
			'template_parameter'=>'', 
			'type'=>'action', 
			'description'=>'' 
			), 
			array( 
			'name'=>'make_me_feed_post_saved', 
			'value'=>'make_me_feed_post_saved', 
			'parameters'=>0, 
			'template_parameter'=>'', 
			'type'=>'action', 
			'description'=>'' 
			), 
			array( 
			'name'=>'mmf_testarea_before_getcontent', 
			'value'=>'mmf_testarea_before_getcontent', 
			'parameters'=>1, 
			'template_parameter'=>'$campaign', 
			'type'=>'action', 
			'description'=>'' 
			)
		);
	}
	//WPEMATICO ADD ONS wpematico_fb_fetcher
	if(array_search( 'wpematico_fb_fetcher', $active_plugins_names )!==FALSE){
		array_push($wpematicohk_data_filter_action,
			array( 
			'name'=>'fbf_campaign_post_type_array', 
			'value'=>'fbf_campaign_post_type_array', 
			'parameters'=>1, 
			'template_parameter'=>'$fbf_post_type_array', 
			'type'=>'filter', 
			'description'=>'' 
			)
		);
	}

$wpematicohk_data_filter_action = apply_filters('wpematico_hooks_data_filter_action', $wpematicohk_data_filter_action);
	
?>