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
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'destination_type', array( 'destination' ), $args );

}
add_action( 'init', 'snth_destination_type_tax', 0 );