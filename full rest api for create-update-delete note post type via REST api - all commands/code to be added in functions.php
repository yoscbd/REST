<?php

//locolize the main them js script example:

function university_files() {
  
  wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  
  wp_localize_script('main-university-js', 'universityData', array(
    'root_url' => get_site_url(), // setting the root url of our theme
    'nonce' => wp_create_nonce('wp_rest') // creating a nonce to be use on ajax requests
  ));

}

//register notes custom post type:
function university_post_types() {
  // Note Post Type
  register_post_type('note', array(
    'capability_type' => 'note', //set capability_type to true if we are going to limit this for users by the user role on wordpress
    'map_meta_cap' => true,      //set map_meta_cap to true if we are going to limit this for users by the user role on wordpress
    'show_in_rest' => true,      // set show_in_rest to true so we can use rest for this post type 
    'supports' => array('title', 'editor'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Notes',
      'add_new_item' => 'Add New Note',
      'edit_item' => 'Edit Note',
      'all_items' => 'All Notes',
      'singular_name' => 'Note'
    ),
    'menu_icon' => 'dashicons-welcome-write-blog'
  ));
}

add_action('init', 'university_post_types');



// Force note posts to be private
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

function makeNotePrivate($data, $postarr) {
  if ($data['post_type'] == 'note') {
    if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {
      die("You have reached your note limit.");
    }

    $data['post_content'] = sanitize_textarea_field($data['post_content']);
    $data['post_title'] = sanitize_text_field($data['post_title']);
  }

  if($data['post_type'] == 'note' AND $data['post_status'] != 'trash') {
    $data['post_status'] = "private";
  }
  
  return $data;
}