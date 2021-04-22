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
			'description' => __('This filter convert a string to UTF-8 if its has a different encoding.','wpematico-custom-hooks'),
			'group' => 'Format'
			
		),
 		array(
			'name'=>'wpematico newimgname',
			'value'=>'wpematico_newimgname',
			'parameters'=>4,
			'template_parameter'=>'$imagen_src_real, $current_item, $campaign, $item',
			'type'=>'filter',
			'description'=>__('Rename the image','wpematico-custom-hooks'),
			'group' => 'Image'
			
		),
		array(
			'name'=>'wpematico yt altimg',
			'value'=>'wpematico_yt_altimg',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_title',
			'type'=>'filter',
			'description'=>__('Parse title the video','wpematico-custom-hooks'),
			'group' => 'Youtube'

		),
		array(
			'name'=>'wpematico yt thumbnails',
			'value'=>'wpematico_yt_thumbnails',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_thumbnails',
			'type'=>'filter',
			'description'=>__('Parse thumbnails the video','wpematico-custom-hooks'),
			'group' => 'Youtube'

		),
		array(
			'name'=>'wpematico yt description',
			'value'=>'wpematico_yt_description',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_description',
			'type'=>'filter',
			'description'=>__('Parse description the video','wpematico-custom-hooks'),
			'group' => 'Youtube'

		),
		array(
			'name'=>'wpematico get post content feed',
			'value'=>'wpematico_get_post_content_feed',
			'parameters'=>4,
			'template_parameter'=>'$content,$campaign,$feed,$item',
			'type'=>'filter',
			'description'=>__('Get post content from feed','wpematico-custom-hooks'),
			'group' =>'Content'
		),
		array(
			'name'=>'wpematico excludes',
			'value'=>'wpematico_excludes',
			'parameters'=>4,
			'template_parameter'=>'$skip,$current_item,$campaign,$item',
			'type'=>'filter',
			'description'=>__('Filter to skip item or not','wpematico-custom-hooks'),
			'group' =>'Skip item'
		),
		array(
			'name'=>'wpematico item parsers',
			'value'=>'wpematico_item_parsers',
			'parameters'=>4,
			'template_parameter'=>'$current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>__('Parses items content','wpematico-custom-hooks'),
			'group' => 'Parser'

		),
		array(
			'name'=>'wpem dont strip tags',
			'value'=>'wpem_dont_strip_tags',
			'parameters'=>0,
			'type'=>'filter',
			'description'=>__('Strip all HTML tags from content','wpematico-custom-hooks'),
			'group' => 'Tag'
			
		),
		array(
			'name'=>'wpematico after item parsers',
			'value'=>'wpematico_after_item_parsers',
			'parameters'=>4,
			'template_parameter'=>'$current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>__('This filter is executed after parsing the content.','wpematico-custom-hooks'),
			'group' => 'Parser'
		),
		array(
			'name'=>'wpematico add template vars',
			'value'=>'wpematico_add_template_vars',
			'parameters'=>5,
			'template_parameter'=>'$vars, $current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description'=>__('Add template variables','wpematico-custom-hooks'),
			'group' =>'Template'
		),
		array(
			'name'=>'wpematico pretags',
			'value'=>'wpematico_pretags',
			'parameters'=>3,
			'template_parameter'=>'$current_item, $item, $cfg',
			'type'=>'filter',
			'description'=>__('Filter before creating and inserting tags','wpematico-custom-hooks'),
			'group' => 'Tag'

		),
		array(
			'name'=>'wpematico postags',
			'value'=>'wpematico_postags',
			'parameters'=>3,
			'template_parameter'=>'$current_item, $item, $cfg',
			'type'=>'filter',
			'description'=>__('Filter after creating and inserting tags','wpematico-custom-hooks'),
			'group' => 'Tag'
		),
		array(
			'name'=>'wpepro full permalink',
			'value'=>'wpepro_full_permalink',
			'parameters'=>1,
			'template_parameter'=>'$permalink',
			'type'=>'filter',
			'description'=>__('The item permalink','wpematico-custom-hooks'),
			'group' =>'Permalink'
		),
		array(
			'name'=>'wpematico img src url',
			'value'=>'wpematico_img_src_url',
			'parameters'=>1,
			'template_parameter'=>'$imagen_src_real',
			'type'=>'filter',
			'description'=>__('Get the url img','wpematico-custom-hooks'),
			'group' => 'Image'
		),
		array(
			'name'=>'wpematico imagen src',
			'value'=>'wpematico_imagen_src',
			'parameters'=>1,
			'template_parameter'=>'$imagen_src',
			'type'=>'filter',
			'description'=>__('Image source','wpematico-custom-hooks'),
			'group' => 'Image'
			
		),
		array(
			'name'=>'wpematico allowext',
			'value'=>'wpematico_allowext',
			'parameters'=>1,
			'template_parameter'=>'$allowed',
			'type'=>'filter',
			'description'=>__('Allow images extensions','wpematico-custom-hooks'),
			'group' =>'Image'
		),
		array( 
			'name'=>'wpematico end fetching', 
			'value'=>'wpematico_end_fetching', 
			'parameters'=>2, 
			'template_parameter'=>'$campaign,$fetched_posts ', 
			'type'=>'filter', 
			'description'=>__('After finishing the fetch','wpematico-custom-hooks'),
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpematico simplepie url', 
			'value'=>'wpematico_simplepie_url', 
			'parameters'=>3, 
			'template_parameter'=>'$feed, $kf, $campaign', 
			'type'=>'filter', 
			'description'=>__('Filter for SimplePie Library when accessing the feed','wpematico-custom-hooks'),
			'group' =>'Settings'
		), 
		array( 
			'name'=>'Wpematico process fetching', 
			'value'=>'Wpematico_process_fetching', 
			'parameters'=>1, 
			'template_parameter'=>' $campaign', 
			'type'=>'filter', 
			'description'=>__('This filter is executed during the fetching process','wpematico-custom-hooks'),
			'group' =>'Fetch'
		), 
		array( 
			'name'=>'wpematico get author', 
			'value'=>'wpematico_get_author', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feedurl, $item ', 
			'type'=>'filter', 
			'description'=>__('Get the items author','wpematico-custom-hooks'),
			'group' => 'Author'
		), 
		array( 
			'name'=>'wpematico get post content', 
			'value'=>'wpematico_get_post_content', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item ', 
			'type'=>'filter', 
			'description'=>__('Get the post content','wpematico-custom-hooks'),
			'group' =>'Content'
		),
		array( 
			'name'=>'wpematico item filters pre img', 
			'value'=>'wpematico_item_filters_pre_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign ', 
			'type'=>'filter', 
			'description'=>__('Parse and upload images','wpematico-custom-hooks'),
			'group' => 'Image' 
		),
		array( 
			'name'=>'wpematico set featured img', 
			'value'=>'wpematico_set_featured_img', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed,$item', 
			'type'=>'filter', 
			'description'=>__('Set image the featured img','wpematico-custom-hooks'),
			'group' => 'Image' 
		),
		array( 
			'name'=>'wpematico get featured img', 
			'value'=>'wpematico_get_featured_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item_images, $current_item', 
			'type'=>'filter', 
			'description'=>__('Get image the featured img','wpematico-custom-hooks'),
			'group' => 'Image' 
		),
		array( 
			'name'=>'wpematico item filters pos img', 
			'value'=>'wpematico_item_filters_pos_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign ', 
			'type'=>'filter', 
			'description'=>'',
			'group' => 'Image' 
		),
		array( 
			'name'=>'wpematico before insert autocats', 
			'value'=>'wpematico_before_insert_autocats', 
			'parameters'=>2, 
			'template_parameter'=>' $autocats, $this ', 
			'type'=>'filter', 
			'description'=>__('Filters the array of categories obtained by simplepie to be parsed before inserted into the database','wpematico-custom-hooks'),
			'group' => 'Category' 
		),  
		array( 
			'name'=>'wpem meta data', 
			'value'=>'wpem_meta_data', 
			'parameters'=>1, 
			'template_parameter'=>'$meta', 
			'type'=>'filter', 
			'description'=>__('Filter the array of meta fields to be parsed before attached to the post.','wpematico-custom-hooks'),
			'group' =>'Metafields'
		), 
		array( 
			'name'=>'wpem parse title', 
			'value'=>'wpem_parse_title', 
			'parameters'=>1, 
			'template_parameter'=>'$title', 
			'type'=>'filter', 
			'description'=>__('Parse the post title','wpematico-custom-hooks'),
			'group' => 'Parser' 
		),
		array( 
			'name'=>'wpem parse content', 
			'value'=>'wpem_parse_content', 
			'parameters'=>1, 
			'template_parameter'=>'$content', 
			'type'=>'filter', 
			'description'=>__('Parse the post content','wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpem parse name', 
			'value'=>'wpem_parse_name', 
			'parameters'=>1, 
			'template_parameter'=>'$slug', 
			'type'=>'filter', 
			'description'=>__('Post slug','wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpem parse content filtered', 
			'value'=>'wpem_parse_content_filtered', 
			'parameters'=>1, 
			'template_parameter'=>'$content', 
			'type'=>'filter', 
			'description'=>__('Content filtered','wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpem parse status', 
			'value'=>'wpem_parse_status', 
			'parameters'=>1, 
			'template_parameter'=>'$status', 
			'type'=>'filter', 
			'description'=>__('Post status','wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpem parse post type', 
			'value'=>'wpem_parse_post_type', 
			'parameters'=>1, 
			'template_parameter'=>'$post_type', 
			'type'=>'filter', 
			'description'=>__('Post Type','wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpem parse authorid', 
			'value'=>'wpem_parse_authorid', 
			'parameters'=>1, 
			'template_parameter'=>'$authorid', 
			'type'=>'filter', 
			'description'=>__('Author ID','wpematico-custom-hooks'),
			'group' => 'Author'  
		), 
		array( 
			'name'=>'wpem parse date', 
			'value'=>'wpem_parse_date', 
			'parameters'=>1, 
			'template_parameter'=>'$date', 
			'type'=>'filter', 
			'description'=>'',
			'group' => 'Parser'
		), 
		array( 
			'name'=>'wpem parse comment status', 
			'value'=>'wpem_parse_comment_status', 
			'parameters'=>1, 
			'template_parameter'=>'$comment_status', 
			'type'=>'filter', 
			'description'=>'',
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpematico pre insert post', 
			'value'=>'wpematico_pre_insert_post', 
			'parameters'=>2,
			'template_parameter'=>'$args, $campaign', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Fetch'
		), 
		array( 
			'name'=>'wpematico allow insertpost', 
			'value'=>'wpematico_allow_insertpost', 
			'parameters'=>3, 
			'template_parameter'=>'$bool, $this, $args', 
			'type'=>'filter', 
			'description'=>'' ,
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpematico duplicates', 
			'value'=>'wpematico_duplicates', 
			'parameters'=>3, 
			'template_parameter'=>'$dev,$campaign,$item', 
			'type'=>'filter', 
			'description'=>__('Fetch the duplicate post','wpematico-custom-hooks'),
			'group' =>'Duplicate Controls'
		),
		array( 
			'name'=>'wpematico inserted post', 
			'value'=>'wpematico_inserted_post', 
			'parameters'=>3, 
			'template_parameter'=>'$post_id, $campaign, $item ', 
			'type'=>'action', 
			'description'=>'' ,
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpematico addcat description', 
			'value'=>'wpematico_addcat_description', 
			'parameters'=>2, 
			'template_parameter'=>'$message,$catname', 
			'type'=>'filter', 
			'description'=>__('Add description category','wpematico-custom-hooks'),
			'group' => 'Category' 
		),
		array( 
			'name'=>'wpematico get item images', 
			'value'=>'wpematico_get_item_images', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $item, $options_images', 
			'type'=>'filter', 
			'description'=>__('Get the images item.','wpematico-custom-hooks'),
			'group' =>'Image'
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
			'description'=>'',
			'group' =>'Fetch'
		),
		array( 
			'name'=>'admin memory limit', 
			'value'=>'admin_memory_limit', 
			'parameters'=>1, 
			'template_parameter'=>'$memory', 
			'type'=>'filter', 
			'description'=>__('This filter is used to change the memory limit. default is "256M"','wpematico-custom-hooks'),
			'group' =>'Settings' 
		),
		array( 
			'name'=>'wpematico fetch feed params', 
			'value'=>'wpematico_fetch_feed_params', 
			'parameters'=>3, 
			'template_parameter'=>'$fetch_feed_params, $kf, $campaign', 
			'type'=>'filter', 
			'description'=>__('Fetch params feed','wpematico-custom-hooks'),
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpematico max duplicated hashes count', 
			'value'=>'wpematico_max_duplicated_hashes_count', 
			'parameters'=>3, 
			'template_parameter'=>'20, $this->campaign_id, $feed', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Duplicate Controls'
		),
		array( 
			'name'=>'wpematico get feeddate', 
			'value'=>'wpematico_get_feeddate', 
			'parameters'=>5, 
			'template_parameter'=>'$itemdate, $current_item, $campaign, $feedurl, $item', 
			'type'=>'filter', 
			'description'=>__('Get the feed date','wpematico-custom-hooks'),
			'group' =>'Date'
		),
		array( 
			'name'=>'wpematico get post excerpt feed', 
			'value'=>'wpematico_get_post_excerpt_feed', 
			'parameters'=>4, 
			'template_parameter'=>'$item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description'=>__('Get the excerpt post','wpematico-custom-hooks'),
			'group' =>'Content'
		),
		array( 
			'name'=>'wpematico item pre media', 
			'value'=>'wpematico_item_pre_media', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Media'
		),
		array( 
			'name'=>'wpematico item filters pre audio', 
			'value'=>'wpematico_item_filters_pre_audio', 
			'parameters'=>2, 
			'template_parameter'=>'$current_item, $campaign', 
			'type'=>'filter', 
			'description'=>__('Parse and upload audio','wpematico-custom-hooks'),
			'group' => 'Audio' 
		),
		array( 
			'name'=>'wpematico item filters pre video', 
			'value'=>'wpematico_item_filters_pre_video', 
			'parameters'=>2, 
			'template_parameter'=>'$current_item, $campaign', 
			'type'=>'filter', 
			'description'=>__('Parse and upload video','wpematico-custom-hooks'),
			'group' => 'Video' 
		),
		array( 
			'name'=>'wpematico item pos media', 
			'value'=>'wpematico_item_pos_media', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description'=>__('Get the media item ','wpematico-custom-hooks'),
			'group' =>'Media'
		),
		array( 
			'name'=>'wpematico pos item filters', 
			'value'=>'wpematico_pos_item_filters', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpem parse excerpt', 
			'value'=>'wpem_parse_excerpt', 
			'parameters'=>1, 
			'template_parameter'=>'$excerpt', 
			'type'=>'filter', 
			'description'=>'',
			'group' => 'Parser' 
		),
		array( 
			'name'=>'wpem parse parent', 
			'value'=>'wpem_parse_parent', 
			'parameters'=>1, 
			'template_parameter'=>'$post_parent', 
			'type'=>'filter', 
			'description'=>'',
			'group' => 'Parser' 
		),
		array( 
			'name'=>'wpematico featured image attach id', 
			'value'=>'wpematico_featured_image_attach_id', 
			'parameters'=>5, 
			'template_parameter'=>'$featured_image_attach_id, $post_id, $current_item, $campaign, $item', 
			'type'=>'filter', 
			'description'=>__('Get the id image','wpematico-custom-hooks'),
			'group' =>'Image'
		),
		array( 
			'name'=>'Wpematico end fetching', 
			'value'=>'Wpematico_end_fetching', 
			'parameters'=>2, 
			'template_parameter'=>'$campaign, $fetched_posts', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpematico categories after filters', 
			'value'=>'wpematico_categories_after_filters', 
			'parameters'=>3, 
			'template_parameter'=>'$categories, $item, $cfg', 
			'type'=>'filter', 
			'description'=>__('Filter the array of categories to be parsed before inserted into the database.','wpematico-custom-hooks'),
			'group' => 'Category'  
		),
		array( 
			'name'=>'wpematico images parser', 
			'value'=>'wpematico_images_parser', 
			'parameters'=>6, 
			'template_parameter'=>'"default", $current_item, $campaign, $feed, $item, $options_images', 
			'type'=>'filter', 
			'description'=>__('Filters images, upload and replace on text item content','wpematico-custom-hooks'),
			'group' => 'Parser' 
		),
		array( 
			'name'=>'wpematico pattern img', 
			'value'=>'wpematico_pattern_img', 
			'parameters'=>1, 
			'template_parameter'=>'"/<img[^>]+>/i"', 
			'type'=>'filter', 
			'description'=>__('Returns all images of the content','wpematico-custom-hooks'),
			'group' => 'Image' 
		),
		array( 
			'name'=>'wpematico fifu meta', 
			'value'=>'wpematico_fifu_meta', 
			'parameters'=>2, 
			'template_parameter'=>'$wpematico_fifu_meta, $current_item', 
			'type'=>'filter', 
			'description'=>__('Get Metafields','wpematico-custom-hooks'),
			'group' => 'Metafields' 
		),
		array( 
			'name'=>'wpematico yt video', 
			'value'=>'wpematico_yt_video', 
			'parameters'=>1, 
			'template_parameter'=>'$video', 
			'type'=>'filter', 
			'description'=>'',
			'group' => 'Youtube' 
		),
		array( 
			'name'=>'wpematico get item audios', 
			'value'=>'wpematico_get_item_audios', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $item, $options_audios', 
			'type'=>'filter', 
			'description'=>__('Filters audios, upload and replace on text item content','wpematico-custom-hooks'),
			'group' => 'Audio' 
		),
		array( 
			'name'=>'wpematico audio src url', 
			'value'=>'wpematico_audio_src_url', 
			'parameters'=>1, 
			'template_parameter'=>'$audio_src_real', 
			'type'=>'filter', 
			'description'=>__('Strip all white space on audios URLs.','wpematico-custom-hooks'),
			'group' => 'Audio' 
		),
		array( 
			'name'=>'wpematico allowext audio', 
			'value'=>'wpematico_allowext_audio', 
			'parameters'=>1, 
			'template_parameter'=>'$allowed_audio', 
			'type'=>'filter', 
			'description'=>__('Strip all white space on audios original source.','wpematico-custom-hooks'),
			'group' => 'Audio' 
		),
		array( 
			'name'=>'wpematico new audio name', 
			'value'=>'wpematico_new_audio_name', 
			'parameters'=>4, 
			'template_parameter'=>'sanitize_file_name(urlencode(basename($audio_src_without_query))), $current_item, $options_audios, $item', 
			'type'=>'filter', 
			'description'=>__('Strip all white space on audios store.','wpematico-custom-hooks'),
			'group' => 'Audio' 
		),
		array( 
			'name'=>'wpematico get item videos', 
			'value'=>'wpematico_get_item_videos', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $item, $options_videos', 
			'type'=>'filter', 
			'description'=>__('Filters videos, upload and replace on text item content','wpematico-custom-hooks'),
			'group' => 'Video' 
		),
		array( 
			'name'=>'wpematico video src url', 
			'value'=>'wpematico_video_src_url', 
			'parameters'=>1, 
			'template_parameter'=>'$video_src_real', 
			'type'=>'filter', 
			'description'=>__('Strip all white space on videos URLs.','wpematico-custom-hooks'),
			'group' => 'Video' 
		),
		array( 
			'name'=>'wpematico allowext video', 
			'value'=>'wpematico_allowext_video', 
			'parameters'=>1, 
			'template_parameter'=>'$allowed_video', 
			'type'=>'filter', 
			'description'=>'Strip all white space on videos original source.',
			'group' => 'Video' 
		),
		array( 
			'name'=>'wpematico new video name', 
			'value'=>'wpematico_new_video_name', 
			'parameters'=>4, 
			'template_parameter'=>'sanitize_file_name(urlencode(basename($video_src_without_query))), $current_item, $campaign, $item', 
			'type'=>'filter', 
			'description'=>__('Strip all white space on videos store .','wpematico-custom-hooks'),
			'group' => 'Video' 
		),	
	);


	//WPEMATICO ADD ONS PROFESIONAL
	if(array_search( 'wpematicopro.php', $active_plugins_names )!==FALSE){
		array_push($wpematicohk_data_filter_action,
					array( 
					'name'=>'Wpempro feed name author', 
					'value'=>'wpempro_feed_name_author', 
					'parameters'=>1, 
					'template_parameter'=>'$feed_name_author', 
					'type'=>'filter', 
					'description'=>'Filter to allow an external parser for the author name',
					'group' => 'Professional'),
					array( 
					'name'=>'Date from tag namespace', 
					'value'=>'date_from_tag_namespace', 
					'parameters'=>5, 
					'template_parameter'=>'$namespace, $current_item, $campaign, $feed, $item', 
					'type'=>'filter', 
					'description'=>__('Allows change a namespace','wpematico-custom-hooks'),
					'group' => 'Professional')

		)
					;
	}
	if(array_search('wpematico_fullcontent.php', $active_plugins_names )!==FALSE){
		//WPEMATICO ADD ONS FULL CONTENT
		array_push($wpematicohk_data_filter_action,
			array( 
			'name'=>'Wpemfullcontent websites video', 
			'value'=>'wpemfullcontent_websites_video', 
			'parameters'=>1, 
			'template_parameter'=>'$website_videos', 
			'type'=>'filter', 
			'description'=>'',
			'group' => 'Full Content'
			), 
			array( 
			'name'=>'Wpematico fullcontent folder', 
			'value'=>'wpematico_fullcontent_folder', 
			'parameters'=>1, 
			'template_parameter'=>'$customconfigdir', 
			'type'=>'filter', 
			'description'=>'',
			'group' => 'Full Content'
			), 
			array( 
			'name'=>'Wpepro getfullcontent', 
			'value'=>'wpepro_getfullcontent', 
			'parameters'=>2, 
			'template_parameter'=>'$permalink, $campaign', 
			'type'=>'filter', 
			'description'=>'',
			'group' => 'Full Content'  
			), 
			array( 
			'name'=>'Full html content', 
			'value'=>'full_html_content', 
			'parameters'=>1, 
			'template_parameter'=>'$html', 
			'type'=>'filter', 
			'description'=>'',
			'group' => 'Full Content' 
			), 
			array( 
			'name'=>'After full html content', 
			'value'=>'after_full_html_content', 
			'parameters'=>5, 
			'template_parameter'=>' $html, $current_item, $campaign, $feed, $item', 
			'type'=>'action', 
			'description'=>'',
			'group' => 'Full Content'
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
			'description'=>'',
			'group' =>'Polyglot'
			), 
			array( 
			'name'=>'polyglot_get_apis', 
			'value'=>'polyglot_get_apis', 
			'parameters'=>1, 
			'template_parameter'=>' $list_api', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Polyglot'
			), 
			array( 
			'name'=>'polyglot_get_idioms_options', 
			'value'=>'polyglot_get_idioms_options', 
			'parameters'=>1, 
			'template_parameter'=>' $options', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Polyglot'
			), 
			array( 
			'name'=>'polyglot_process_type', 
			'value'=>'polyglot_process_type', 
			'parameters'=>2, 
			'template_parameter'=>' $process, $campaign', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Polyglot' 
			), 
			array( 
			'name'=>'polyglot_process', 
			'value'=>'polyglot_process', 
			'parameters'=>1, 
			'template_parameter'=>'$process', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Polyglot' 
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
			'description'=>'',
			'group' =>'Better Excerpt' 
			),
			array( 
			'name'=>'wpem_after_better_excerpts_fields', 
			'value'=>'wpem_after_better_excerpts_fields', 
			'parameters'=>1, 
			'template_parameter'=>'$better_excerpts', 
			'type'=>'action', 
			'description'=>'',
			'group' =>'Better Excerpt' 
			)
		);
	}
	//WPEMATICO MAKE ME FEED
	if(array_search( 'make-me-feed.php', $active_plugins_names )!==FALSE){
		array_push($wpematicohk_data_filter_action,

			array( 
			'name'=>'make_me_feed_pre_save_post', 
			'value'=>'make_me_feed_pre_save_post', 
			'parameters'=>1, 
			'template_parameter'=>'$mmfdata', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Make Me Feed' 
			), 
			array( 
			'name'=>'mmf_getcontents_args', 
			'value'=>'mmf_getcontents_args', 
			'parameters'=>1, 
			'template_parameter'=>'$curl', 
			'type'=>'filter', 
			'description'=>'',
			'group' =>'Make Me Feed' 
			),
			array( 
			'name'=>'make_me_feed_metaboxes', 
			'value'=>'make_me_feed_metaboxes', 
			'parameters'=>1, 
			'template_parameter'=>'$post', 
			'type'=>'action', 
			'description'=>'',
			'group' =>'Make Me Feed' 
			), 
			array( 
			'name'=>'make_me_feed_urls_box', 
			'value'=>'make_me_feed_urls_box', 
			'parameters'=>0, 
			'template_parameter'=>'', 
			'type'=>'action', 
			'description'=>'',
			'group' =>'Make Me Feed' 
			), 
			array( 
			'name'=>'make_me_feed_post_saved', 
			'value'=>'make_me_feed_post_saved', 
			'parameters'=>0, 
			'template_parameter'=>'', 
			'type'=>'action', 
			'description'=>'',
			'group' =>'Make Me Feed' 
			), 
			array( 
			'name'=>'mmf_testarea_before_getcontent', 
			'value'=>'mmf_testarea_before_getcontent', 
			'parameters'=>1, 
			'template_parameter'=>'$campaign', 
			'type'=>'action', 
			'description'=>'',
			'group' =>'Make Me Feed' 
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
			'description'=>'',
			'group' =>'Facebook Fetcher' 
			)
		);
	}

$wpematicohk_data_filter_action = apply_filters('wpematico_hooks_data_filter_action', $wpematicohk_data_filter_action);
	
?>