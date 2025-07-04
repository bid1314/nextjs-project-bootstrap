<?php
// Register custom post type for Garments

function gc_register_garment_post_type() {
    $labels = array(
        'name'                  => _x( 'Garments', 'Post type general name', 'garment-customizer' ),
        'singular_name'         => _x( 'Garment', 'Post type singular name', 'garment-customizer' ),
        'menu_name'             => _x( 'Garments', 'Admin Menu text', 'garment-customizer' ),
        'name_admin_bar'        => _x( 'Garment', 'Add New on Toolbar', 'garment-customizer' ),
        'add_new'               => __( 'Add New', 'garment-customizer' ),
        'add_new_item'          => __( 'Add New Garment', 'garment-customizer' ),
        'new_item'              => __( 'New Garment', 'garment-customizer' ),
        'edit_item'             => __( 'Edit Garment', 'garment-customizer' ),
        'view_item'             => __( 'View Garment', 'garment-customizer' ),
        'all_items'             => __( 'All Garments', 'garment-customizer' ),
        'search_items'          => __( 'Search Garments', 'garment-customizer' ),
        'parent_item_colon'     => __( 'Parent Garments:', 'garment-customizer' ),
        'not_found'             => __( 'No garments found.', 'garment-customizer' ),
        'not_found_in_trash'    => __( 'No garments found in Trash.', 'garment-customizer' ),
        'featured_image'        => _x( 'Garment Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'garment-customizer' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'garment-customizer' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'garment-customizer' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'garment-customizer' ),
        'archives'              => _x( 'Garment archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'garment-customizer' ),
        'insert_into_item'      => _x( 'Insert into garment', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'garment-customizer' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this garment', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'garment-customizer' ),
        'filter_items_list'     => _x( 'Filter garments list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'garment-customizer' ),
        'items_list_navigation' => _x( 'Garments list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'garment-customizer' ),
        'items_list'            => _x( 'Garments list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'garment-customizer' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'garment' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-admin-appearance',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'garment', $args );
}
add_action( 'init', 'gc_register_garment_post_type' );
