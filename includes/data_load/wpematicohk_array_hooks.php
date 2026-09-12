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
			'description' => __('Converts a string to UTF-8 when it arrives in another encoding.', 'wpematico-custom-hooks'),
			'group' => 'Format'
			
		),
 		array(
			'name'=>'wpematico newimgname',
			'value'=>'wpematico_newimgname',
			'parameters'=>4,
			'template_parameter'=>'$imagen_src_real, $current_item, $campaign, $item',
			'type'=>'filter',
			'description' => __('Filename the downloaded image is stored under. A source whose addresses carry no file extension needs this, or its images are dropped.', 'wpematico-custom-hooks'),
			'group' => 'Image'
			
		),
		array(
			'name'=>'wpematico yt altimg',
			'value'=>'wpematico_yt_altimg',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_title',
			'type'=>'filter',
			'description' => __('Title used for the YouTube image of the item.', 'wpematico-custom-hooks'),
			'group' => 'Youtube'

		),
		array(
			'name'=>'wpematico yt thumbnails',
			'value'=>'wpematico_yt_thumbnails',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_thumbnails',
			'type'=>'filter',
			'description' => __('Thumbnail address of the YouTube video.', 'wpematico-custom-hooks'),
			'group' => 'Youtube'

		),
		array(
			'name'=>'wpematico yt description',
			'value'=>'wpematico_yt_description',
			'parameters'=>1,
			'template_parameter'=>'$enclosure_description',
			'type'=>'filter',
			'description' => __('Description of the YouTube video.', 'wpematico-custom-hooks'),
			'group' => 'Youtube'

		),
		array(
			'name'=>'wpematico get post content feed',
			'value'=>'wpematico_get_post_content_feed',
			'parameters'=>4,
			'template_parameter'=>'$content,$campaign,$feed,$item',
			'type'=>'filter',
			'description' => __('The raw content as the feed served it, before any parser touches it.', 'wpematico-custom-hooks'),
			'group' =>'Content'
		),
		array(
			'name'=>'wpematico excludes',
			'value'=>'wpematico_excludes',
			'parameters'=>4,
			'template_parameter'=>'$skip,$current_item,$campaign,$item',
			'type'=>'filter',
			'description' => __('Return true to skip this item, before anything else is done with it.', 'wpematico-custom-hooks'),
			'group' =>'Skip item'
		),
		array(
			'name'=>'wpematico item parsers',
			'value'=>'wpematico_item_parsers',
			'parameters'=>4,
			'template_parameter'=>'$current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description' => __('The main content parser, and where most add-ons change the title, content and excerpt of an item.', 'wpematico-custom-hooks'),
			'group' => 'Parser'

		),
		array(
			'name'=>'wpematico dont strip tags',
			// Was 'wpem_dont_strip_tags', which no core ever fired, with a parameter count of 0.
			'value'=>'wpematico_dont_strip_tags',
			'parameters'=>2,
			'template_parameter'=>'$allowed_tags, $campaign',
			'type'=>'filter',
			'description' => __('HTML tags kept when Strip all HTML tags is on.', 'wpematico-custom-hooks'),
			'group' => 'Tag'
			
		),
		array(
			'name'=>'wpematico after item parsers',
			'value'=>'wpematico_after_item_parsers',
			'parameters'=>4,
			'template_parameter'=>'$current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description' => __('Runs once every content parser has finished with the item.', 'wpematico-custom-hooks'),
			'group' => 'Parser'
		),
		array(
			'name'=>'wpematico add template vars',
			'value'=>'wpematico_add_template_vars',
			'parameters'=>5,
			'template_parameter'=>'$vars, $current_item, $campaign, $feed, $item',
			'type'=>'filter',
			'description' => __('Extra variables available to the post template of the campaign.', 'wpematico-custom-hooks'),
			'group' =>'Template'
		),
		array(
			'name'=>'wpematico pretags',
			'value'=>'wpematico_pretags',
			'parameters'=>3,
			'template_parameter'=>'$current_item, $item, $cfg',
			'type'=>'filter',
			'description' => __('Runs before the tags of the item are built.', 'wpematico-custom-hooks'),
			'group' => 'Tag'

		),
		array(
			'name'=>'wpematico postags',
			'value'=>'wpematico_postags',
			'parameters'=>4,
			'template_parameter'=>'$current_item, $item, $cfg, $campaign',
			'type'=>'filter',
			'description' => __('The item once its tags were built. Read and change campaign_tags.', 'wpematico-custom-hooks'),
			'group' => 'Tag'
		),
		array(
			'name'=>'wpepro full permalink',
			'value'=>'wpepro_full_permalink',
			'parameters'=>1,
			'template_parameter'=>'$permalink',
			'type'=>'filter',
			'description' => __('The address of the original item, as read from the feed.', 'wpematico-custom-hooks'),
			'group' =>'Permalink'
		),
		array(
			'name'=>'wpematico img src url',
			'value'=>'wpematico_img_src_url',
			'parameters'=>1,
			'template_parameter'=>'$imagen_src_real',
			'type'=>'filter',
			'description' => __('The final image address that will be downloaded.', 'wpematico-custom-hooks'),
			'group' => 'Image'
		),
		array(
			'name'=>'wpematico imagen src',
			'value'=>'wpematico_imagen_src',
			'parameters'=>1,
			'template_parameter'=>'$imagen_src',
			'type'=>'filter',
			'description' => __('The image address before the parts the campaign is set to strip are removed.', 'wpematico-custom-hooks'),
			'group' => 'Image'
			
		),
		array(
			'name'=>'wpematico allowext',
			'value'=>'wpematico_allowext',
			'parameters'=>1,
			'template_parameter'=>'$allowed',
			'type'=>'filter',
			'description' => __('File extensions accepted when downloading images. Anything else is left where it is.', 'wpematico-custom-hooks'),
			'group' =>'Image'
		),
		array( 
			'name'=>'Wpematico end fetching',
			// Core fires this one with a capital W. Hook names are case sensitive, so the old
			// all-lowercase value never matched anything.
			'value'=>'Wpematico_end_fetching',
			'parameters'=>2,
			'template_parameter'=>'$campaign, $fetched_posts',
			'type'=>'filter', 
			'description' => __('Runs when the campaign has finished. Returns the campaign data, so it can still be changed before it is saved.', 'wpematico-custom-hooks'),
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpematico simplepie url', 
			'value'=>'wpematico_simplepie_url', 
			'parameters'=>3, 
			'template_parameter'=>'$feed, $kf, $campaign', 
			'type'=>'filter', 
			'description' => __('The feed address, right before it is fetched. Point a campaign at a different address from here.', 'wpematico-custom-hooks'),
			'group' =>'Settings'
		), 
		array( 
			'name'=>'wpematico custom simplepie', 
			'value'=>'wpematico_custom_simplepie', 
			'parameters'=>4, 
			'template_parameter'=>'$simplepie, $fetch_obj, $feed, $feed_key', 
			'type'=>'filter', 
			'description' => __('Replace or change the SimplePie object of a campaign whose type is not fetched as a plain feed. A feed, YouTube or bbPress campaign returns before this point and never reaches it.', 'wpematico-custom-hooks'),
			'group' =>'Fetch'
		), 
		array( 
			'name'=>'wpematico get author', 
			'value'=>'wpematico_get_author', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feedurl, $item ', 
			'type'=>'filter', 
			'description' => __('The item once its author was resolved. Set author to a WordPress user id.', 'wpematico-custom-hooks'),
			'group' => 'Author'
		), 
		array( 
			'name'=>'wpematico get post content', 
			'value'=>'wpematico_get_post_content', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item ', 
			'type'=>'filter', 
			'description' => __('The item once its content and excerpt have been assigned.', 'wpematico-custom-hooks'),
			'group' =>'Content'
		),
		array( 
			'name'=>'wpematico item filters pre img', 
			'value'=>'wpematico_item_filters_pre_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign ', 
			'type'=>'filter', 
			'description' => __('Runs before the images of the item are processed.', 'wpematico-custom-hooks'),
			'group' => 'Image' 
		),
		array( 
			'name'=>'wpematico set featured img', 
			'value'=>'wpematico_set_featured_img', 
			'parameters'=>5, 
			'template_parameter'=>'$featured_image, $current_item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description' => __('Return an image address to force the featured image instead of letting the campaign pick one.', 'wpematico-custom-hooks'),
			'group' => 'Image' 
		),
		array( 
			'name'=>'wpematico get featured img', 
			'value'=>'wpematico_get_featured_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item_images, $current_item', 
			'type'=>'filter', 
			'description' => __('The featured image address the campaign settled on.', 'wpematico-custom-hooks'),
			'group' => 'Image' 
		),
		array( 
			'name'=>'wpematico item filters pos img', 
			'value'=>'wpematico_item_filters_pos_img', 
			'parameters'=>2, 
			'template_parameter'=>' $current_item, $campaign ', 
			'type'=>'filter', 
			'description' => __('Runs once the images of the item have been processed and replaced in the content.', 'wpematico-custom-hooks'),
			'group' => 'Image' 
		),
		array( 
			'name'=>'wpematico before insert autocats', 
			'value'=>'wpematico_before_insert_autocats', 
			'parameters'=>2, 
			'template_parameter'=>' $autocats, $this ', 
			'type'=>'filter', 
			'description' => __('The categories read from the feed, before they are created or assigned.', 'wpematico-custom-hooks'),
			'group' => 'Category' 
		),  
		array( 
			'name'=>'wpem meta data', 
			'value'=>'wpem_meta_data', 
			'parameters'=>1, 
			'template_parameter'=>'$meta', 
			'type'=>'filter', 
			'description' => __('The custom fields about to be written with the post.', 'wpematico-custom-hooks'),
			'group' =>'Metafields'
		), 
		array( 
			'name'=>'wpem parse title', 
			'value'=>'wpem_parse_title', 
			'parameters'=>1, 
			'template_parameter'=>'$title', 
			'type'=>'filter', 
			'description' => __('Title of the post being created, immediately before it is saved.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		),
		array( 
			'name'=>'wpem parse content', 
			'value'=>'wpem_parse_content', 
			'parameters'=>1, 
			'template_parameter'=>'$content', 
			'type'=>'filter', 
			'description' => __('Content of the post being created, immediately before it is saved.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpem parse name', 
			'value'=>'wpem_parse_name', 
			'parameters'=>1, 
			'template_parameter'=>'$slug', 
			'type'=>'filter', 
			'description' => __('Slug of the post being created.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpem parse content filtered', 
			'value'=>'wpem_parse_content_filtered', 
			'parameters'=>1, 
			'template_parameter'=>'$content', 
			'type'=>'filter', 
			'description' => __('The content_filtered column of the post being created.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpem parse status', 
			'value'=>'wpem_parse_status', 
			'parameters'=>1, 
			'template_parameter'=>'$status', 
			'type'=>'filter', 
			'description' => __('Status the post being created is saved with.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpem parse post type', 
			'value'=>'wpem_parse_post_type', 
			'parameters'=>1, 
			'template_parameter'=>'$post_type', 
			'type'=>'filter', 
			'description' => __('Post type the item is saved as.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpem parse authorid', 
			'value'=>'wpem_parse_authorid', 
			'parameters'=>1, 
			'template_parameter'=>'$authorid', 
			'type'=>'filter', 
			'description' => __('Author id the post being created is saved with.', 'wpematico-custom-hooks'),
			'group' => 'Author'  
		), 
		array( 
			'name'=>'wpem parse date', 
			'value'=>'wpem_parse_date', 
			'parameters'=>1, 
			'template_parameter'=>'$date', 
			'type'=>'filter', 
			'description' => __('Publication date of the post being created.', 'wpematico-custom-hooks'),
			'group' => 'Parser'
		), 
		array( 
			'name'=>'wpem parse comment status', 
			'value'=>'wpem_parse_comment_status', 
			'parameters'=>1, 
			'template_parameter'=>'$comment_status', 
			'type'=>'filter', 
			'description' => __('Whether comments are open on the post being created.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		), 
		array( 
			'name'=>'wpematico pre insert post', 
			'value'=>'wpematico_pre_insert_post', 
			'parameters'=>2,
			'template_parameter'=>'$args, $campaign', 
			'type'=>'filter', 
			'description' => __('The whole argument list about to reach wp_insert_post. The last chance to change what is saved.', 'wpematico-custom-hooks'),
			'group' =>'Fetch'
		), 
		array( 
			'name'=>'wpematico allow insertpost', 
			'value'=>'wpematico_allow_insertpost', 
			'parameters'=>3, 
			'template_parameter'=>'$bool, $this, $args', 
			'type'=>'filter', 
			'description' => __('Return false to stop this item from being inserted, with everything already prepared.', 'wpematico-custom-hooks'),
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpematico duplicates', 
			'value'=>'wpematico_duplicates', 
			'parameters'=>3, 
			'template_parameter'=>'$dev,$campaign,$item', 
			'type'=>'filter', 
			'description' => __('Return true to treat this item as a duplicate, so it is not imported.', 'wpematico-custom-hooks'),
			'group' =>'Duplicate Controls'
		),
		array( 
			'name'=>'wpematico inserted post', 
			'value'=>'wpematico_inserted_post', 
			'parameters'=>3, 
			'template_parameter'=>'$post_id, $campaign, $item ', 
			'type'=>'action', 
			'description' => __('Fires once the post exists. The place to add your own meta, taxonomies or related records.', 'wpematico-custom-hooks'),
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpematico addcat description', 
			'value'=>'wpematico_addcat_description', 
			'parameters'=>2, 
			'template_parameter'=>'$message,$catname', 
			'type'=>'filter', 
			'description' => __('Description given to a category that is created automatically.', 'wpematico-custom-hooks'),
			'group' => 'Category' 
		),
		array( 
			'name'=>'wpematico get item images', 
			'value'=>'wpematico_get_item_images', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $item, $options_images', 
			'type'=>'filter', 
			'description' => __('The item once its images were downloaded and replaced in the content.', 'wpematico-custom-hooks'),
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
			'description' => __('The global settings, normalised. Where an add-on registers the defaults of its own options.', 'wpematico-custom-hooks'),
			'group' =>'Fetch'
		),
		array( 
			'name'=>'admin memory limit', 
			'value'=>'admin_memory_limit', 
			'parameters'=>1, 
			'template_parameter'=>'$memory', 
			'type'=>'filter', 
			'description' => __('Memory limit a campaign run is allowed to use. Default 256M.', 'wpematico-custom-hooks'),
			'group' =>'Settings' 
		),
		array( 
			'name'=>'wpematico fetch feed params', 
			'value'=>'wpematico_fetch_feed_params', 
			'parameters'=>3, 
			'template_parameter'=>'$fetch_feed_params, $kf, $campaign', 
			'type'=>'filter', 
			'description' => __('Arguments handed to SimplePie for this feed: timeouts, ordering, how many items.', 'wpematico-custom-hooks'),
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpematico max duplicated hashes count', 
			'value'=>'wpematico_max_duplicated_hashes_count', 
			'parameters'=>3, 
			'template_parameter'=>'$count, $campaign_id, $feed', 
			'type'=>'filter', 
			'description' => __('How many recent items are remembered per feed to recognise duplicates. Default 20.', 'wpematico-custom-hooks'),
			'group' =>'Duplicate Controls'
		),
		array( 
			'name'=>'wpematico get feeddate', 
			'value'=>'wpematico_get_feeddate', 
			'parameters'=>5, 
			'template_parameter'=>'$itemdate, $current_item, $campaign, $feedurl, $item', 
			'type'=>'filter', 
			'description' => __('The date read from the feed item.', 'wpematico-custom-hooks'),
			'group' =>'Date'
		),
		array( 
			'name'=>'wpematico get post excerpt feed', 
			'value'=>'wpematico_get_post_excerpt_feed', 
			'parameters'=>4, 
			'template_parameter'=>'$excerpt, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description' => __('The raw description as the feed served it, before any parser touches it.', 'wpematico-custom-hooks'),
			'group' =>'Content'
		),
		array( 
			'name'=>'wpematico item pre media', 
			'value'=>'wpematico_item_pre_media', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description' => __('Runs before any media of the item is processed.', 'wpematico-custom-hooks'),
			'group' =>'Media'
		),
		array( 
			'name'=>'wpematico item filters pre audio', 
			'value'=>'wpematico_item_filters_pre_audio', 
			'parameters'=>2, 
			'template_parameter'=>'$current_item, $campaign', 
			'type'=>'filter', 
			'description' => __('Runs before the audio of the item is processed.', 'wpematico-custom-hooks'),
			'group' => 'Audio' 
		),
		array( 
			'name'=>'wpematico item filters pre video', 
			'value'=>'wpematico_item_filters_pre_video', 
			'parameters'=>2, 
			'template_parameter'=>'$current_item, $campaign', 
			'type'=>'filter', 
			'description' => __('Runs before the video of the item is processed.', 'wpematico-custom-hooks'),
			'group' => 'Video' 
		),
		array( 
			'name'=>'wpematico item pos media', 
			'value'=>'wpematico_item_pos_media', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description' => __('Runs once every image, audio and video of the item has been processed.', 'wpematico-custom-hooks'),
			'group' =>'Media'
		),
		array( 
			'name'=>'wpematico pos item filters', 
			'value'=>'wpematico_pos_item_filters', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $feed, $item', 
			'type'=>'filter', 
			'description' => __('The last pass over the item, after every parser and every media filter has run.', 'wpematico-custom-hooks'),
			'group' =>'Fetch'
		),
		array( 
			'name'=>'wpem parse excerpt', 
			'value'=>'wpem_parse_excerpt', 
			'parameters'=>1, 
			'template_parameter'=>'$excerpt', 
			'type'=>'filter', 
			'description' => __('Excerpt of the post being created.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		),
		array( 
			'name'=>'wpem parse parent', 
			'value'=>'wpem_parse_parent', 
			'parameters'=>1, 
			'template_parameter'=>'$post_parent', 
			'type'=>'filter', 
			'description' => __('Parent post of the post being created.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		),
		array( 
			'name'=>'wpematico featured image attach id', 
			'value'=>'wpematico_featured_image_attach_id', 
			'parameters'=>5, 
			'template_parameter'=>'$featured_image_attach_id, $post_id, $current_item, $campaign, $item', 
			'type'=>'filter', 
			'description' => __('The attachment id set as the featured image, once the post has been inserted.', 'wpematico-custom-hooks'),
			'group' =>'Image'
		),
		array(
			'name'=>'wpematico categories after filters',
			'value'=>'wpematico_categories_after_filters', 
			'parameters'=>3, 
			'template_parameter'=>'$categories, $item, $cfg', 
			'type'=>'filter', 
			'description' => __('The final list of categories the post is filed under.', 'wpematico-custom-hooks'),
			'group' => 'Category'  
		),
		array( 
			'name'=>'wpematico images parser', 
			'value'=>'wpematico_images_parser', 
			'parameters'=>6, 
			'template_parameter'=>'$parser_id, $current_item, $campaign, $feed, $item, $options_images', 
			'type'=>'filter', 
			'description' => __('Which image parser handles this item. Return your own id and answer wpematico images parser {id}.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		),
		array( 
			'name'=>'wpematico pattern img', 
			'value'=>'wpematico_pattern_img', 
			'parameters'=>1, 
			'template_parameter'=>'$pattern_img', 
			'type'=>'filter', 
			'description' => __('The regular expression that finds the images in the content.', 'wpematico-custom-hooks'),
			'group' => 'Image' 
		),
		array( 
			'name'=>'wpematico fifu meta', 
			'value'=>'wpematico_fifu_meta', 
			'parameters'=>2, 
			'template_parameter'=>'$wpematico_fifu_meta, $current_item', 
			'type'=>'filter', 
			'description' => __('Meta written for the Featured Image From URL plugin.', 'wpematico-custom-hooks'),
			'group' => 'Metafields' 
		),
		array( 
			'name'=>'wpematico yt video', 
			'value'=>'wpematico_yt_video', 
			'parameters'=>1, 
			'template_parameter'=>'$video', 
			'type'=>'filter', 
			'description' => __('The YouTube player embed built for the item.', 'wpematico-custom-hooks'),
			'group' => 'Youtube' 
		),
		array( 
			'name'=>'wpematico get item audios', 
			'value'=>'wpematico_get_item_audios', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $item, $options_audios', 
			'type'=>'filter', 
			'description' => __('The item once its audio was downloaded and replaced in the content.', 'wpematico-custom-hooks'),
			'group' => 'Audio' 
		),
		array( 
			'name'=>'wpematico audio src url', 
			'value'=>'wpematico_audio_src_url', 
			'parameters'=>1, 
			'template_parameter'=>'$audio_src_real', 
			'type'=>'filter', 
			'description' => __('The audio address found in the item, before it is downloaded.', 'wpematico-custom-hooks'),
			'group' => 'Audio' 
		),
		array( 
			'name'=>'wpematico allowext audio', 
			'value'=>'wpematico_allowext_audio', 
			'parameters'=>1, 
			'template_parameter'=>'$allowed_audio', 
			'type'=>'filter', 
			'description' => __('File extensions accepted when downloading audio. Anything else is left where it is.', 'wpematico-custom-hooks'),
			'group' => 'Audio' 
		),
		array( 
			'name'=>'wpematico new audio name', 
			'value'=>'wpematico_new_audio_name', 
			'parameters'=>4, 
			'template_parameter'=>'$new_audio_name, $current_item, $options_audios, $item', 
			'type'=>'filter', 
			'description' => __('Filename the downloaded audio is stored under.', 'wpematico-custom-hooks'),
			'group' => 'Audio' 
		),
		array( 
			'name'=>'wpematico get item videos', 
			'value'=>'wpematico_get_item_videos', 
			'parameters'=>4, 
			'template_parameter'=>'$current_item, $campaign, $item, $options_videos', 
			'type'=>'filter', 
			'description' => __('The item once its video was downloaded and replaced in the content.', 'wpematico-custom-hooks'),
			'group' => 'Video' 
		),
		array( 
			'name'=>'wpematico video src url', 
			'value'=>'wpematico_video_src_url', 
			'parameters'=>1, 
			'template_parameter'=>'$video_src_real', 
			'type'=>'filter', 
			'description' => __('The video address found in the item, before it is downloaded.', 'wpematico-custom-hooks'),
			'group' => 'Video' 
		),
		array( 
			'name'=>'wpematico allowext video', 
			'value'=>'wpematico_allowext_video', 
			'parameters'=>1, 
			'template_parameter'=>'$allowed_video', 
			'type'=>'filter', 
			'description' => __('File extensions accepted when downloading video. Anything else is left where it is.', 'wpematico-custom-hooks'),
			'group' => 'Video' 
		),
		array( 
			'name'=>'wpematico new video name', 
			'value'=>'wpematico_new_video_name', 
			'parameters'=>4, 
			'template_parameter'=>'$new_video_name, $current_item, $campaign, $item', 
			'type'=>'filter', 
			'description' => __('Filename the downloaded video is stored under.', 'wpematico-custom-hooks'),
			'group' => 'Video' 
		),
		// Added in WPeMatico 2.9.
		array( 
			'name'=>'wpematico create autocat', 
			'value'=>'wpematico_create_autocat', 
			'parameters'=>4, 
			'template_parameter'=>'$create, $catname, $parent_cat, $campaign', 
			'type'=>'filter', 
			'description' => __('Return false so a category read from the feed is only assigned when it already exists, never created.', 'wpematico-custom-hooks'),
			'group' => 'Category' 
		),
		array( 
			'name'=>'wpematico post parent', 
			'value'=>'wpematico_post_parent', 
			'parameters'=>4, 
			'template_parameter'=>'$post_parent, $current_item, $campaign, $item', 
			'type'=>'filter', 
			'description' => __('The post the item is filed under as a child. 0 means no parent.', 'wpematico-custom-hooks'),
			'group' => 'Parser' 
		),
		array( 
			'name'=>'wpematico rss campaign types', 
			'value'=>'wpematico_rss_campaign_types', 
			'parameters'=>1, 
			'template_parameter'=>'$types', 
			'type'=>'filter', 
			'description' => __('Campaign types fetched as a plain feed. A type listed here takes the standard route, with its timeouts, ordering and paging.', 'wpematico-custom-hooks'),
			'group' => 'Fetch' 
		),
		array( 
			'name'=>'wpematico fetch posts summary', 
			'value'=>'wpematico_fetch_posts_summary', 
			'parameters'=>3, 
			'template_parameter'=>'$summary, $campaign, $fetched_posts', 
			'type'=>'filter', 
			'description' => __('The Processed Posts line of the run result. A campaign that imports nothing by design can report a count that means something.', 'wpematico-custom-hooks'),
			'group' => 'Fetch' 
		)	
	);

	//WPEMATICO VIMEO CAMPAIGN TYPE (core 2.9, only when the feature is enabled)
	$wpematicohk_cfg = get_option('WPeMatico_Options');
	if (is_array($wpematicohk_cfg) && !empty($wpematicohk_cfg['enable_vimeo'])) {
		array_push($wpematicohk_data_filter_action,
			array( 
			'name'=>'wpematico vimeo video', 
			'value'=>'wpematico_vimeo_video', 
			'parameters'=>4, 
			'template_parameter'=>'$video, $current_item, $campaign, $item', 
			'type'=>'filter', 
			'description' => __('The Vimeo player embed built for the item.', 'wpematico-custom-hooks'),
			'group' => 'Vimeo' 
			),
			array( 
			'name'=>'wpematico vimeo thumbnails', 
			'value'=>'wpematico_vimeo_thumbnails', 
			'parameters'=>4, 
			'template_parameter'=>'$thumbnail, $current_item, $campaign, $item', 
			'type'=>'filter', 
			'description' => __('Thumbnail address of the Vimeo video, before it is downloaded.', 'wpematico-custom-hooks'),
			'group' => 'Vimeo' 
			)
		);
	}


	//WPEMATICO ADD ONS PROFESIONAL
	if(array_search( 'wpematicopro.php', $active_plugins_names )!==FALSE){
		array_push($wpematicohk_data_filter_action,
					array( 
					'name'=>'Wpempro feed name author', 
					'value'=>'wpempro_feed_name_author', 
					'parameters'=>1, 
					'template_parameter'=>'$feed_name_author', 
					'type'=>'filter', 
					'description' => __('The author name read from the feed, before the user is looked up or created.', 'wpematico-custom-hooks'),
					'group' => 'Professional'),
					array( 
					'name'=>'Date from tag namespace', 
					'value'=>'date_from_tag_namespace', 
					'parameters'=>5, 
					'template_parameter'=>'$namespace, $current_item, $campaign, $feed, $item', 
					'type'=>'filter', 
					'description' => __('The XML namespace the item date is read from.', 'wpematico-custom-hooks'),
					'group' => 'Professional')

		)
					;
	}
	if(array_search('wpematico_fullcontent.php', $active_plugins_names )!==FALSE){
		//WPEMATICO ADD ONS FULL CONTENT
		array_push($wpematicohk_data_filter_action,
			array( 
			'name'=>'websites video',
			// Full Content fires this without the wpemfullcontent_ prefix
			// (inc/campaign_fetch.php: apply_filters('websites_video', $website_videos)).
			'value'=>'websites_video',
			'parameters'=>1,
			'template_parameter'=>'$website_videos', 
			'type'=>'filter', 
			'description' => __('The sites Full Content recognises as video pages.', 'wpematico-custom-hooks'),
			'group' => 'Full Content'
			), 
			array( 
			'name'=>'Wpematico fullcontent folder', 
			'value'=>'wpematico_fullcontent_folder', 
			'parameters'=>1, 
			'template_parameter'=>'$customconfigdir', 
			'type'=>'filter', 
			'description' => __('Folder Full Content reads its per site extraction rules from.', 'wpematico-custom-hooks'),
			'group' => 'Full Content'
			), 
			array( 
			'name'=>'Wpepro getfullcontent', 
			'value'=>'wpepro_getfullcontent', 
			'parameters'=>2, 
			'template_parameter'=>'$url, $campaign', 
			'type'=>'filter', 
			'description' => __('Returns the whole article for an address. Answer it to replace the way Full Content downloads the page.', 'wpematico-custom-hooks'),
			'group' => 'Full Content'  
			), 
			array( 
			'name'=>'Full html content', 
			'value'=>'full_html_content', 
			'parameters'=>1, 
			'template_parameter'=>'$html', 
			'type'=>'filter', 
			'description' => __('The whole article HTML that Full Content read from the source page.', 'wpematico-custom-hooks'),
			'group' => 'Full Content' 
			), 
			array( 
			'name'=>'After full html content', 
			'value'=>'after_full_html_content', 
			'parameters'=>5, 
			'template_parameter'=>'$html, $current_item, $campaign, $feed, $item', 
			'type'=>'action', 
			'description' => __('Fires once Full Content has the whole article of the item.', 'wpematico-custom-hooks'),
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
			'template_parameter'=>'$ret, $api', 
			'type'=>'filter', 
			'description' => __('Whether the given translation service is configured and may be used.', 'wpematico-custom-hooks'),
			'group' =>'Polyglot'
			), 
			array( 
			'name'=>'polyglot_get_apis', 
			'value'=>'polyglot_get_apis', 
			'parameters'=>1, 
			'template_parameter'=>'$list_api', 
			'type'=>'filter', 
			'description' => __('The translation services offered on the campaign, as label to id.', 'wpematico-custom-hooks'),
			'group' =>'Polyglot'
			), 
			array( 
			'name'=>'polyglot_get_idioms_options', 
			'value'=>'polyglot_get_idioms_options', 
			'parameters'=>1, 
			'template_parameter'=>'$options', 
			'type'=>'filter', 
			'description' => __('The languages offered for translation.', 'wpematico-custom-hooks'),
			'group' =>'Polyglot'
			), 
			array( 
			'name'=>'polyglot_process_type', 
			'value'=>'polyglot_process_type', 
			'parameters'=>2, 
			'template_parameter'=>'$type, $campaign', 
			'type'=>'filter', 
			'description' => __('Which clean-up runs on the content before it is translated. The name answers the polyglot process filter for that type.', 'wpematico-custom-hooks'),
			'group' =>'Polyglot' 
			), 
			array( 
			'name'=>'polyglot_process_strip_tags', 
			'value'=>'polyglot_process_strip_tags', 
			'parameters'=>2, 
			'template_parameter'=>'$args, $campaign', 
			'type'=>'filter', 
			'description' => __('Cleans the post arguments before they are translated. This is what polyglot process type selects, strip_tags by default.', 'wpematico-custom-hooks'),
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
			'template_parameter'=>'$options', 
			'type'=>'filter', 
			'description' => __('The Better Excerpts options, normalised with their defaults.', 'wpematico-custom-hooks'),
			'group' =>'Better Excerpt' 
			),
			array( 
			'name'=>'wpem_after_better_excerpts_fields', 
			'value'=>'wpem_after_better_excerpts_fields', 
			'parameters'=>1, 
			'template_parameter'=>'$better_excerpts', 
			'type'=>'action', 
			'description' => __('Fires at the end of the Better Excerpts fields, to add your own.', 'wpematico-custom-hooks'),
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