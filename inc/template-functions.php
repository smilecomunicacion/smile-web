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

/**
 * Trims a raw text string to a meta description friendly length.
 *
 * @since 6.0.8
 * @package smile-web
 *
 * @param string $text Raw text to trim.
 * @return string
 */
function smile_v6_trim_meta_description( $text ) {
        $text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( (string) $text ) ) );

        if ( '' === $text ) {
                return '';
        }

        if ( function_exists( 'mb_strlen' ) && function_exists( 'mb_substr' ) ) {
                $length = mb_strlen( $text, 'UTF-8' );
                if ( $length > 160 ) {
                        $text = trim( mb_substr( $text, 0, 157, 'UTF-8' ) ) . '…';
                }
        } elseif ( strlen( $text ) > 160 ) {
                $text = trim( substr( $text, 0, 157 ) ) . '…';
        }

        return $text;
}

/**
 * Generates the meta description text for the current view.
 *
 * @since 6.0.8
 * @package smile-web
 *
 * @return string
 */
function smile_v6_get_meta_description_text() {
        $description = '';

        if ( is_singular() ) {
                $post_object = get_queried_object();
                if ( $post_object instanceof WP_Post ) {
                        $raw_text = $post_object->post_excerpt ? $post_object->post_excerpt : $post_object->post_content;
                        $description = smile_v6_trim_meta_description( $raw_text );
                }
        } elseif ( is_category() || is_tag() || is_tax() ) {
                $term = get_queried_object();
                if ( $term && ! empty( $term->description ) ) {
                        $description = smile_v6_trim_meta_description( $term->description );
                }
        } elseif ( is_author() ) {
                $author_id   = (int) get_query_var( 'author' );
                $raw_bio     = get_the_author_meta( 'description', $author_id );
                $description = smile_v6_trim_meta_description( $raw_bio );
        } elseif ( is_search() ) {
                $description = smile_v6_trim_meta_description(
                        sprintf(
                                /* translators: %s: search query. */
                                __( 'Search results for "%s".', 'smile-web' ),
                                get_search_query()
                        )
                );
        }

        if ( '' === $description ) {
                $description = smile_v6_trim_meta_description( get_bloginfo( 'description', 'display' ) );
        }

        return $description;
}

/**
 * Outputs a meta description tag populated from the current content.
 *
 * @since 6.0.8
 * @package smile-web
 *
 * @return void
 */
function smile_v6_render_meta_description() {
        if ( is_feed() ) {
                return;
        }

        $description = smile_v6_get_meta_description_text();

        if ( '' === $description ) {
                return;
        }

        printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );
}
add_action( 'wp_head', 'smile_v6_render_meta_description', 1 );


add_filter(
        'comment_form_defaults',
        function ( $defaults ) {
                $defaults['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s"> %4$s </button>';
		$defaults['submit_field']  = '<p class="form-submit btn-wrapper">%1$s %2$s</p>';
		$defaults['class_submit']  = 'btn';
		return $defaults;
	}
);