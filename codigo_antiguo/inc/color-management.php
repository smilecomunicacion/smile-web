<?php
/**
 * Color Management Functions for SMiLE Web Theme.
 *
 * Handles export, import, and reset functionality for theme colors.
 *
 * @package smile-web
 * @since 6.0.7
 */

/**
 * Gets all theme color settings.
 *
 * @return array Array of color settings with their current values.
 * @since 6.0.7
 */
function smile_v6_get_all_color_settings() {
	$color_settings = array(
		// Text Colors.
		'text_base'        => get_theme_mod( 'text_base', '#1A202C' ),
		'text_muted'       => get_theme_mod( 'text_muted', '#64748B' ),
		'text_heading'     => get_theme_mod( 'text_heading', '#1E3A5F' ),
		'text_subheading'  => get_theme_mod( 'text_subheading', '#2E5984' ),
		'text_emphasis'    => get_theme_mod( 'text_emphasis', '#0F7B5C' ),
		'text_quote'       => get_theme_mod( 'text_quote', '#2E5984' ),
		'text_list'        => get_theme_mod( 'text_list', '#1A202C' ),

		// Link Colors.
		'link_default'     => get_theme_mod( 'link_default', '#0F7B5C' ),
		'link_hover'       => get_theme_mod( 'link_hover', '#1E3A5F' ),
		'link_active'      => get_theme_mod( 'link_active', '#0F7B5C' ),
		'link_visited'     => get_theme_mod( 'link_visited', '#2E5984' ),
		'comment_color'    => get_theme_mod( 'comment_color', '#0F7B5C' ),

		// Background Colors.
		'bg_primary'       => get_theme_mod( 'bg_primary', '#F7FAFC' ),
		'bg_secondary'     => get_theme_mod( 'bg_secondary', '#E8F2FF' ),
		'breadcrumb_bg_color' => get_theme_mod( 'breadcrumb_bg_color', '#F7FAFC' ),

		// Button Colors.
		'button_text'      => get_theme_mod( 'button_text', '#FFFFFF' ),
		'button_text_hover' => get_theme_mod( 'button_text_hover', '#0F7B5C' ),
		'button_bg'        => get_theme_mod( 'button_bg', '#0F7B5C' ),
		'button_bg_hover'  => get_theme_mod( 'button_bg_hover', '#E8F2FF' ),
		'button_border'    => get_theme_mod( 'button_border', '#0F7B5C' ),
		'button_border_hover' => get_theme_mod( 'button_border_hover', '#1E3A5F' ),

		// Form Colors.
		'form_bg'          => get_theme_mod( 'form_bg', '#FFFFFF' ),
		'form_border'      => get_theme_mod( 'form_border', '#E2E8F0' ),
		'form_border_focus' => get_theme_mod( 'form_border_focus', '#0F7B5C' ),
		'form_text'        => get_theme_mod( 'form_text', '#1A202C' ),
		'form_placeholder' => get_theme_mod( 'form_placeholder', '#64748B' ),
		'form_label'       => get_theme_mod( 'form_label', '#1E3A5F' ),

		// Alert Colors.
		'color_success'    => get_theme_mod( 'color_success', '#0F7B5C' ),
		'color_warning'    => get_theme_mod( 'color_warning', '#E67E22' ),
		'color_error'      => get_theme_mod( 'color_error', '#E74C3C' ),

		// Extra Colors.
		'card_text_color'  => get_theme_mod( 'card_text_color', '#1A202C' ),
		'cta_bg'           => get_theme_mod( 'cta_bg', '#E67E22' ),
		'accent-primary-light' => get_theme_mod( 'accent-primary-light', '#E8F2FF' ),
		'accent-primary'   => get_theme_mod( 'accent-primary', '#E8F2FF' ),
		'accent-secondary' => get_theme_mod( 'accent-secondary', '#2E5984' ),
		'accent-secondary-dark' => get_theme_mod( 'accent-secondary-dark', '#0B1426' ),
		'border_color'     => get_theme_mod( 'border_color', '#E2E8F0' ),
		'selection_bg'     => get_theme_mod( 'selection_bg', '#1E3A5F' ),

		// Front Page Intro Colors.
		'front_intro_overlay' => get_theme_mod( 'front_intro_overlay', '#0B1426' ),
		'front_intro_overlay_alpha' => get_theme_mod( 'front_intro_overlay_alpha', 0.8 ),
		'front_intro_heading' => get_theme_mod( 'front_intro_heading', '#E8F2FF' ),
		'front_intro_text' => get_theme_mod( 'front_intro_text', '#FFFFFF' ),

		// Page Intro Colors.
		'page_intro_bg'    => get_theme_mod( 'page_intro_bg', '#0B1426' ),
		'page_intro_bg_alpha' => get_theme_mod( 'page_intro_bg_alpha', 1 ),
		'page_intro_heading' => get_theme_mod( 'page_intro_heading', '#E8F2FF' ),

		// Single Post Intro Colors.
		'single_intro_bg'  => get_theme_mod( 'single_intro_bg', '#0B1426' ),
		'single_intro_bg_alpha' => get_theme_mod( 'single_intro_bg_alpha', 1 ),
		'single_intro_heading' => get_theme_mod( 'single_intro_heading', '#E8F2FF' ),

		// Masthead Colors.
		'topbar_bg'        => get_theme_mod( 'topbar_bg', '#F7FAFC' ),
		'topbar_text'      => get_theme_mod( 'topbar_text', '#1A202C' ),
		'topbar_link'      => get_theme_mod( 'topbar_link', '#0F7B5C' ),
		'topbar_link_hover' => get_theme_mod( 'topbar_link_hover', '#1E3A5F' ),
		'topbar_social_icon' => get_theme_mod( 'topbar_social_icon', '#0B1426' ),
		'masthead_bg'      => get_theme_mod( 'masthead_bg', '#0B1426' ),
		'masthead_submenu_bg' => get_theme_mod( 'masthead_submenu_bg', '#0B1426' ),
		'masthead_submenu_text' => get_theme_mod( 'masthead_submenu_text', '#E8F2FF' ),
		'masthead_text'    => get_theme_mod( 'masthead_text', '#E8F2FF' ),
		'masthead_link'    => get_theme_mod( 'masthead_link', '#E8F2FF' ),
		'masthead_link_hover' => get_theme_mod( 'masthead_link_hover', '#1E3A5F' ),
		'masthead_scrolled_bg' => get_theme_mod( 'masthead_scrolled_bg', '#E8F2FF' ),

		// Footer Colors.
		'footer_bg'        => get_theme_mod( 'footer_bg', '#1E3A5F' ),
		'footer_text'      => get_theme_mod( 'footer_text', '#FFFFFF' ),
		'footer_link_color' => get_theme_mod( 'footer_link_color', '#0F7B5C' ),
		'footer_link_hover_color' => get_theme_mod( 'footer_link_hover_color', '#E8F2FF' ),
		'footer_border_color' => get_theme_mod( 'footer_border_color', '#2E5984' ),
		'footer_social_icon' => get_theme_mod( 'footer_social_icon', '#FFFFFF' ),
		'footer_social_icon_hover' => get_theme_mod( 'footer_social_icon_hover', '#0F7B5C' ),
		'footer_top_bg'    => get_theme_mod( 'footer_top_bg', '#1E3A5F' ),
	);

	return $color_settings;
}

/**
 * Gets the Ocean Professional default color palette.
 *
 * @return array Array of default color values.
 * @since 6.0.7
 */
function smile_v6_get_default_color_palette() {
	return array(
		// Text Colors.
		'text_base'        => '#1A202C',
		'text_muted'       => '#64748B',
		'text_heading'     => '#1E3A5F',
		'text_subheading'  => '#2E5984',
		'text_emphasis'    => '#0F7B5C',
		'text_quote'       => '#2E5984',
		'text_list'        => '#1A202C',

		// Link Colors.
		'link_default'     => '#0F7B5C',
		'link_hover'       => '#1E3A5F',
		'link_active'      => '#0F7B5C',
		'link_visited'     => '#2E5984',
		'comment_color'    => '#0F7B5C',

		// Background Colors.
		'bg_primary'       => '#F7FAFC',
		'bg_secondary'     => '#E8F2FF',
		'breadcrumb_bg_color' => '#F7FAFC',

		// Button Colors.
		'button_text'      => '#FFFFFF',
		'button_text_hover' => '#0F7B5C',
		'button_bg'        => '#0F7B5C',
		'button_bg_hover'  => '#E8F2FF',
		'button_border'    => '#0F7B5C',
		'button_border_hover' => '#1E3A5F',

		// Form Colors.
		'form_bg'          => '#FFFFFF',
		'form_border'      => '#E2E8F0',
		'form_border_focus' => '#0F7B5C',
		'form_text'        => '#1A202C',
		'form_placeholder' => '#64748B',
		'form_label'       => '#1E3A5F',

		// Alert Colors.
		'color_success'    => '#0F7B5C',
		'color_warning'    => '#E67E22',
		'color_error'      => '#E74C3C',

		// Extra Colors.
		'card_text_color'  => '#1A202C',
		'cta_bg'           => '#E67E22',
		'accent-primary-light' => '#E8F2FF',
		'accent-primary'   => '#E8F2FF',
		'accent-secondary' => '#2E5984',
		'accent-secondary-dark' => '#0B1426',
		'border_color'     => '#E2E8F0',
		'selection_bg'     => '#1E3A5F',

		// Front Page Intro Colors.
		'front_intro_overlay' => '#0B1426',
		'front_intro_overlay_alpha' => 0.8,
		'front_intro_heading' => '#E8F2FF',
		'front_intro_text' => '#FFFFFF',

		// Page Intro Colors.
		'page_intro_bg'    => '#0B1426',
		'page_intro_bg_alpha' => 1,
		'page_intro_heading' => '#E8F2FF',

		// Single Post Intro Colors.
		'single_intro_bg'  => '#0B1426',
		'single_intro_bg_alpha' => 1,
		'single_intro_heading' => '#E8F2FF',

		// Masthead Colors.
		'topbar_bg'        => '#F7FAFC',
		'topbar_text'      => '#1A202C',
		'topbar_link'      => '#0F7B5C',
		'topbar_link_hover' => '#1E3A5F',
		'topbar_social_icon' => '#0B1426',
		'masthead_bg'      => '#0B1426',
		'masthead_submenu_bg' => '#0B1426',
		'masthead_submenu_text' => '#E8F2FF',
		'masthead_text'    => '#E8F2FF',
		'masthead_link'    => '#E8F2FF',
		'masthead_link_hover' => '#1E3A5F',
		'masthead_scrolled_bg' => '#E8F2FF',

		// Footer Colors.
		'footer_bg'        => '#1E3A5F',
		'footer_text'      => '#FFFFFF',
		'footer_link_color' => '#0F7B5C',
		'footer_link_hover_color' => '#E8F2FF',
		'footer_border_color' => '#2E5984',
		'footer_social_icon' => '#FFFFFF',
		'footer_social_icon_hover' => '#0F7B5C',
		'footer_top_bg'    => '#1E3A5F',
	);
}

/**
 * Handles AJAX request to export color settings.
 *
 * @since 6.0.7
 */
function smile_v6_ajax_export_colors() {
	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['nonce'], 'smile_v6_ajax_nonce' ) ) {
		wp_die( esc_html__( 'Security check failed.', 'smile-web' ) );
	}

	// Check user capability.
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to export theme colors.', 'smile-web' ) );
	}

	$color_settings = smile_v6_get_all_color_settings();

	// Add metadata.
	$export_data = array(
		'smile_web_colors' => array(
			'version'   => '6.0.7',
			'timestamp' => current_time( 'mysql' ),
			'colors'    => $color_settings,
		),
	);

	// Set headers for file download.
	header( 'Content-Type: application/json' );
	header( 'Content-Disposition: attachment; filename="smile-web-colors-' . date( 'Y-m-d-H-i-s' ) . '.json"' );
	header( 'Cache-Control: no-cache, must-revalidate' );
	header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );

	echo wp_json_encode( $export_data, JSON_PRETTY_PRINT );
	wp_die();
}
add_action( 'wp_ajax_smile_v6_export_colors', 'smile_v6_ajax_export_colors' );

/**
 * Handles AJAX request to import color settings.
 *
 * @since 6.0.7
 */
function smile_v6_ajax_import_colors() {
	// Check if nonce exists in POST data.
	if ( ! isset( $_POST['nonce'] ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Security token missing.', 'smile-web' ) ) );
		wp_die();
	}

	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['nonce'], 'smile_v6_ajax_nonce' ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Security check failed.', 'smile-web' ) ) );
		wp_die();
	}

	// Check user capability.
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'You do not have permission to import theme colors.', 'smile-web' ) ) );
		wp_die();
	}

	// Validate file upload.
	if ( ! isset( $_FILES['colors_file'] ) || $_FILES['colors_file']['error'] !== UPLOAD_ERR_OK ) {
		wp_send_json_error( array( 'message' => esc_html__( 'File upload failed.', 'smile-web' ) ) );
		wp_die();
	}

	// Read and validate JSON file.
	$file_content = file_get_contents( $_FILES['colors_file']['tmp_name'] );
	$import_data = json_decode( $file_content, true );

	if ( json_last_error() !== JSON_ERROR_NONE ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Invalid JSON file.', 'smile-web' ) ) );
		wp_die();
	}

	// Validate file structure.
	if ( ! isset( $import_data['smile_web_colors']['colors'] ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Invalid color settings file format.', 'smile-web' ) ) );
		wp_die();
	}

	$colors = $import_data['smile_web_colors']['colors'];
	$valid_colors = smile_v6_get_all_color_settings();
	$imported_count = 0;

	// Import valid color settings.
	foreach ( $colors as $color_key => $color_value ) {
		if ( array_key_exists( $color_key, $valid_colors ) ) {
			// Sanitize color values.
			if ( strpos( $color_key, '_alpha' ) !== false ) {
				$sanitized_value = floatval( $color_value );
				$sanitized_value = min( 1, max( 0, $sanitized_value ) );
			} else {
				$sanitized_value = sanitize_hex_color( $color_value );
				if ( ! $sanitized_value ) {
					continue; // Skip invalid colors.
				}
			}

			set_theme_mod( $color_key, $sanitized_value );
			$imported_count++;
		}
	}

	if ( $imported_count > 0 ) {
		wp_send_json_success( array(
			'message' => sprintf(
				/* translators: %d: Number of imported colors */
				esc_html__( 'Successfully imported %d color settings.', 'smile-web' ),
				$imported_count
			),
		) );
	} else {
		wp_send_json_error( array( 'message' => esc_html__( 'No valid color settings found in the file.', 'smile-web' ) ) );
	}

	wp_die();
}
add_action( 'wp_ajax_smile_v6_import_colors', 'smile_v6_ajax_import_colors' );

/**
 * Handles AJAX request to reset colors to default Ocean Professional palette.
 *
 * @since 6.0.7
 */
function smile_v6_ajax_reset_colors() {
	// Verify nonce.
	if ( ! wp_verify_nonce( $_POST['nonce'], 'smile_v6_ajax_nonce' ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'Security check failed.', 'smile-web' ) ) );
		wp_die();
	}

	// Check user capability.
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( array( 'message' => esc_html__( 'You do not have permission to reset theme colors.', 'smile-web' ) ) );
		wp_die();
	}

	$default_colors = smile_v6_get_default_color_palette();
	$reset_count = 0;

	// Reset all color settings to defaults.
	foreach ( $default_colors as $color_key => $color_value ) {
		set_theme_mod( $color_key, $color_value );
		$reset_count++;
	}

	if ( $reset_count > 0 ) {
		wp_send_json_success( array(
			'message' => sprintf(
				/* translators: %d: Number of reset colors */
				esc_html__( 'Successfully reset %d color settings to Ocean Professional defaults.', 'smile-web' ),
				$reset_count
			),
		) );
	} else {
		wp_send_json_error( array( 'message' => esc_html__( 'Failed to reset color settings.', 'smile-web' ) ) );
	}

	wp_die();
}
add_action( 'wp_ajax_smile_v6_reset_colors', 'smile_v6_ajax_reset_colors' );