<?php
/**
 * Editor meta and assets bootstrap.
 *
 * @package smile-web
 */

/**
 * Registers the intro image meta for supported post types.
 *
 * @since 6.0.8
 *
 * @return void
 * @package smile-web
 */
function smile_v6_register_intro_image_meta() {
        $args = array(
                'type'              => 'integer',
                'single'            => true,
                'show_in_rest'      => true,
                'sanitize_callback' => 'absint',
                'default'           => 0,
                'auth_callback'     => function() {
                        return current_user_can( 'edit_posts' );
                },
        );

	foreach ( array( 'post', 'page' ) as $post_type ) {
		register_post_meta( $post_type, 'smile_v6_intro_image_id', $args );
	}
}
add_action( 'init', 'smile_v6_register_intro_image_meta' );

/**
 * Enqueues the block editor assets required for the intro image panel.
 *
 * @since 6.0.8
 *
 * @return void
 * @package smile-web
 */
function smile_v6_enqueue_intro_image_editor_assets() {
        $screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

        if ( $screen && ! in_array( $screen->post_type, array( 'post', 'page' ), true ) ) {
                return;
        }

        $script_handle = 'smile-v6-editor-intro-image';
        $script_path   = '/assets/js/editor-intro-image.js';

        wp_enqueue_script(
                $script_handle,
                get_template_directory_uri() . $script_path,
                array(
                        'wp-plugins',
                        'wp-editor',
                        'wp-edit-post',
                        'wp-components',
                        'wp-element',
                        'wp-data',
                        'wp-i18n',
                        'wp-api-fetch',
                        'wp-block-editor',
                ),
                filemtime( get_template_directory() . $script_path ),
                true
        );

        wp_localize_script(
                $script_handle,
                'smileV6IntroImagePanel',
                array(
                        'metaKey' => 'smile_v6_intro_image_id',
                        'strings' => array(
                                'panelTitle'         => esc_html__( 'Intro image', 'smile-web' ),
                                'panelDescription'   => esc_html__( 'Select an image to replace the intro highlight. It behaves like the custom header artwork.', 'smile-web' ),
                                'selectImageButton'  => esc_html__( 'Choose intro image', 'smile-web' ),
                                'replaceImageButton' => esc_html__( 'Replace intro image', 'smile-web' ),
                                'clearImageButton'   => esc_html__( 'Remove intro image', 'smile-web' ),
                                'placeholderText'    => esc_html__( 'No intro image selected yet.', 'smile-web' ),
                                'previewLabel'       => esc_html__( 'Intro image preview', 'smile-web' ),
                        ),
                )
        );

        $panel_css = '.smile-v6-intro-image-panel__description{margin-top:0;}' .
                '.smile-v6-intro-image-panel__select{margin-top:0.5rem;}' .
                '.smile-v6-intro-image-panel__clear{margin-top:0.5rem;}' .
                '.smile-v6-intro-image-panel__preview{margin-top:1rem;padding:0.75rem;border:1px dashed #dcdcde;border-radius:4px;background-color:#ffffff;text-align:center;}' .
                '.smile-v6-intro-image-panel__figure{margin:0;}' .
                '.smile-v6-intro-image-panel__figure img{display:block;max-width:100%;height:auto;margin:0 auto;}' .
                '.smile-v6-intro-image-panel__placeholder{margin:0;color:#757575;}';

        wp_add_inline_style( 'wp-edit-post', $panel_css );
}
add_action( 'enqueue_block_editor_assets', 'smile_v6_enqueue_intro_image_editor_assets' );
