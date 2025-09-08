<?php
/**
 * Block Patterns Registration for SMiLE Web Theme.
 *
 * @package smile-web
 */

/**
 * Registers block patterns from the /patterns/ folder.
 */
function smile_v6_register_block_patterns() {
	if ( is_admin() ) {
		$pattern_files = glob( get_template_directory() . '/patterns/*.php' );
		if ( false !== $pattern_files ) {
			foreach ( $pattern_files as $file ) {
				require_once $file;
			}
		}
	}
}
add_action( 'init', 'smile_v6_register_block_patterns' );
