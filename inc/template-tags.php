<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package smile-web
 */

if ( ! function_exists( 'smile_v6_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function smile_v6_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'smile-web' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'smile_v6_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function smile_v6_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'smile-web' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'smile_v6_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function smile_v6_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'smile-web' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'smile-web' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'smile-web' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'smile-web' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'smile-web' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'smile-web' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'smile_v6_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function smile_v6_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


/**
 * Displays an obfuscated email address to hinder spambots.
 *
 * @param string $email Email address to obfuscate.
 */
function smile_v6_mostrar_correo_ofuscado( $email ) {
	if ( ( ! empty( $email ) ) && filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		$email_parts = explode( '@', $email );
		if ( count( $email_parts ) === 2 ) {
			$email_user   = $email_parts[0];
			$email_domain = $email_parts[1];

			echo '<p class="email-ofuscado"><script type="text/javascript">';
			echo 'var emailUser = "' . esc_js( $email_user ) . '";';
			echo 'var emailDomain = "' . esc_js( $email_domain ) . '";';
			echo 'var emailComplete = emailUser + "@" + emailDomain;';
			echo 'document.write("<a href=\'' . esc_url( 'mailto:' ) . '" + emailComplete + "\' target=\'_blank\' rel=\'noopener nofollow noreferrer\'>" + emailComplete + "</a>");';
			echo '</script></p>';
		} else {
			echo '<p>' . esc_html__( 'Error: Invalid email address.', 'smile-web' ) . '</p>';
		}
	} else {
		echo '<p>' . esc_html__( 'Error: Invalid email address.', 'smile-web' ) . '</p>';
	}
}

/**
 * Adds social media icons to the social menu.
 *
 * @param array  $items Array of menu items.
 * @param object $args  Menu arguments.
 * @return array Modified menu items with icons.
 */
function smile_v6_add_social_media_icons( $items, $args ) {
	if ( 'menu-2' === $args->theme_location ) {
		foreach ( $items as &$item ) {
			$normalized_title = strtolower( str_replace( ' ', '-', preg_replace( '/\.[a-z]+$/', '', $item->title ) ) );
			$svg_file_path    = get_template_directory() . '/lib/fontawesome-free/svgs/brands/' . $normalized_title . '.svg';
			if ( file_exists( $svg_file_path ) ) {
				ob_start();
				include $svg_file_path;
				$svg_content = ob_get_clean();
				if ( ! empty( $svg_content ) ) {
					$item->title = '<span class="svg-icon">' . $svg_content . '</span>';
				}
			}
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'smile_v6_add_social_media_icons', 10, 2 );

/**
 * Adds custom CSS classes to menu items for the specified menu.
 *
 * @param array  $classes The CSS classes for the menu item's <li> element.
 * @param object $item    The current menu item.
 * @param object $args    An object of wp_nav_menu() arguments.
 * @return array Modified menu item classes.
 */
function smile_v6_add_menu_item_class( $classes, $item, $args ) {
	if ( 'menu-3' === $args->theme_location ) {
		$classes[] = 'pe-4';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'smile_v6_add_menu_item_class', 10, 3 );
