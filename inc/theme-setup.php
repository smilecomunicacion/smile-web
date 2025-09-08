<?php
/**
 * Theme Setup for SMiLE Web Theme.
 *
 * @package smile-web
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function smile_v6_setup() {
	load_theme_textdomain( 'smile-web', get_template_directory() . '/languages' );

	// Support custom background.
	add_theme_support(
		'custom-background',
		array(
			'default-color'    => 'ffffff', // Background color default.
			'default-image'    => '', // Background image default.
			'wp-head-callback' => '_custom_background_cb', // CSS callback function.
		)
	);

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	// Register nav menus.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'smile-web' ),
			'menu-2' => esc_html__( 'Social', 'smile-web' ),
			'menu-3' => esc_html__( 'Legal', 'smile-web' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Remove the theme editor for security.
	add_action(
		'admin_init',
		function () {
			remove_submenu_page( 'themes.php', 'theme-editor.php' );
		}
	);
}
add_action( 'after_setup_theme', 'smile_v6_setup' );

/**
 * Automatically sets up default menus when the theme is activated.
 */
function smile_v6_setup_default_menus() {
	$menu_locations = get_nav_menu_locations();
	if ( ( ! empty( $menu_locations['menu-1'] ) ) || ( ! empty( $menu_locations['menu-2'] ) ) || ( ! empty( $menu_locations['menu-3'] ) ) ) {
		return;
	}

	$menu1_id = wp_create_nav_menu( 'Main Menu' );
	$menu2_id = wp_create_nav_menu( 'Social Menu' );
	$menu3_id = wp_create_nav_menu( 'Legal Menu' );

	// Add all published pages to menu-1.
	$pages = get_pages();
	foreach ( $pages as $page ) {
		wp_update_nav_menu_item(
			$menu1_id,
			0,
			array(
				'menu-item-object-id' => $page->ID,
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);
	}

	// Add sample social links to menu-2.
	wp_update_nav_menu_item(
		$menu2_id,
		0,
		array(
			'menu-item-title'  => esc_html__( 'LinkedIn', 'smile-web' ),
			'menu-item-url'    => '#',
			'menu-item-status' => 'publish',
		)
	);
	wp_update_nav_menu_item(
		$menu2_id,
		0,
		array(
			'menu-item-title'  => esc_html__( 'Instagram', 'smile-web' ),
			'menu-item-url'    => '#',
			'menu-item-status' => 'publish',
		)
	);

	// Add privacy policy page to menu-3 if set.
	$privacy_page_id = get_option( 'wp_page_for_privacy_policy' );
	if ( ! empty( $privacy_page_id ) ) {
		wp_update_nav_menu_item(
			$menu3_id,
			0,
			array(
				'menu-item-object-id' => $privacy_page_id,
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);
	}

	// Assign the menus to their locations.
	$locations           = get_theme_mod( 'nav_menu_locations' ); // Get current menu locations.
	$locations['menu-1'] = $menu1_id;
	$locations['menu-2'] = $menu2_id;
	$locations['menu-3'] = $menu3_id;

	set_theme_mod( 'nav_menu_locations', $locations );
}
add_action( 'after_switch_theme', 'smile_v6_setup_default_menus' );

/**
 * Sets default menus for the theme if they already exist.
 */
function smile_v6_set_default_menus() {
	// Define the menus and their locations.
	$menus = array(
		'All Pages'   => 'menu-1',  // Menú "Primary".
		'Social menu' => 'menu-2', // Menú "Social".
		'Legal menu'  => 'menu-3', // Menú "Legal".
	);

	foreach ( $menus as $menu_name => $menu_location ) {
		// Verify if the menu exists.
		$menu = get_term_by( 'name', $menu_name, 'nav_menu' );
		if ( false !== $menu ) {
			$current_locations                   = get_theme_mod( 'nav_menu_locations', array() );
			$current_locations[ $menu_location ] = $menu->term_id;
			set_theme_mod( 'nav_menu_locations', $current_locations );
		}
	}
}
add_action( 'after_switch_theme', 'smile_v6_set_default_menus' );

/**
 * Sets the content width based on the theme's design.
 */
function smile_v6_content_width() {
	global $content_width;
	$content_width = apply_filters( 'smile_v6_content_width', 640 );
}
add_action( 'after_setup_theme', 'smile_v6_content_width', 0 );
