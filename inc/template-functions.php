<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package smile-web
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function smile_v6_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'smile_v6_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function smile_v6_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'smile_v6_pingback_header' );


add_filter(
	'comment_form_defaults',
	function ( $defaults ) {
		$defaults['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s"> %4$s </button>';
		$defaults['submit_field']  = '<p class="form-submit btn-wrapper">%1$s %2$s</p>';
		$defaults['class_submit']  = 'btn';
		return $defaults;
	}
);