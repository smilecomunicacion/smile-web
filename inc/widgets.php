<?php
/**
 * Registers widget areas for SMiLE Web Theme.
 *
 * @package smile-web
 */

/**
 * Registers the theme's widget areas.
 */
function smile_v6_widgets_init() {
	$widgets = array(
		array(
			'name'          => esc_html__( 'Sidebar', 'smile-web' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'smile-web' ),
			'before_widget' => '<div id="%1$s" class="bg-white mb-4 shadow widget p-3 mb-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<p class="lead widget-title">',
			'after_title'   => '</p>',
		),
		array(
			'name'         => esc_html__( 'Footer-Zone 1', 'smile-web' ),
			'id'           => 'footer-1',
			'description'  => esc_html__( 'Add widgets here-Footer-Zone 1.', 'smile-web' ),
			'before_title' => '<p class="lead widget-title">',
			'after_title'  => '</p>',
		),
		array(
			'name'         => esc_html__( 'Footer-Zone 2', 'smile-web' ),
			'id'           => 'footer-2',
			'description'  => esc_html__( 'Add widgets here-Footer-Zone 2.', 'smile-web' ),
			'before_title' => '<p class="lead widget-title">',
			'after_title'  => '</p>',
		),
		array(
			'name'         => esc_html__( 'Footer-Zone 3', 'smile-web' ),
			'id'           => 'footer-3',
			'description'  => esc_html__( 'Add widgets here-Footer-Zone 3.', 'smile-web' ),
			'before_title' => '<p class="lead widget-title">',
			'after_title'  => '</p>',
		),
		array(
			'name'         => esc_html__( 'Footer-Zone 4', 'smile-web' ),
			'id'           => 'footer-4',
			'description'  => esc_html__( 'Add widgets here-Footer-Zone 4.', 'smile-web' ),
			'before_title' => '<p class="lead widget-title">',
			'after_title'  => '</p>',
		),
	);

	foreach ( $widgets as $widget ) {
		register_sidebar( $widget );
	}
}
add_action( 'widgets_init', 'smile_v6_widgets_init' );
