<?php
/*
Plugin Name: WP List Posts Shortcode
Description: A shortcode that lists post in your blog.  Refer to the template tag <a href="http://codex.wordpress.org/Template_Tags/get_posts">get posts</a> for input arguments.
Author: OLT 
Version: 0.1
Author URI: http://olt.ubc.ca
*/

function wp_list_posts_func($atts) {	
	
	extract(shortcode_atts(array(
		'numberposts' => '5',
		'offset' => '0',
		'category' => '',
		'category_name' => '',
		'tag' => '',
		'orderby' => 'post_date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' => '',
		'post_type' => 'post',
		'post_status' => 'publish',
		'post_parent' => '',
		'nopaging' => '',
		'excerpt' => '',
	),$atts));	

	$posts = get_posts($atts);
	
	ob_start();

	if($posts): _e('<ul>'); foreach($posts as $post):
	
		_e('<li id="'.$post->post_type.'-'.$post->ID.'" 
class="author-'.$post->post_author.'">');
		
		_e('<a href="'.get_permalink($post->ID).'">'); 
		
		_e($post->post_title);
		
		_e('</a>');
		
		if($excerpt):
		
			_e('<br 
/>'.substr(strip_tags($post->post_content), 0, $excerpt).'...');
		
		endif;
		
		_e('</li>');
	
	endforeach; _e('</ul>'); endif;

	return ob_get_clean();
}


function wp_list_posts_shortcode_init() {
    
    add_shortcode('wp_list_posts', 'wp_list_posts_func');
    
}

add_action('init','wp_list_posts_shortcode_init');
