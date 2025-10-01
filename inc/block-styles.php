<?php
/**
 * Block Styles Registration for SMiLE Web Theme.
 *
 * @package smile-web
 */

if ( ! function_exists( 'smile_v6_register_block_styles' ) ) {
		/**
		 * Registers additional block styles that expose theme utility classes.
		 *
		 * @return void
		 */
	function smile_v6_register_block_styles() {
		if ( ! function_exists( 'register_block_style' ) ) {
				return;
		}

			register_block_style(
				'core/image',
				array(
					'name'         => 'smile-shadow',
					'label'        => __( 'Sombra suave', 'smile-web' ),
					'style_handle' => 'smile-web-style',
				)
			);

			register_block_style(
				'core/quote',
				array(
					'name'         => 'smile-accent-border',
					'label'        => __( 'Borde destacado', 'smile-web' ),
					'style_handle' => 'smile-web-style',
				)
			);
	}
}
add_action( 'init', 'smile_v6_register_block_styles' );
