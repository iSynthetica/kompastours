<?php
/**
 * Custom Post Types
 *
 * @package Hooka/Includes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Register Custom Post Type
function snth_destination_cpt() {

    $labels = array(
        'name'                  => _x( 'Destinations', 'Post Type General Name', 'snthwp' ),
        'singular_name'         => _x( 'Destination', 'Post Type Singular Name', 'snthwp' ),
        'menu_name'             => __( 'Destinations', 'snthwp' ),
        'name_admin_bar'        => __( 'Destination', 'snthwp' ),
        'archives'              => __( 'Destination Archives', 'snthwp' ),
        'attributes'            => __( 'Destination Attributes', 'snthwp' ),
        'parent_item_colon'     => __( 'Parent Destination:', 'snthwp' ),
        'all_items'             => __( 'All Destinations', 'snthwp' ),
        'add_new_item'          => __( 'Add New Destination', 'snthwp' ),
        'add_new'               => __( 'Add New', 'snthwp' ),
        'new_item'              => __( 'New Destination', 'snthwp' ),
        'edit_item'             => __( 'Edit Destination', 'snthwp' ),
        'update_item'           => __( 'Update Destination', 'snthwp' ),
        'view_item'             => __( 'View Destination', 'snthwp' ),
        'view_items'            => __( 'View Destinations', 'snthwp' ),
        'search_items'          => __( 'Search Destination', 'snthwp' ),
        'not_found'             => __( 'Not found', 'snthwp' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'snthwp' ),
        'featured_image'        => __( 'Featured Image', 'snthwp' ),
        'set_featured_image'    => __( 'Set featured image', 'snthwp' ),
        'remove_featured_image' => __( 'Remove featured image', 'snthwp' ),
        'use_featured_image'    => __( 'Use as featured image', 'snthwp' ),
        'insert_into_item'      => __( 'Insert into Destination', 'snthwp' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Destination', 'snthwp' ),
        'items_list'            => __( 'Destinations list', 'snthwp' ),
        'items_list_navigation' => __( 'Destinations list navigation', 'snthwp' ),
        'filter_items_list'     => __( 'Filter Destinations list', 'snthwp' ),
    );
    $rewrite = array(
        'slug'                  => 'countries',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Destination', 'snthwp' ),
        'description'           => __( 'Destinations post type for countries and regions', 'snthwp' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-location',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'countries',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
    );
    register_post_type( 'destination', $args );

}
add_action( 'init', 'snth_destination_cpt', 0 );

// Register Custom Taxonomy
function snth_destination_type_tax() {

    $labels = array(
        'name'                       => _x( 'Types', 'Taxonomy General Name', 'snthwp' ),
        'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'snthwp' ),
        'menu_name'                  => __( 'Type', 'snthwp' ),
        'all_items'                  => __( 'All Types', 'snthwp' ),
        'parent_item'                => __( 'Parent Type', 'snthwp' ),
        'parent_item_colon'          => __( 'Parent Type:', 'snthwp' ),
        'new_item_name'              => __( 'New Type Name', 'snthwp' ),
        'add_new_item'               => __( 'Add New Type', 'snthwp' ),
        'edit_item'                  => __( 'Edit Type', 'snthwp' ),
        'update_item'                => __( 'Update Type', 'snthwp' ),
        'view_item'                  => __( 'View Type', 'snthwp' ),
        'separate_items_with_commas' => __( 'Separate Types with commas', 'snthwp' ),
        'add_or_remove_items'        => __( 'Add or remove Types', 'snthwp' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'snthwp' ),
        'popular_items'              => __( 'Popular Types', 'snthwp' ),
        'search_items'               => __( 'Search Types', 'snthwp' ),
        'not_found'                  => __( 'Not Found', 'snthwp' ),
        'no_terms'                   => __( 'No Types', 'snthwp' ),
        'items_list'                 => __( 'Types list', 'snthwp' ),
        'items_list_navigation'      => __( 'Types list navigation', 'snthwp' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'destination_type', array( 'destination' ), $args );

}
add_action( 'init', 'snth_destination_type_tax', 0 );

// Register Custom Post Type
function snth_partner_cpt() {

    $labels = array(
        'name'                  => _x( 'Partners', 'Post Type General Name', 'snthwp' ),
        'singular_name'         => _x( 'Partner', 'Post Type Singular Name', 'snthwp' ),
        'menu_name'             => __( 'Partners', 'snthwp' ),
        'name_admin_bar'        => __( 'Partner', 'snthwp' ),
        'archives'              => __( 'Partners Archives', 'snthwp' ),
        'attributes'            => __( 'Partner Attributes', 'snthwp' ),
        'parent_item_colon'     => __( 'Parent Partner:', 'snthwp' ),
        'all_items'             => __( 'All Partners', 'snthwp' ),
        'add_new_item'          => __( 'Add New Partner', 'snthwp' ),
        'add_new'               => __( 'Add New', 'snthwp' ),
        'new_item'              => __( 'New Partner', 'snthwp' ),
        'edit_item'             => __( 'Edit Partner', 'snthwp' ),
        'update_item'           => __( 'Update Partner', 'snthwp' ),
        'view_item'             => __( 'View Partner', 'snthwp' ),
        'view_items'            => __( 'View Partners', 'snthwp' ),
        'search_items'          => __( 'Search Partner', 'snthwp' ),
        'not_found'             => __( 'Not found', 'snthwp' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'snthwp' ),
        'featured_image'        => __( 'Featured Image', 'snthwp' ),
        'set_featured_image'    => __( 'Set featured image', 'snthwp' ),
        'remove_featured_image' => __( 'Remove featured image', 'snthwp' ),
        'use_featured_image'    => __( 'Use as featured image', 'snthwp' ),
        'insert_into_item'      => __( 'Insert into Partner', 'snthwp' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Partner', 'snthwp' ),
        'items_list'            => __( 'Partners list', 'snthwp' ),
        'items_list_navigation' => __( 'Partners list navigation', 'snthwp' ),
        'filter_items_list'     => __( 'Filter Partners list', 'snthwp' ),
    );
    $args = array(
        'label'                 => __( 'Partner', 'snthwp' ),
        'description'           => __( 'Partners of our tourist agency', 'snthwp' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-businessman',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'page',
    );
    register_post_type( 'partner', $args );

}
add_action( 'init', 'snth_partner_cpt', 0 );

// Register Custom Post Type
function snth_landing_cpt() {

    $labels = array(
        'name'                  => _x( 'Landings', 'Post Type General Name', 'snthwp' ),
        'singular_name'         => _x( 'Landing', 'Post Type Singular Name', 'snthwp' ),
        'menu_name'             => __( 'Landings', 'snthwp' ),
        'name_admin_bar'        => __( 'Landing', 'snthwp' ),
        'archives'              => __( 'Landing Archives', 'snthwp' ),
        'attributes'            => __( 'Landing Attributes', 'snthwp' ),
        'parent_item_colon'     => __( 'Parent Landing:', 'snthwp' ),
        'all_items'             => __( 'All Landings', 'snthwp' ),
        'add_new_item'          => __( 'Add New Landing', 'snthwp' ),
        'add_new'               => __( 'Add New', 'snthwp' ),
        'new_item'              => __( 'New Landing', 'snthwp' ),
        'edit_item'             => __( 'Edit Landing', 'snthwp' ),
        'update_item'           => __( 'Update Landing', 'snthwp' ),
        'view_item'             => __( 'View Landing', 'snthwp' ),
        'view_items'            => __( 'View Landings', 'snthwp' ),
        'search_items'          => __( 'Search Landing', 'snthwp' ),
        'not_found'             => __( 'Not found', 'snthwp' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'snthwp' ),
        'featured_image'        => __( 'Featured Image', 'snthwp' ),
        'set_featured_image'    => __( 'Set featured image', 'snthwp' ),
        'remove_featured_image' => __( 'Remove featured image', 'snthwp' ),
        'use_featured_image'    => __( 'Use as featured image', 'snthwp' ),
        'insert_into_item'      => __( 'Insert into Landing', 'snthwp' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Landing', 'snthwp' ),
        'items_list'            => __( 'Landings list', 'snthwp' ),
        'items_list_navigation' => __( 'Landings list navigation', 'snthwp' ),
        'filter_items_list'     => __( 'Filter Landings list', 'snthwp' ),
    );
    $rewrite = array(
        'slug'                  => 'lp',
        'with_front'            => true,
        'pages'                 => false,
        'feeds'                 => false,
    );
    $args = array(
        'label'                 => __( 'Landing', 'snthwp' ),
        'description'           => __( 'Landing pages generator', 'snthwp' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-megaphone',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
    );
    register_post_type( 'landing', $args );

}
add_action( 'init', 'snth_landing_cpt', 0 );

// Register Custom Post Type
function snth_testimonials_cpt() {

    $labels = array(
        'name'                  => _x( 'Testimonials', 'Post Type General Name', 'snthwp' ),
        'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'snthwp' ),
        'menu_name'             => __( 'Testimonials', 'snthwp' ),
        'name_admin_bar'        => __( 'Testimonial', 'snthwp' ),
        'archives'              => __( 'Testimonial Archives', 'snthwp' ),
        'attributes'            => __( 'Testimonial Attributes', 'snthwp' ),
        'parent_item_colon'     => __( 'Parent Testimonial:', 'snthwp' ),
        'all_items'             => __( 'All Testimonials', 'snthwp' ),
        'add_new_item'          => __( 'Add New Testimonial', 'snthwp' ),
        'add_new'               => __( 'Add New', 'snthwp' ),
        'new_item'              => __( 'New Testimonial', 'snthwp' ),
        'edit_item'             => __( 'Edit Testimonial', 'snthwp' ),
        'update_item'           => __( 'Update Testimonial', 'snthwp' ),
        'view_item'             => __( 'View Testimonial', 'snthwp' ),
        'view_items'            => __( 'View Testimonials', 'snthwp' ),
        'search_items'          => __( 'Search Testimonial', 'snthwp' ),
        'not_found'             => __( 'Not found', 'snthwp' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'snthwp' ),
        'featured_image'        => __( 'Featured Image', 'snthwp' ),
        'set_featured_image'    => __( 'Set featured image', 'snthwp' ),
        'remove_featured_image' => __( 'Remove featured image', 'snthwp' ),
        'use_featured_image'    => __( 'Use as featured image', 'snthwp' ),
        'insert_into_item'      => __( 'Insert into Testimonial', 'snthwp' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'snthwp' ),
        'items_list'            => __( 'Testimonials list', 'snthwp' ),
        'items_list_navigation' => __( 'Testimonials list navigation', 'snthwp' ),
        'filter_items_list'     => __( 'Filter Testimonials list', 'snthwp' ),
    );
    $args = array(
        'label'                 => __( 'Testimonial', 'snthwp' ),
        'description'           => __( 'Testimonial pages generator', 'snthwp' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-heart',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'testimonial', $args );

}
add_action( 'init', 'snth_testimonials_cpt', 0 );

// Register Photo galleries CPT
function snth_gallery_cpt() {

    $labels = array(
        'name'                  => _x( 'Galleries', 'Post Type General Name', 'snthwp' ),
        'singular_name'         => _x( 'Gallery', 'Post Type Singular Name', 'snthwp' ),
        'menu_name'             => __( 'Galleries', 'snthwp' ),
        'name_admin_bar'        => __( 'Gallery', 'snthwp' ),
        'archives'              => __( 'Gallery Archives', 'snthwp' ),
        'attributes'            => __( 'Gallery Attributes', 'snthwp' ),
        'parent_item_colon'     => __( 'Parent Gallery:', 'snthwp' ),
        'all_items'             => __( 'All Galleries', 'snthwp' ),
        'add_new_item'          => __( 'Add New Gallery', 'snthwp' ),
        'add_new'               => __( 'Add New', 'snthwp' ),
        'new_item'              => __( 'New Gallery', 'snthwp' ),
        'edit_item'             => __( 'Edit Gallery', 'snthwp' ),
        'update_item'           => __( 'Update Gallery', 'snthwp' ),
        'view_item'             => __( 'View Gallery', 'snthwp' ),
        'view_items'            => __( 'View Galleries', 'snthwp' ),
        'search_items'          => __( 'Search Gallery', 'snthwp' ),
        'not_found'             => __( 'Not found', 'snthwp' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'snthwp' ),
        'featured_image'        => __( 'Featured Image', 'snthwp' ),
        'set_featured_image'    => __( 'Set featured image', 'snthwp' ),
        'remove_featured_image' => __( 'Remove featured image', 'snthwp' ),
        'use_featured_image'    => __( 'Use as featured image', 'snthwp' ),
        'insert_into_item'      => __( 'Insert into Destination', 'snthwp' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Gallery', 'snthwp' ),
        'items_list'            => __( 'Galleries list', 'snthwp' ),
        'items_list_navigation' => __( 'Galleries list navigation', 'snthwp' ),
        'filter_items_list'     => __( 'Filter Galleries list', 'snthwp' ),
    );
    $rewrite = array(
        'slug'                  => 'galleries',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Gallery', 'snthwp' ),
        'description'           => __( 'Galleries post type', 'snthwp' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 15,
        'menu_icon'             => 'dashicons-format-gallery',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'galleries',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
    );
    register_post_type( 'gallery', $args );

}
add_action( 'init', 'snth_gallery_cpt', 0 );