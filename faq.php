<?php

add_action('init', function(){

    $labels = array(
        'name' => _x('FAQ', 'post type general name'),
        'singular_name' => _x('Question', 'post type singular name'),
        'add_new' => _x('Add New Question', 'Question'),
        'add_new_item' => __('Add New Question'),
        'edit_item' => __('Edit Question'),
        'new_item' => __('New Question'),
        'all_items' => __('All FAQ Questions'),
        'view_item' => __('View Question'),
        'search_items' => __('Search FAQ'),
        'not_found' => __('No FAQ found'),
        'not_found_in_trash' => __('No FAQ found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'FAQ'

    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')
    );
    register_post_type('FAQ', $args);
});

add_shortcode('faq', function(){

    wp_register_style('wptuts-jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/south-street/jquery-ui.css');
    wp_enqueue_style('wptuts-jquery-ui-style');

    wp_register_script('wptuts-custom-js', get_template_directory_uri() . '/faq/faq.js', array('jquery-ui-accordion'), '', true);
    wp_enqueue_script('wptuts-custom-js');


    $posts = get_posts(array(
        'numberposts' => 10,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_type' => 'faq',
    ));

    $faq  = '<div id="wptuts-accordion">'; ///Open the container
    foreach ( $posts as $post ){

        $faq .= sprintf(('<h3><a href="">%1$s</a></h3><div>%2$s</div>'), // Generate the markup for each Question
            $post->post_title,
            wpautop($post->post_content)
        );
    }

    $faq .= '</div>'; //Close the Container

    return $faq; //Return the HTML

});

