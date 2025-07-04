<?php
// Register REST API routes for Garment Customizer plugin

add_action( 'rest_api_init', function () {
    register_rest_route( 'garment-customizer/v1', '/garments', array(
        'methods' => 'GET',
        'callback' => 'gc_get_garments',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( 'garment-customizer/v1', '/garment/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'gc_get_garment',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( 'garment-customizer/v1', '/garment', array(
        'methods' => 'POST',
        'callback' => 'gc_save_garment',
        'permission_callback' => function () {
            return current_user_can( 'edit_posts' );
        },
    ) );
} );

function gc_get_garments( $request ) {
    $args = array(
        'post_type' => 'garment',
        'posts_per_page' => -1,
    );
    $query = new WP_Query( $args );
    $garments = array();

    while ( $query->have_posts() ) {
        $query->the_post();
        $garments[] = array(
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'content' => get_the_content(),
            'meta' => get_post_meta( get_the_ID() ),
        );
    }
    wp_reset_postdata();

    return rest_ensure_response( $garments );
}

function gc_get_garment( $request ) {
    $id = (int) $request['id'];
    $post = get_post( $id );

    if ( ! $post || $post->post_type !== 'garment' ) {
        return new WP_Error( 'no_garment', 'Garment not found', array( 'status' => 404 ) );
    }

    $garment = array(
        'id' => $post->ID,
        'title' => $post->post_title,
        'content' => $post->post_content,
        'meta' => get_post_meta( $post->ID ),
    );

    return rest_ensure_response( $garment );
}

function gc_save_garment( $request ) {
    $params = $request->get_json_params();

    $postarr = array(
        'post_type' => 'garment',
        'post_title' => sanitize_text_field( $params['title'] ?? '' ),
        'post_content' => sanitize_textarea_field( $params['content'] ?? '' ),
        'post_status' => 'publish',
    );

    if ( ! empty( $params['id'] ) ) {
        $postarr['ID'] = (int) $params['id'];
        $post_id = wp_update_post( $postarr, true );
    } else {
        $post_id = wp_insert_post( $postarr, true );
    }

    if ( is_wp_error( $post_id ) ) {
        return $post_id;
    }

    // Save meta fields
    if ( ! empty( $params['meta'] ) && is_array( $params['meta'] ) ) {
        foreach ( $params['meta'] as $key => $value ) {
            update_post_meta( $post_id, sanitize_key( $key ), maybe_serialize( $value ) );
        }
    }

    return rest_ensure_response( array( 'id' => $post_id ) );
}
