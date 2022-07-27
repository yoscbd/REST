<?php
//this code will register our custompost type and allow it wo tork with the rest api
function ybd_post_types()
{


    // Note Post Type
    register_post_type('note', array(
        // 'capability_type' => 'note',
        //  'map_meta_cap' => true,
        'show_in_rest' => true, //allow us to work with rest for this post type
        'supports' => array('title'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Notes',
            'singular_name' => 'Note',
        ),
        'menu_icon' => 'dashicons-welcome-write-blog',
    ));
}

add_action('init', 'ybd_post_types');

// locolazing our main script.js variab;ls so we can use them later on js client side:

   wp_localize_script('understrap-scripts', 'universityData', array(
            'nonce' => wp_create_nonce('wp_rest'),
            'root_url' => get_site_url(),

        )
        );