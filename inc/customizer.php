<?php
/**
 * Smile-web Theme Customizer
 *
 * @package smile-web
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function smile_v6_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'refresh';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'refresh';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'smile_v6_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'smile_v6_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'smile_v6_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function smile_v6_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function smile_v6_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Placeholder for future Theme Customizer preview scripts.
 */
function smile_v6_customize_preview_js() {
}
add_action( 'customize_preview_init', 'smile_v6_customize_preview_js' );
