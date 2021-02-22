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
			'name'=>'wpematico custom chrset',
			'value'=>'wpematico_custom_chrset',
			'parameters'=>1,
			'template_parameter'=>'$string',
			'type'=>'filter',
			'description'=>'This filter convert a string to UTF-8 if its has a different encoding.'
			
		),
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
			'parameters'=>1,
			'template_parameter'=>'$new_file',
			'type'=>'filter',
			'description'=>'Filter to avoid download and return just the new name as it was downloaded.'

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
			'description'=> 'Filter to skip item or not'
		),
		array(
			'name'=>'wpematico item parsers',
			'value'=>'wpematico_item_parsers',
			'parameters'=>4,
			'template_parameter'=>'$current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>'Parses an item content'
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
			'description'=>'Filters an item content'
		),
		array(
			'name'=>'wpematico postags',
			'value'=>'wpematico_postags',
			'parameters'=>3,
			'template_parameter'=>'$current_item, $item, $cfg',
			'type'=>'filter',
			'description'=>'Filters an item content'
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
			'description'=>'original source'
		),
		array(
			'name'=>'wpematico imagen src',
			'value'=>'wpematico_imagen_src',
			'parameters'=>1,
			'template_parameter'=>'$imagen_src',
			'type'=>'filter',
			'description'=>'allow strip parts'
			
		),
		array(
			'name'=>'wpematico allowext',
			'value'=>'wpematico_allowext',
			'parameters'=>1,
			'template_parameter'=>'$allowed',
			'type'=>'filter',
			'description'=>'Fetch and Store the Image'
		),
		array( 
			'name'=>'wpematico end fetching', 
			'value'=>'wpematico_end_fetching', 
			'parameters'=>2, 
			'template_parameter'=>'$campaign,$fetched_posts ', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico help campaign', 
			'value'=>'wpematico_help_campaign', 
			'parameters'=>1, 
			'template_parameter'=>'$helpcampaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico simplepie url', 
			'value'=>'wpematico_simplepie_url', 
			'parameters'=>3, 
			'template_parameter'=>'$feed, $kf, $campaign', 
			'type'=>'filter', 
			'description'=>'This filter is used to access the feed' 
		), 
		array( 
			'name'=>'Wpematico process fetching', 
			'value'=>'Wpematico_process_fetching', 
			'parameters'=>1, 
			'template_parameter'=>' $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpematico get author', 
			'value'=>'wpematico_get_author', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feedurl, $item ', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpematico get post content', 
			'value'=>'wpematico_get_post_content', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item ', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico item filters pre img', 
			'value'=>'wpematico_item_filters_pre_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign ', 
			'type'=>'filter', 
			'description'=>'Parse and upload images' 
		),
		array( 
			'name'=>'wpematico set featured img', 
			'value'=>'wpematico_set_featured_img', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed,$item', 
			'type'=>'filter', 
			'description'=>'Gets images array ' 
		),
		array( 
			'name'=>'wpematico get featured img', 
			'value'=>'wpematico_get_featured_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item_images, $current_item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico item filters pos img', 
			'value'=>'wpematico_item_filters_pos_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign ', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico before insert autocats', 
			'value'=>'wpematico_before_insert_autocats', 
			'parameters'=>2, 
			'template_parameter'=>' $autocats, $this ', 
			'type'=>'filter', 
			'description'=>'Filters the array of categories obtained by simplepie to be parsed before inserted into the database' 
		),  
		array( 
			'name'=>'wpem meta data', 
			'value'=>'wpem_meta_data', 
			'parameters'=>1, 
			'template_parameter'=>'$current_item', 
			'type'=>'filter', 
			'description'=>'Filter the array of meta fields to be parsed before attached to the post.' 
		), 
		array( 
			'name'=>'wpem parse title', 
			'value'=>'wpem_parse_title', 
			'parameters'=>1, 
			'template_parameter'=>'$title', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpem parse content', 
			'value'=>'wpem_parse_content', 
			'parameters'=>1, 
			'template_parameter'=>'$content', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem parse name', 
			'value'=>'wpem_parse_name', 
			'parameters'=>1, 
			'template_parameter'=>'$slug', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem parse content filtered', 
			'value'=>'wpem_parse_content_filtered', 
			'parameters'=>1, 
			'template_parameter'=>'$content', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem parse status', 
			'value'=>'wpem_parse_status', 
			'parameters'=>1, 
			'template_parameter'=>'$status', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem parse post type', 
			'value'=>'wpem_parse_post_type', 
			'parameters'=>1, 
			'template_parameter'=>'$post_type', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem parse authorid', 
			'value'=>'wpem_parse_authorid', 
			'parameters'=>1, 
			'template_parameter'=>'$authorid', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem parse date', 
			'value'=>'wpem_parse_date', 
			'parameters'=>1, 
			'template_parameter'=>'$date', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpem parse comment status', 
			'value'=>'wpem_parse_comment_status', 
			'parameters'=>1, 
			'template_parameter'=>'$comment_status', 
			'type'=>'filter', 
			'description'=>'' 
		), 
		array( 
			'name'=>'wpematico pre insert post', 
			'value'=>'wpematico_pre_insert_post', 
			'parameters'=>2,
			'template_parameter'=>'$args, $campaign', 
			'type'=>'filter', 
			'description'=>''
		), 
		array( 
			'name'=>'wpematico allow insertpost', 
			'value'=>'wpematico_allow_insertpost', 
			'parameters'=>3, 
			'template_parameter'=>'$bool, $this, $args', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico duplicates', 
			'value'=>'wpematico_duplicates', 
			'parameters'=>3, 
			'template_parameter'=>'$dev,$campaign,$item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico inserted post', 
			'value'=>'wpematico_inserted_post', 
			'parameters'=>3, 
			'template_parameter'=>'$post_id, $campaign, $item ', 
			'type'=>'action', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico addcat description', 
			'value'=>'wpematico_addcat_description', 
			'parameters'=>2, 
			'template_parameter'=>'$message,$catname', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico get item images', 
			'value'=>'wpematico_get_item_images', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $item, $options_images', 
			'type'=>'filter', 
			'description'=>'Runs after get all the images from the item content.
			' 
		),
		/***************************************************************/
		/*******************NEW FILTERS 1.2 VERSION*********************/
		/***************************************************************/
		array( 
			'name'=>'wpematico check options', 
			'value'=>'wpematico_check_options', 
			'parameters'=>1, 
			'template_parameter'=>'$cfg', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico get debug sections', 
			'value'=>'wpematico_get_debug_sections', 
			'parameters'=>1, 
			'template_parameter'=>'$sections', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico settings tabs', 
			'value'=>'wpematico_settings_tabs', 
			'parameters'=>1, 
			'template_parameter'=>'$tabs', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico xml data before parse', 
			'value'=>'wpematico_xml_data_before_parse', 
			'parameters'=>2, 
			'template_parameter'=>'$data_xml,$campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico xml simplepie item before add', 
			'value'=>'wpematico_xml_simplepie_item_before_add', 
			'parameters'=>4, 
			'template_parameter'=>'$new_simplepie_item, $key_node_title, $xml, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico xml campaign data ajax', 
			'value'=>'wpematico_xml_campaign_data_ajax', 
			'parameters'=>2, 
			'template_parameter'=>'$campaign_data, $_REQUEST', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico xml fetch feed params', 
			'value'=>'wpematico_xml_fetch_feed_params', 
			'parameters'=>3, 
			'template_parameter'=>'$fetch_feed_params, 0, $campaign_data', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico xml is not allowed', 
			'value'=>'wpematico_xml_is_not_allowed', 
			'parameters'=>2, 
			'template_parameter'=>'$simplepie_error,$campaign_data ', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after host info', 
			'value'=>'wpematico_sysinfo_after_host_info', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after webserver config', 
			'value'=>'wpematico_sysinfo_after_webserver_config', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after apache mods', 
			'value'=>'wpematico_sysinfo_after_apache_mods', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after php config', 
			'value'=>'wpematico_sysinfo_after_php_config', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after simplepie ext', 
			'value'=>'wpematico_sysinfo_after_simplepie_ext', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after php ext', 
			'value'=>'wpematico_sysinfo_after_php_ext', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after user browser', 
			'value'=>'wpematico_sysinfo_after_user_browser', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after site info', 
			'value'=>'wpematico_sysinfo_after_site_info', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after wordpress config', 
			'value'=>'wpematico_sysinfo_after_wordpress_config', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after wpematico config', 
			'value'=>'wpematico_sysinfo_after_wpematico_config', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after wordpress mu plugins', 
			'value'=>'wpematico_sysinfo_after_wordpress_mu_plugins', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after wordpress plugins', 
			'value'=>'wpematico_sysinfo_after_wordpress_plugins', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after wordpress plugins inactive', 
			'value'=>'wpematico_sysinfo_after_wordpress_plugins_inactive', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after wordpress scheduled crons', 
			'value'=>'wpematico_sysinfo_after_wordpress_scheduled_crons', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after get defined constants', 
			'value'=>'wpematico_sysinfo_after_get_defined_constants', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico help settings before', 
			'value'=>'wpematico_help_settings_before', 
			'parameters'=>1, 
			'template_parameter'=>'$helpsettings', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico debug constants', 
			'value'=>'wpematico_debug_constants', 
			'parameters'=>1, 
			'template_parameter'=>'$debug_constants', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico sysinfo after session config', 
			'value'=>'wpematico_sysinfo_after_session_config', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'admin memory limit', 
			'value'=>'admin_memory_limit', 
			'parameters'=>1, 
			'template_parameter'=>'$memory', 
			'type'=>'filter', 
			'description'=>'This filter is used to change the memory limit. default is "256M"' 
		),
		array( 
			'name'=>'wpematico fetch feed params', 
			'value'=>'wpematico_fetch_feed_params', 
			'parameters'=>3, 
			'template_parameter'=>'$fetch_feed_params, $kf, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico max duplicated hashes count', 
			'value'=>'wpematico_max_duplicated_hashes_count', 
			'parameters'=>3, 
			'template_parameter'=>'20, $this->campaign_id, $feed', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico get feeddate', 
			'value'=>'wpematico_get_feeddate', 
			'parameters'=>5, 
			'template_parameter'=>'$itemdate, $current_item, $campaign, $feedurl, $item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico get post excerpt feed', 
			'value'=>'wpematico_get_post_excerpt_feed', 
			'parameters'=>4, 
			'template_parameter'=>'$item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico item pre media', 
			'value'=>'wpematico_item_pre_media', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico help campaign list', 
			'value'=>'wpematico_help_campaign_list', 
			'parameters'=>1, 
			'template_parameter'=>'$helpcampaignlist', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico item filters pre audio', 
			'value'=>'wpematico_item_filters_pre_audio', 
			'parameters'=>2, 
			'template_parameter'=>'$current_item, $campaign', 
			'type'=>'filter', 
			'description'=>'Parse and upload audio' 
		),
		array( 
			'name'=>'wpematico item filters pre video', 
			'value'=>'wpematico_item_filters_pre_video', 
			'parameters'=>2, 
			'template_parameter'=>'$current_item, $campaign', 
			'type'=>'filter', 
			'description'=>'Parse and upload video' 
		),
		array( 
			'name'=>'wpematico item pos media', 
			'value'=>'wpematico_item_pos_media', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico pos item filters', 
			'value'=>'wpematico_pos_item_filters', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpem parse excerpt', 
			'value'=>'wpem_parse_excerpt', 
			'parameters'=>1, 
			'template_parameter'=>'$excerpt', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpem parse parent', 
			'value'=>'wpem_parse_parent', 
			'parameters'=>1, 
			'template_parameter'=>'$post_parent', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico featured image attach id', 
			'value'=>'wpematico_featured_image_attach_id', 
			'parameters'=>5, 
			'template_parameter'=>'$featured_image_attach_id, $post_id, $current_item, $campaign, $item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'Wpematico end fetching', 
			'value'=>'Wpematico_end_fetching', 
			'parameters'=>2, 
			'template_parameter'=>'$campaign, $fetched_posts', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico categories after filters', 
			'value'=>'wpematico_categories_after_filters', 
			'parameters'=>3, 
			'template_parameter'=>'$categories, $item, $cfg', 
			'type'=>'filter', 
			'description'=>'Filter the array of categories to be parsed before inserted into the database.' 
		),
		array( 
			'name'=>'wpematico images parser', 
			'value'=>'wpematico_images_parser', 
			'parameters'=>6, 
			'template_parameter'=>'"default", $current_item, $campaign, $feed, $item, $options_images', 
			'type'=>'filter', 
			'description'=>'Filters images, upload and replace on text item content' 
		),
		array( 
			'name'=>'wpematico pattern img', 
			'value'=>'wpematico_pattern_img', 
			'parameters'=>1, 
			'template_parameter'=>'"/<img[^>]+>/i"', 
			'type'=>'filter', 
			'description'=>'Returns all images of the content' 
		),
		array( 
			'name'=>'wpematico fifu meta', 
			'value'=>'wpematico_fifu_meta', 
			'parameters'=>2, 
			'template_parameter'=>'$wpematico_fifu_meta, $current_item', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico yt video', 
			'value'=>'wpematico_yt_video', 
			'parameters'=>1, 
			'template_parameter'=>'$video', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico get item audios', 
			'value'=>'wpematico_get_item_audios', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $item, $options_audios', 
			'type'=>'filter', 
			'description'=>'Filters audios, upload and replace on text item content' 
		),
		array( 
			'name'=>'wpematico audio src url', 
			'value'=>'wpematico_audio_src_url', 
			'parameters'=>1, 
			'template_parameter'=>'$audio_src_real', 
			'type'=>'filter', 
			'description'=>'Strip all white space on audios URLs.' 
		),
		array( 
			'name'=>'wpematico allowext audio', 
			'value'=>'wpematico_allowext_audio', 
			'parameters'=>1, 
			'template_parameter'=>'$allowed_audio', 
			'type'=>'filter', 
			'description'=>'Strip all white space on audios original source.' 
		),
		array( 
			'name'=>'wpematico new audio name', 
			'value'=>'wpematico_new_audio_name', 
			'parameters'=>4, 
			'template_parameter'=>'sanitize_file_name(urlencode(basename($audio_src_without_query))), $current_item, $options_audios, $item', 
			'type'=>'filter', 
			'description'=>'Strip all white space on audios store.' 
		),
		array( 
			'name'=>'wpematico get item videos', 
			'value'=>'wpematico_get_item_videos', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $item, $options_videos', 
			'type'=>'filter', 
			'description'=>'Filters videos, upload and replace on text item content' 
		),
		array( 
			'name'=>'wpematico video src url', 
			'value'=>'wpematico_video_src_url', 
			'parameters'=>1, 
			'template_parameter'=>'$video_src_real', 
			'type'=>'filter', 
			'description'=>'Strip all white space on videos URLs.' 
		),
		array( 
			'name'=>'wpematico allowext video', 
			'value'=>'wpematico_allowext_video', 
			'parameters'=>1, 
			'template_parameter'=>'$allowed_video', 
			'type'=>'filter', 
			'description'=>'Strip all white space on videos original source.' 
		),
		array( 
			'name'=>'wpematico new video name', 
			'value'=>'wpematico_new_video_name', 
			'parameters'=>4, 
			'template_parameter'=>'sanitize_file_name(urlencode(basename($video_src_without_query))), $current_item, $campaign, $item', 
			'type'=>'filter', 
			'description'=>'Strip all white space on videos store .' 
		),
		array( 
			'name'=>'wpematico check campaigndata', 
			'value'=>'wpematico_check_campaigndata', 
			'parameters'=>1, 
			'template_parameter'=>'$campaign', 
			'type'=>'filter', 
			'description'=>'Filter to sanitize and strip all fields' 
		),
		array( 
			'name'=>'wpematico campaign type options', 
			'value'=>'wpematico_campaign_type_options', 
			'parameters'=>1, 
			'template_parameter'=>'$options', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico template tags campaign edit', 
			'value'=>'wpematico_template_tags_campaign_edit', 
			'parameters'=>1, 
			'template_parameter'=>'$tags_array', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico cronperiods', 
			'value'=>'wpematico_cronperiods', 
			'parameters'=>1, 
			'template_parameter'=>'$cronperiods', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico campaign type validate feed before save', 
			'value'=>'wpematico_campaign_type_validate_feed_before_save', 
			'parameters'=>2, 
			'template_parameter'=>'array("feed", "youtube", "bbpress", "ebay"), $_POST', 
			'type'=>'filter', 
			'description'=>'This filter   allow add campaigns types fields to be checked.  ' 
		),
		array( 
			'name'=>'wpematico check fetch feed params', 
			'value'=>'wpematico_check_fetch_feed_params', 
			'parameters'=>3, 
			'template_parameter'=>'$fetch_feed_params, $kf, $post_campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico presave campaign', 
			'value'=>'wpematico_presave_campaign', 
			'parameters'=>1, 
			'template_parameter'=>'$campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico preview fetch feed params', 
			'value'=>'wpematico_preview_fetch_feed_params', 
			'parameters'=>2, 
			'template_parameter'=>'$fetch_feed_params, 0, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico preview item_fetch params', 
			'value'=>'wpematico_preview_item_fetch_params', 
			'parameters'=>3, 
			'template_parameter'=>'$fetch_feed_params, 0, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico preview item campaign', 
			'value'=>'wpematico_preview_item_campaign', 
			'parameters'=>3, 
			'template_parameter'=>'$fetch_feed_params, 0, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico duplicate options', 
			'value'=>'wpematico_duplicate_options', 
			'parameters'=>3, 
			'template_parameter'=>'$options, $settings, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico images options', 
			'value'=>'wpematico_images_options', 
			'parameters'=>3, 
			'template_parameter'=>'$options, $settings, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico audios options', 
			'value'=>'wpematico_audios_options', 
			'parameters'=>3, 
			'template_parameter'=>'$options, $settings, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico videos options', 
			'value'=>'wpematico_videos_options', 
			'parameters'=>3, 
			'template_parameter'=>'$options, $settings, $campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'get wpematico images allowed mimes', 
			'value'=>'get_wpematico_images_allowed_mimes', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'get wpematico audios allowed mimes', 
			'value'=>'get_wpematico_audios_allowed_mimes', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'get wpematico videos allowed mimes', 
			'value'=>'get_wpematico_videos_allowed_mimes', 
			'parameters'=>1, 
			'template_parameter'=>'$return', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'pro check campaigndata', 
			'value'=>'pro_check_campaigndata', 
			'parameters'=>2, 
			'template_parameter'=>'$campaigndata, $post_data', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpe simplepie timeout', 
			'value'=>'wpe_simplepie_timeout', 
			'parameters'=>1, 
			'template_parameter'=>'$time_num', 
			'type'=>'filter', 
			'description'=>'' 
		),		
		array( 
			'name'=>'wpematico before update campaign', 
			'value'=>'wpematico_before_update_campaign', 
			'parameters'=>1, 
			'template_parameter'=>'$campaign', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico simplepie user agent', 
			'value'=>'wpematico_simplepie_user_agent', 
			'parameters'=>2, 
			'template_parameter'=>'$user_agent, $url', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico fetchfeed', 
			'value'=>'wpematico_fetchfeed', 
			'parameters'=>2, 
			'template_parameter'=>'$feed, $url', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico fetch feed params test', 
			'value'=>'wpematico_fetch_feed_params_test', 
			'parameters'=>3, 
			'template_parameter'=>'$fetch_feed_params, 0, $_POST', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico get contents request params', 
			'value'=>'wpematico_get_contents_request_params', 
			'parameters'=>2, 
			'template_parameter'=>'$arg, $url', 
			'type'=>'filter', 
			'description'=>'' 
		),
		array( 
			'name'=>'wpematico before get content', 
			'value'=>'wpematico_before_get_content', 
			'parameters'=>3, 
			'template_parameter'=>'false, $aux, $url', 
			'type'=>'filter', 
			'description'=>'' 
		),

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