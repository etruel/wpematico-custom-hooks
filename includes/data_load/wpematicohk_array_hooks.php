<?php
	$wpematicohk_data_filter_action = array(
		'hooks0'=>array(
			'name'=>'WP_HEAD',
			'value'=>'wp_head',
			'parameters'=>0,
			'template_parameter'=>'',
			'type'=>'action',
			'description'=>'Example Description wphead'
			
		),
		'hooks1'=>array(
			'name'=>'wpematico newimgname',
			'value'=>'wpematico_newimgname',
			'parameters'=>0,
			'template_parameter'=>'$imagen_src_real, $current_item, $campaign, $item',
			'type'=>'filter',
			'description'=>'Example Description newimgname'
			
		),
		'hooks2'=>array(
			'name'=>'wpematico overwrite file',
			'value'=>'wpematico_overwrite_file',
			'parameters'=>0,
			'type'=>'filter',
			'description'=>'Example Description overwrite file'

		),
		'hooks3'=>array(
			'name'=>'wpematico yt altimg',
			'value'=>'wpematico_yt_altimg',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_title',
			'type'=>'filter',
			'description'=> 'Example Description altimg'

		),
		'hooks4'=>array(
			'name'=>'wpematico yt thumbnails',
			'value'=>'wpematico_yt_thumbnails',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_thumbnails',
			'type'=>'filter',
			'description'=>'Example Description thumbnails'

		),
		'hooks5'=>array(
			'name'=>'wpematico yt description',
			'value'=>'wpematico_yt_description',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_description',
			'type'=>'filter',
			'description'=>'Example Description Enclosure'

		),
		'hooks6'=>array(
			'name'=>'wpematico get post content feed',
			'value'=>'wpematico_get_post_content_feed',
			'parameters'=>4,
			'template_parameter'=>'$content,$campaign,$feed,$item',
			'type'=>'filter',
			'description'=>'Example Description Get content feed'
		),
		'hooks7'=>array(
			'name'=>'wpematico excludes',
			'value'=>'wpematico_excludes',
			'parameters'=>4,
			'template_parameter'=>'$skip,$current_item,$campaign,$item',
			'type'=>'filter',
			'description'=> 'Example Description'
		),
		'hooks8'=>array(
			'name'=>'wpematico item parsers',
			'value'=>'wpematico_item_parsers',
			'parameters'=>4,
			'template_parameter'=>'$current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>'Example Description wpematico item parsers'
		),
		'hooks9'=>array(
			'name'=>'wpem dont strip tags',
			'value'=>'wpem_dont_strip_tags',
			'parameters'=>0,
			'type'=>'filter',
			'description'=>'Example Description Dont Strip tags'
		),
		'hooks10'=>array(
			'name'=>'wpematico post template tag',
			'value'=>'wpematico_post_template_tag',
			'parameters'=>5,
			'template_parameter'=>'$vars, $current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>'Example Description wphead'
		),
		'hooks11'=>array(
			'name'=>'wpematico post template replace',
			'value'=>'wpematico_post_template_replace',
			'parameters'=>5,
			'template_parameter'=>'$replace, $current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>'Example Description Wpematico post template replace'
		),
		'hooks12'=>array(
			'name'=>'wpematico after item parsers',
			'value'=>'wpematico_after_item_parsers',
			'parameters'=>4,
			'template_parameter'=>'$current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>'Example Description wphead'
		),
		'hooks13'=>array(
			'name'=>'wpematico add template vars',
			'value'=>'wpematico_add_template_vars',
			'parameters'=>5,
			'template_parameter'=>'$vars, $current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>'Example Description wphead'
		),
		'hooks14'=>array(
			'name'=>'wpematico pretags',
			'value'=>'wpematico_pretags',
			'parameters'=>3,
			'template_parameter'=>'$current_item, $item, $cfg',
			'type'=>'filter',
			'description'=>'Example Description wpematico_pretags'
		),
		'hooks15'=>array(
			'name'=>'wpematico postags',
			'value'=>'wpematico_postags',
			'parameters'=>5,
			'template_parameter'=>'$current_item, $item, $cfg',
			'type'=>'filter',
			'description'=>'Example Description wphead'
		),
		'hooks16'=>array(
			'name'=>'wpepro full permalink',
			'value'=>'wpepro_full_permalink',
			'parameters'=>1,
			'template_parameter'=>'$permalink',
			'type'=>'filter',
			'description'=>'Description Full Permanlink'
		),
		'hooks17'=>array(
			'name'=>'wpematico img src url',
			'value'=>'wpematico_img_src_url',
			'parameters'=>1,
			'template_parameter'=>'$imagen_src_real',
			'type'=>'filter',
			'description'=>'Description imagen src url'
		),
		'hooks18'=>array(
			'name'=>'wpematico allowext',
			'value'=>'wpematico_allowext',
			'parameters'=>1,
			'template_parameter'=>'$allowed',
			'type'=>'filter',
			'description'=>'Description allowed'
		),
		'hooks20'=>array( 
			'name'=>'wpematico_check_options', 
			'value'=>'wpematico_check_options', 
			'parameters'=>1, 
			'template_parameter'=>'$cfg', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_check_options' 
			), 
			'hooks21'=>array( 
			'name'=>'wpematico_more_options', 
			'value'=>'wpematico_more_options', 
			'parameters'=>2, 
			'template_parameter'=>' $cfg, $options', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_more_options' 
			), 
			'hooks22'=>array( 
			'name'=>'wpematico_check_campaigndata', 
			'value'=>'wpematico_check_campaigndata', 
			'parameters'=>1, 
			'template_parameter'=>' $campaign_data', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_check_campaigndata' 
			), 
			'hooks23'=>array( 
			'name'=>'wpematico_campaign_type_options', 
			'value'=>'wpematico_campaign_type_options', 
			'parameters'=>1, 
			'template_parameter'=>' $options', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_campaign_type_options' 
			), 
			'hooks24'=>array( 
			'name'=>'wpematico_cronperiods', 
			'value'=>'wpematico_cronperiods', 
			'parameters'=>1, 
			'template_parameter'=>' $cronperiods', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_cronperiods' 
			), 
			'hooks25'=>array( 
			'name'=>'wpematico_simplepie_url', 
			'value'=>'wpematico_simplepie_url', 
			'parameters'=>3, 
			'template_parameter'=>' $feed, $kf, $campaign', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_simplepie_url' 
			), 
			'hooks26'=>array( 
			'name'=>'Wpematico_process_fetching', 
			'value'=>'Wpematico_process_fetching', 
			'parameters'=>1, 
			'template_parameter'=>' $campaign', 
			'type'=>'filter', 
			'description'=>'Example Description Wpematico_process_fetching' 
			), 
			'hooks27'=>array( 
			'name'=>'wpematico_get_author', 
			'value'=>'wpematico_get_author', 
			'parameters'=>4, 
			'template_parameter'=>' $current_item, $campaign, $feedurl, $item ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_get_author' 
			), 
			'hooks29'=>array( 
			'name'=>'wpematico_get_post_content', 
			'value'=>'wpematico_get_post_content', 
			'parameters'=>4, 
			'template_parameter'=>' $current_item, $campaign, $feed, $item ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_get_post_content' 
			), 
			'hooks30'=>array( 
			'name'=>'wpematico_item_filters_pre_audio', 
			'value'=>'wpematico_item_filters_pre_audio', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_item_filters_pre_audio' 
			), 
			'hooks31'=>array( 
			'name'=>'wpematico_item_filters_pre_video', 
			'value'=>'wpematico_item_filters_pre_video', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_item_filters_pre_video' 
			), 
			'hooks32'=>array( 
			'name'=>'wpematico_item_filters_pre_img', 
			'value'=>'wpematico_item_filters_pre_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_item_filters_pre_img' 
			), 
			'hooks33'=>array( 
			'name'=>'wpematico_set_featured_img', 
			'value'=>'wpematico_set_featured_img', 
			'parameters'=>1, 
			'template_parameter'=>' ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_set_featured_img' 
			), 
			'hooks34'=>array( 
			'name'=>'wpematico_get_featured_img', 
			'value'=>'wpematico_get_featured_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item_images, $current_item', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_get_featured_img' 
			), 
			'hooks35'=>array( 
			'name'=>'wpematico_item_filters_pos_img', 
			'value'=>'wpematico_item_filters_pos_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_item_filters_pos_img' 
			), 
			'hooks36'=>array( 
			'name'=>'wpematico_addcat_description', 
			'value'=>'wpematico_addcat_description', 
			'parameters'=>1, 
			'template_parameter'=>'Auto Added by WPeMatico', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_addcat_description' 
			), 
			'hooks37'=>array( 
			'name'=>'wpem_meta_data', 
			'value'=>'wpem_meta_data', 
			'parameters'=>1, 
			'template_parameter'=>'$current_item', 
			'type'=>'filter', 
			'description'=>'Example Description wpem_meta_data' 
			), 
			'hooks38'=>array( 
			'name'=>'wpem_parse_title', 
			'value'=>'wpem_parse_title', 
			'parameters'=>1, 
			'template_parameter'=>'$title', 
			'type'=>'filter', 
			'description'=>'Example Description wpem_parse_title' 
			), 
			'hooks39'=>array( 
			'name'=>'wpematico_allowext', 
			'value'=>'wpematico_allowext', 
			'parameters'=>1, 
			'template_parameter'=>' $allowed ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_allowext' 
			), 
			'hooks21'=>array( 
			'name'=>'Wpematico_end_fetching', 
			'value'=>'Wpematico_end_fetching', 
			'parameters'=>2, 
			'template_parameter'=>'campaign,fetched_posts ', 
			'type'=>'filter', 
			'description'=>'Example Description Wpematico_end_fetching' 
			), 
			'hooks22'=>array( 
			'name'=>'wp_unique_post_slug_is_bad_flat_slug', 
			'value'=>'wp_unique_post_slug_is_bad_flat_slug', 
			'parameters'=>3, 
			'template_parameter'=>' false, $slug, $cpost_type ', 
			'type'=>'filter', 
			'description'=>'Example Description wp_unique_post_slug_is_bad_flat_slug' 
			),   
			'hooks34'=>array( 
			'name'=>'wpematico_audio_src_url', 
			'value'=>'wpematico_audio_src_url', 
			'parameters'=>1, 
			'template_parameter'=>' $audio_src_real ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_audio_src_url' 
			), 
			'hooks35'=>array( 
			'name'=>'wpematico_new_audio_name', 
			'value'=>'wpematico_new_audio_name', 
			'parameters'=>4, 
			'template_parameter'=>' sanitize_file_name(urlencode(basename($audio_src_real, $current_item, $campaign, $item', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_new_audio_name' 
			), 
			'hooks36'=>array( 
			'name'=>'wpematico_help_campaign', 
			'value'=>'wpematico_help_campaign', 
			'parameters'=>1, 
			'template_parameter'=>' $helpcampaign', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_help_campaign' 
			), 
			'hooks39'=>array( 
			'name'=>'wpematico_presave_campaign', 
			'value'=>'wpematico_presave_campaign', 
			'parameters'=>1, 
			'template_parameter'=>'$campaign', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_presave_campaign' 
			), 
			'hooks41'=>array( 
			'name'=>'new_bulk_actions-wpematico', 
			'value'=>'new_bulk_actions-wpematico', 
			'parameters'=>1, 
			'template_parameter'=>'$_bulk_actions', 
			'type'=>'filter', 
			'description'=>'Example Description new_bulk_actions-wpematico' 
			), 
			'hooks42'=>array( 
			'name'=>'wpematico_action_link', 
			'value'=>'wpematico_action_link', 
			'parameters'=>3, 
			'template_parameter'=>'$action,$post->ID, $context ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_action_link' 
			),  
			'hooks46'=>array( 
			'name'=>'wpematico_help_campaign_list', 
			'value'=>'wpematico_help_campaign_list', 
			'parameters'=>1, 
			'template_parameter'=>'$helpcampaignlist', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_help_campaign_list' 
			), 
			'hooks47'=>array( 
			'name'=>'wpematico_get_debug_sections', 
			'value'=>'wpematico_get_debug_sections', 
			'parameters'=>1, 
			'template_parameter'=>'$sections', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_get_debug_sections' 
			), 
			'hooks49'=>array( 
			'name'=>'wpematico_sysinfo_after_site_info', 
			'value'=>'wpematico_sysinfo_after_site_info', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_site_info' 
			), 
			'hooks50'=>array( 
			'name'=>'wpematico_sysinfo_after_user_browser', 
			'value'=>'wpematico_sysinfo_after_user_browser', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_user_browser' 
			), 
			'hooks51'=>array( 
			'name'=>'wpematico_sysinfo_after_wordpress_config', 
			'value'=>'wpematico_sysinfo_after_wordpress_config', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_wordpress_config' 
			), 
			'hooks52'=>array( 
			'name'=>'wpematico_sysinfo_after_webserver_config', 
			'value'=>'wpematico_sysinfo_after_webserver_config', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_webserver_config' 
			), 
			'hooks53'=>array( 
			'name'=>'wpematico_sysinfo_after_php_config', 
			'value'=>'wpematico_sysinfo_after_php_config', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_php_config' 
			), 
			'hooks54'=>array( 
			'name'=>'wpematico_sysinfo_after_php_ext', 
			'value'=>'wpematico_sysinfo_after_php_ext', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_php_ext' 
			), 
			'hooks55'=>array( 
			'name'=>'wpematico_sysinfo_after_simplepie_ext', 
			'value'=>'wpematico_sysinfo_after_simplepie_ext', 
			'parameters'=>1, 
			'template_parameter'=>' $return ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_simplepie_ext' 
			), 
			'hooks56'=>array( 
			'name'=>'wpematico_sysinfo_after_session_config', 
			'value'=>'wpematico_sysinfo_after_session_config', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_session_config' 
			), 
			'hooks57'=>array( 
			'name'=>'wpematico_sysinfo_after_wpematico_config', 
			'value'=>'wpematico_sysinfo_after_wpematico_config', 
			'parameters'=>1, 
			'template_parameter'=>' $return ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_wpematico_config' 
			), 
			'hooks58'=>array( 
			'name'=>'wpematico_sysinfo_after_wordpress_mu_plugins', 
			'value'=>'wpematico_sysinfo_after_wordpress_mu_plugins', 
			'parameters'=>1, 
			'template_parameter'=>' $return ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_wordpress_mu_plugins' 
			), 
			'hooks59'=>array( 
			'name'=>'wpematico_sysinfo_after_wordpress_plugins', 
			'value'=>'wpematico_sysinfo_after_wordpress_plugins', 
			'parameters'=>1, 
			'template_parameter'=>' $return ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_wordpress_plugins' 
			), 
			'hooks60'=>array( 
			'name'=>'wpematico_sysinfo_after_wordpress_plugins_inactive', 
			'value'=>'wpematico_sysinfo_after_wordpress_plugins_inactive', 
			'parameters'=>1, 
			'template_parameter'=>' $return ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_wordpress_plugins_inactive' 
			),
			'hooks62'=>array( 
			'name'=>'wpematico_sysinfo_after_get_defined_constants', 
			'value'=>'wpematico_sysinfo_after_get_defined_constants', 
			'parameters'=>1, 
			'template_parameter'=>' $return ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_sysinfo_after_get_defined_constants' 
			), 
			'hooks63'=>array( 
			'name'=>'wpematico_settings_tabs', 
			'value'=>'wpematico_settings_tabs', 
			'parameters'=>1, 
			'template_parameter'=>' $tabs ', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_settings_tabs' 
			), 

			'hooks65'=>array( 
			'name'=>'wpe_simplepie_timeout', 
			'value'=>'wpe_simplepie_timeout', 
			'parameters'=>1, 
			'template_parameter'=>'$count', 
			'type'=>'filter', 
			'description'=>'Example Description wpe_simplepie_timeout' 
			), 
			'hooks67'=>array( 
			'name'=>'wpematico_help_settings_before', 
			'value'=>'wpematico_help_settings_before', 
			'parameters'=>1, 
			'template_parameter'=>' $helpsettings', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_help_settings_before' 
			), 
			'hooks68'=>array( 
			'name'=>'wpematico_helptip_settings', 
			'value'=>'wpematico_helptip_settings', 
			'parameters'=>1, 
			'template_parameter'=>' $helptip', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_helptip_settings' 
			), 
			'hooks69'=>array( 
			'name'=>'wpematico_help_settings', 
			'value'=>'wpematico_help_settings', 
			'parameters'=>1, 
			'template_parameter'=>' $helpsettings', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_help_settings' 
			), 
			'hooks70'=>array( 
			'name'=>'wpematico_check_campaigndata', 
			'value'=>'wpematico_check_campaigndata', 
			'parameters'=>1, 
			'template_parameter'=>'$campaign_data', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_check_campaigndata' 
			), 
			'hooks71'=>array( 
			'name'=>'pro_check_campaigndata', 
			'value'=>'pro_check_campaigndata', 
			'parameters'=>2, 
			'template_parameter'=>' $campaigndata, $post_data', 
			'type'=>'filter', 
			'description'=>'Example Description pro_check_campaigndata' 
			), 
			'hooks72'=>array( 
			'name'=>'wpematico_before_update_campaign', 
			'value'=>'wpematico_before_update_campaign', 
			'parameters'=>1, 
			'template_parameter'=>' $campaign', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_before_update_campaign' 
			), 
			'hooks74'=>array( 
			'name'=>'wpematico_fetchfeed', 
			'value'=>'wpematico_fetchfeed', 
			'parameters'=>2, 
			'template_parameter'=>' $feed, $url', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_fetchfeed' 
			), 
			'hooks75'=>array( 
			'name'=>'wpematico_plugins_updater_args', 
			'value'=>'wpematico_plugins_updater_args', 
			'parameters'=>1, 
			'template_parameter'=>'$plugins_args', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_plugins_updater_args' 
			)
	);
	
	$active_plugins = get_option( 'active_plugins' );
	$active_plugins_names = array_map('basename', $active_plugins );
	//$is_pro_active = array_search( 'wpematico.php', $active_plugins_names );

	//WPEMATICO ADD ONS PROFESIONAL
	if(array_search( 'wpematicopro.php', $active_plugins_names )!==FALSE){
		array_push($wpematicohk_data_filter_action,
					array( 
					'name'=>'wpematico_help_settings_rrewrites', 
					'value'=>'wpematico_help_settings_rrewrites', 
					'parameters'=>0, 
					'template_parameter'=>'', 
					'type'=>'filter', 
					'description'=>'Example Description wpematico_help_settings_rrewrites'
					),
					array( 
					'name'=>'wpe_pro_ramdom_rewrites_accept_word', 
					'value'=>'wpe_pro_ramdom_rewrites_accept_word', 
					'parameters'=>4, 
					'template_parameter'=>' true, $valw, $args, $campaign', 
					'type'=>'filter', 
					'description'=>'Example Description wpe_pro_ramdom_rewrites_accept_word'), 
					array( 
					'name'=>'wpe_pro_ramdom_rewrites_array', 
					'value'=>'wpe_pro_ramdom_rewrites_array', 
					'parameters'=>3, 
					'template_parameter'=>'$ramdom_rewrites_array,$args,$campaign', 
					'type'=>'filter', 
					'description'=>'Example Description wpe_pro_ramdom_rewrites_array'),
					array( 
					'name'=>'wpem_autotags_min_length', 
					'value'=>'wpem_autotags_min_length', 
					'parameters'=>1, 
					'template_parameter'=>'$length', 
					'type'=>'filter', 
					'description'=>'Example Description wpem_autotags_min_length'),

					array( 
					'name'=>'wpematico_campaign_feed_advanced_options', 
					'value'=>'wpematico_campaign_feed_advanced_options', 
					'parameters'=>4, 
					'template_parameter'=>'$feed, $campaign_data, $cfgbasic, $key', 
					'type'=>'action', 
					'description'=>'Example Description wpematico_campaign_feed_advanced_options')
					);
	}
	if(array_search('wpematico_fullcontent.php', $active_plugins_names )!==FALSE){
		//WPEMATICO ADD ONS FULL CONTENT
		array_push($wpematicohk_data_filter_action,
			array( 
			'name'=>'wpemfullcontent_websites_video', 
			'value'=>'wpemfullcontent_websites_video', 
			'parameters'=>1, 
			'template_parameter'=>' $website_videos', 
			'type'=>'filter', 
			'description'=>'Example Description wpemfullcontent_websites_video'
			), 
			array( 
			'name'=>'wpematico_fullcontent_folder', 
			'value'=>'wpematico_fullcontent_folder', 
			'parameters'=>1, 
			'template_parameter'=>' $customconfigdir', 
			'type'=>'filter', 
			'description'=>'Example Description wpematico_fullcontent_folder'
			), 
			array( 
			'name'=>'wpepro_getfullcontent', 
			'value'=>'wpepro_getfullcontent', 
			'parameters'=>2, 
			'template_parameter'=>' $permalink, $campaign', 
			'type'=>'filter', 
			'description'=>'Example Description wpepro_getfullcontent'  
			), 
			array( 
			'name'=>'wpepro_getfullcontent', 
			'value'=>'wpepro_getfullcontent', 
			'parameters'=>2, 
			'template_parameter'=>' $next_page_url, $campaign', 
			'type'=>'filter', 
			'description'=>'Example Description wpepro_getfullcontent'  
			), 
			array( 
			'name'=>'full_html_content', 
			'value'=>'full_html_content', 
			'parameters'=>1, 
			'template_parameter'=>' $html', 
			'type'=>'filter', 
			'description'=>'Example Description full_html_content' 
			), 
			array( 
			'name'=>'wpem_unlikelyCandidates_regexp', 
			'value'=>'wpem_unlikelyCandidates_regexp', 
			'parameters'=>1, 
			'template_parameter'=>'$unlikelyCandidates', 
			'type'=>'filter', 
			'description'=>'Example Description wpem_unlikelyCandidates_regexp'
			), 
			array( 
			'name'=>'wpem_okMaybeItsACandidate_regexp', 
			'value'=>'wpem_okMaybeItsACandidate_regexp', 
			'parameters'=>1, 
			'template_parameter'=>'$okMaybeItsACandidate', 
			'type'=>'filter', 
			'description'=>'Example Description wpem_okMaybeItsACandidate_regexp' 
			), 
			array( 
			'name'=>'wpem_positive_regexp', 
			'value'=>'wpem_positive_regexp', 
			'parameters'=>1, 
			'template_parameter'=>'$positive', 
			'type'=>'filter', 
			'description'=>'Example Description wpem_positive_regexp'
			), 
			array( 
			'name'=>'wpem_negative_regexp', 
			'value'=>'wpem_negative_regexp', 
			'parameters'=>1, 
			'template_parameter'=>'$negative', 
			'type'=>'filter', 
			'description'=>'Example Description wpem_negative_regexp'
			), 
			array( 
			'name'=>'wpem_video_regexp', 
			'value'=>'wpem_video_regexp', 
			'parameters'=>1, 
			'template_parameter'=>'$regexvideo ', 
			'type'=>'filter', 
			'description'=>'Example Description wpem_video_regexp'
			),

			array( 
			'name'=>'after_full_html_content', 
			'value'=>'after_full_html_content', 
			'parameters'=>5, 
			'template_parameter'=>' $html, $current_item, $campaign, $feed, $item', 
			'type'=>'action', 
			'description'=>'Example Description after_full_html_content'
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
			'description'=>'Example Description polyglot_can_use_api' 
			), 
			array( 
			'name'=>'polyglot_get_apis', 
			'value'=>'polyglot_get_apis', 
			'parameters'=>1, 
			'template_parameter'=>' $list_api', 
			'type'=>'filter', 
			'description'=>'Example Description polyglot_get_apis' 
			), 
			array( 
			'name'=>'polyglot_get_idioms_options', 
			'value'=>'polyglot_get_idioms_options', 
			'parameters'=>1, 
			'template_parameter'=>' $options', 
			'type'=>'filter', 
			'description'=>'Example Description polyglot_get_idioms_options' 
			), 
			array( 
			'name'=>'polyglot_process_type', 
			'value'=>'polyglot_process_type', 
			'parameters'=>2, 
			'template_parameter'=>' $process, $campaign', 
			'type'=>'filter', 
			'description'=>'Example Description polyglot_process_type' 
			), 
			array( 
			'name'=>'polyglot_process', 
			'value'=>'polyglot_process_".$translate_process, $args, $campaign)', 
			'parameters'=>1, 
			'template_parameter'=>'', 
			'type'=>'filter', 
			'description'=>'Example Description polyglot_process' 
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
			'description'=>'Example Description wpematico_better_excerpts_checks' 
			),
			array( 
			'name'=>'wpem_after_better_excerpts_fields', 
			'value'=>'wpem_after_better_excerpts_fields', 
			'parameters'=>1, 
			'template_parameter'=>'$better_excerpts', 
			'type'=>'action', 
			'description'=>'Example Description wpem_after_better_excerpts_fields' 
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
			'description'=>'Example Description make_me_feed_pre_save_post' 
			), 
			array( 
			'name'=>'mmf_getcontents_args', 
			'value'=>'mmf_getcontents_args', 
			'parameters'=>1, 
			'template_parameter'=>'array("curl"=>TRUE)', 
			'type'=>'filter', 
			'description'=>'Example Description mmf_getcontents_args' 
			),
			array( 
			'name'=>'make_me_feed_metaboxes', 
			'value'=>'make_me_feed_metaboxes', 
			'parameters'=>1, 
			'template_parameter'=>'$post', 
			'type'=>'action', 
			'description'=>'Example Description make_me_feed_metaboxes' 
			), 
			array( 
			'name'=>'make_me_feed_urls_box', 
			'value'=>'make_me_feed_urls_box', 
			'parameters'=>0, 
			'template_parameter'=>'', 
			'type'=>'action', 
			'description'=>'Example Description make_me_feed_urls_box' 
			), 
			array( 
			'name'=>'make_me_feed_post_saved', 
			'value'=>'make_me_feed_post_saved', 
			'parameters'=>0, 
			'template_parameter'=>'', 
			'type'=>'action', 
			'description'=>'Example Description make_me_feed_post_saved' 
			), 
			array( 
			'name'=>'mmf_testarea_before_getcontent', 
			'value'=>'mmf_testarea_before_getcontent', 
			'parameters'=>1, 
			'template_parameter'=>'$campaign', 
			'type'=>'action', 
			'description'=>'Example Description mmf_testarea_before_getcontent' 
			), 
			array( 
			'name'=>'mmf_testarea_before_getcontent', 
			'value'=>'mmf_testarea_before_getcontent', 
			'parameters'=>1, 
			'template_parameter'=>'$campaign', 
			'type'=>'action', 
			'description'=>'Example Description mmf_testarea_before_getcontent' 
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
			'description'=>'Example Description fbf_campaign_post_type_array' 
			)
		);
	}


	//SET ACTIONS WPEMATICO
	array_push($wpematicohk_data_filter_action,
		array( 
		'name'=>'wpematico_create_metaboxes', 
		'value'=>'wpematico_create_metaboxes', 
		'parameters'=>2, 
		'template_parameter'=>'$campaign_data,$cfg', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_create_metaboxes' 
		), 
		array( 
		'name'=>'wpematico_before_template_box', 
		'value'=>'wpematico_before_template_box', 
		'parameters'=>2, 
		'template_parameter'=>'$post, $cfg', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_before_template_box' 
		), 
		array( 
		'name'=>'wpematico_after_template_box', 
		'value'=>'wpematico_after_template_box', 
		'parameters'=>2, 
		'template_parameter'=>'$post, $cfg', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_after_template_box' 
		), 
		array( 
		'name'=>'wpematico_permalinks_tools', 
		'value'=>'wpematico_permalinks_tools', 
		'parameters'=>2, 
		'template_parameter'=>'$campaign_data,$cfg', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_permalinks_tools' 
		), 
		array( 
		'name'=>'wpematico_campaign_feed_header_column', 
		'value'=>'wpematico_campaign_feed_header_column', 
		'parameters'=>0, 
		'template_parameter'=>'', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_campaign_feed_header_column' 
		), 
		array( 
		'name'=>'wpematico_campaign_feed_body_column', 
		'value'=>'wpematico_campaign_feed_body_column', 
		'parameters'=>3, 
		'template_parameter'=>'$feed,$cfg, $i', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_campaign_feed_body_column' 
		), 
		array( 
		'name'=>'wpematico_campaign_feed_panel', 
		'value'=>'wpematico_campaign_feed_panel', 
		'parameters'=>0, 
		'template_parameter'=>'', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_campaign_feed_panel' 
		), 
		array( 
		'name'=>'wpematico_campaign_feed_panel_buttons', 
		'value'=>'wpematico_campaign_feed_panel_buttons', 
		'parameters'=>0, 
		'template_parameter'=>'', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_campaign_feed_panel_buttons' 
		), 
		array( 
		'name'=>'Wpematico_init_fetching', 
		'value'=>'Wpematico_init_fetching', 
		'parameters'=>1, 
		'template_parameter'=>'$campaign', 
		'type'=>'action', 
		'description'=>'Example Description Wpematico_init_fetching' 
		), 
		array( 
		'name'=>'wpematico_chinese_tags', 
		'value'=>'wpematico_chinese_tags', 
		'parameters'=>3, 
		'template_parameter'=>'$post_id,$content,$campaign', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_chinese_tags' 
		), 
		array( 
		'name'=>'wpematico_inserted_post', 
		'value'=>'wpematico_inserted_post', 
		'parameters'=>3, 
		'template_parameter'=>'$post_id, $campaign, $item ', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_inserted_post' 
		), 
		array( 
		'name'=>'wpematico_smtp_email', 
		'value'=>'wpematico_smtp_email', 
		'parameters'=>0, 
		'template_parameter'=>'', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_smtp_email' 
		), 
		array( 
		'name'=>'wpematico_setting_page_before', 
		'value'=>'wpematico_setting_page_before', 
		'parameters'=>1, 
		'template_parameter'=>'', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_setting_page_before' 
		), 
		array( 
		'name'=>'wpematico_settings_images', 
		'value'=>'wpematico_settings_images', 
		'parameters'=>1, 
		'template_parameter'=>'$cfg', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_settings_images' 
		), 
		array( 
		'name'=>'wpematico_settings_audios', 
		'value'=>'wpematico_settings_audios', 
		'parameters'=>1, 
		'template_parameter'=>'$cfg', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_settings_audios' 
		), 
		array( 
		'name'=>'wpematico_settings_videos', 
		'value'=>'wpematico_settings_videos', 
		'parameters'=>1, 
		'template_parameter'=>'$cfg', 
		'type'=>'action', 
		'description'=>'Example Description wpematico_settings_videos' 
		)
	);

	
?>