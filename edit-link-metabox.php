<?php
/**
 * Plugin Name: Edit Link Metabox
 * Description: Adds a metabox on the editor screen with a link to the previous or next post.
 * Author: Jose Castaneda
 * Version: 0.1.0
 * Author URI: https://blog.josemcastaneda.com/
 * License: GPL2+
 * Text Domain: elm
 */
add_action( 'add_meta_boxes', 'elm_mb', 10, 2 );
function elm_mb( $type, $post ) {
	add_meta_box( 'elm-post-nav', __( 'Edit Navigation', 'elm' ), 'elm_mb_render', '', 'side', 'high', $type );
}

function elm_mb_render( $type, $metabox ) {
	// Get our adjacent posts.
	$previous = get_adjacent_post();
	$next = get_adjacent_post( '', '', false );

	// Check if we have a prior post to link to.
	if ( $previous ) {
		printf( '<p>' . __( 'Edit previous %s:', 'elm' ) . '</p>', $metabox['args'] ); // XSS: okay
		printf( '<span>' . __( '<a href="%1$s">%2$s</a>', 'elm' ) . '</span>', esc_url( get_edit_post_link( $previous->ID ) ), get_the_title( $previous->ID ) );
	}

	// Check if we have a next post to link to.
	if ( $next ) {
		printf( '<p>' . __( 'Edit next %s:', 'elm' ) . '</p>', $metabox['args'] ); // XSS: okay
		printf( '<span>' . __( '<a href="%1$s">%2$s</a>', 'elm' ) . '</span>', esc_url( get_edit_post_link( $next->ID ) ), get_the_title( $next->ID ) );
	}
}
