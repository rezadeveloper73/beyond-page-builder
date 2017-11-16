<?php
/*
Plugin Name: Beyond  Page Bulider
Description: The custom slider plugin.
Author: Reza_Developer
*/ 
/*********************************************************************************************
Registers Custom Slider Post Type
*********************************************************************************************///
function beyond_page_builder_post_type() {
	$labels = array(
		'name' 					=> __('Page Builder','beyond'),
		'singular_name'			=> __('Page Builders','beyond'),
		'add_new'				=> __('Add New','beyond'),
		'add_new_item'			=>__('Add New Page Builder','beyond'),
		'edit_item'				=> __('Edit Page Builder','beyond'),
		'new_item'				=> __('New Page Builder','beyond'),
		'view_item'				=> __('View  Page Builder','beyond'),
 		'all_items'				=>__('All Page Builders','beyond'),
 		'search_items'			=> __('Search Page Builders','beyond'),
		'not_found'				=>  __('No Page Builders found','beyond'),
		'not_found_in_trash'	=>__('No Page Builders found in trash','beyond'),
		'parent_item_colon'		=> '',
		'menu_name'				=> __('Page Builder','beyond')
	);
	
	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'show_ui'				=> true, 
		'show_in_menu'			=> true, 
		'query_var'				=> true,
		'rewrite'				=> true,
		'capability_type'		=> 'post',
		'has_archive'			=> false, 
		'hierarchical'			=> false,
		'menu_position'			=> null,
		'supports' => array( 'title' )
	); 

	register_post_type( 'beyond_page_builder', $args );
}
add_action( 'init', 'beyond_page_builder_post_type' );
 
   
/*********************************************************************************************
Registers Custom Slider Post Type
*********************************************************************************************///
function beyond_slide_post_type() {
	$labels = array(
		'name' 					=> __('Slides','beyond'),
		'singular_name'			=> __('Slide','beyond'),
		'add_new'				=> __('Add New','beyond'),
		'add_new_item'			=>__('Add New Slide','beyond'),
		'edit_item'				=> __('Edit Slide','beyond'),
		'new_item'				=> __('New Slide','beyond'),
		'view_item'				=> __('View Slide','beyond'),
 		'all_items'				=>__('All Slides','beyond'),
 		'search_items'			=> __('Search Slides','beyond'),
		'not_found'				=>  __('No slides found','beyond'),
		'not_found_in_trash'	=>__('No slides found in trash','beyond'),
		'parent_item_colon'		=> '',
		'menu_name'				=> __('Custom Slides','beyond')
	);
	
	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'publicly_queryable'	=> true,
		'show_ui'				=> true, 
		'show_in_menu'			=> true, 
		'query_var'				=> true,
		'rewrite'				=> true,
		'capability_type'		=> 'post',
		'has_archive'			=> false, 
		'hierarchical'			=> false,
		'menu_position'			=> null,
		'supports' => array( 'title', 'thumbnail' )
	); 

	register_post_type( 'beyond_slide', $args );
}
add_action( 'init', 'beyond_slide_post_type' );
 
 
add_action( 'init', 'beyond_sliders_taxonomy', 0 );
function beyond_sliders_taxonomy() {
 
   $labels = array(
    'name'							=> __( 'Sliders','beyond' ),
    'singular_name'					=> __( 'Slider','beyond'  ),
    'search_items'					=> __( 'Search Sliders' ,'beyond' ),
    'popular_items'					=> __( 'Popular Sliders','beyond'  ),
    'all_items' 					=> __( 'All Sliders' ,'beyond' ),
    'parent_item'					=> __( 'Parent Slider' ,'beyond' ),
    'edit_item'						=> __( 'Edit Topic','beyond' ), 
    'update_item' 					=> __( 'Update Slider','beyond'  ),
    'add_new_item'					=> __( 'Add New Slider','beyond'  ),
    'new_item_name'			 		=> __( 'New Topic Name' ,'beyond' ),
    'separate_items_with_commas'	=> __( 'Separate Sliders with commas' ,'beyond' ),
    'add_or_remove_items'			=> __( 'Add or remove Sliders','beyond'  ),
    'choose_from_most_used' 		=> __( 'Choose from the most used Sliders','beyond'  ),
    'menu_name' 					=> __( 'Sliders' ,'beyond' ),
  ); 


// Now register the taxonomy

  register_taxonomy('beyond_sliders','beyond_slide', array(
    'hierarchical' 					=> true,
    'labels' 						=> $labels,
    'show_ui' 						=> true,
    'show_admin_column'				=> true,
    'query_var'						=> true,
    'rewrite' 						=> array( 'slug' => 'beyond_sliders' ),
  ));

}
add_filter('manage_beyond_slide_posts_columns', 'beyond_add_thumbnail_column', 5);

function beyond_add_thumbnail_column($columns){
  $columns['new_post_excerpt'] = __('Excerpt','beyond');
  $columns['new_post_thumb'] = __('Featured Image','beyond');
  return $columns;
}

add_action('manage_beyond_slide_posts_custom_column', 'beyond_display_thumbnail_column', 5, 2);

function beyond_display_thumbnail_column($column_name, $post_id){
  switch($column_name){
    case 'new_post_thumb':
      $post_thumbnail_id = get_post_thumbnail_id($post_id);
      if (!empty($post_thumbnail_id)) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
        echo '<img width="100" src="' . esc_url($post_thumbnail_img[0]) . '" />';
      }
      break;
    case 'new_post_excerpt':
	$the_excerpt = strip_tags(get_the_excerpt());
  	if ( strlen($the_excerpt) > 200 && 200){
 		 $content= mb_substr($the_excerpt, 0,200); $dots='...';
		 
	}else{
		$content= @$the_excerpt;
		$dots='';
	}
	  echo esc_html($content),esc_html($dots);	
      break;
	  
  }
}

 
 
 
?>