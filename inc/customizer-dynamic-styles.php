<?php
/**
 * Customizer Dynamic Styles for SMiLE Web Theme.
 *
 * @package smile-web
 */

/**
 * Outputs inline dynamic CSS based on customizer settings.
 */
function smile_web_add_dynamic_styles() {
	$color_text         = sanitize_hex_color( get_theme_mod( 'color_text', '#00112b' ) );
	$color_link         = sanitize_hex_color( get_theme_mod( 'color_link', '#307C03' ) );
	$color_link_hover   = sanitize_hex_color( get_theme_mod( 'color_link_hover', '#306a93' ) );
	$color_link_light   = sanitize_hex_color( get_theme_mod( 'color_link_light', '#4a994f' ) );
	$color_1_light      = sanitize_hex_color( get_theme_mod( 'color_1_light', '#d2e1ef' ) );
	$color_1            = sanitize_hex_color( get_theme_mod( 'color_1', '#d2e1ef' ) );
        $color_2            = sanitize_hex_color( get_theme_mod( 'color_2', '#225274' ) );
        $color_2_dark       = sanitize_hex_color( get_theme_mod( 'color_2_dark', '#001833' ) );
        $bg_light           = sanitize_hex_color( get_theme_mod( 'bg_light', '#f6fbf7' ) );
       $bg_light2          = sanitize_hex_color( get_theme_mod( 'bg_light2', '#f8f9fa' ) );
       $topbar_bg         = sanitize_hex_color( get_theme_mod( 'topbar_bg', '#f8f9fa' ) );
       $topbar_text       = sanitize_hex_color( get_theme_mod( 'topbar_text', '#00112b' ) );
       $topbar_link       = sanitize_hex_color( get_theme_mod( 'topbar_link', '#307C03' ) );
       $topbar_link_hover = sanitize_hex_color( get_theme_mod( 'topbar_link_hover', '#306a93' ) );
       $topbar_social_icon = sanitize_hex_color( get_theme_mod( 'topbar_social_icon', '#001833' ) );
       $masthead_bg        = sanitize_hex_color( get_theme_mod( 'masthead_bg', '#001833' ) );
       $masthead_text      = sanitize_hex_color( get_theme_mod( 'masthead_text', '#d2e1ef' ) );
       $masthead_link      = sanitize_hex_color( get_theme_mod( 'masthead_link', '#d2e1ef' ) );
       $masthead_link_hover = sanitize_hex_color( get_theme_mod( 'masthead_link_hover', '#306a93' ) );
       $masthead_scrolled_bg = sanitize_hex_color( get_theme_mod( 'masthead_scrolled_bg', '#d2e1ef' ) );
       $footer_bg          = sanitize_hex_color( get_theme_mod( 'footer_bg', '#274c77' ) );
       $footer_text        = sanitize_hex_color( get_theme_mod( 'footer_text', '#FFFEFA' ) );
       $footer_link        = sanitize_hex_color( get_theme_mod( 'footer_link_color', '#307C03' ) );
	$footer_link_hover  = sanitize_hex_color( get_theme_mod( 'footer_link_hover_color', '#306a93' ) );
	$footer_border      = sanitize_hex_color( get_theme_mod( 'footer_border_color', '#f6fbf7' ) );
	$footer_social_bg   = sanitize_hex_color( get_theme_mod( 'footer_social_bg', '#4a994f' ) );
	$footer_social_icon = sanitize_hex_color( get_theme_mod( 'footer_social_icon', '#FFFFFF' ) );
	$color_white        = sanitize_hex_color( '#FFFFFF' );
	$border_color       = sanitize_hex_color( '#dee2e6' );
	$modal_border       = sanitize_hex_color( '#888888' );

	$dynamic_css = '
		:root {
			--color-text: ' . esc_attr( $color_text ) . ';
			--color-link: ' . esc_attr( $color_link ) . ';
			--color-link-hover: ' . esc_attr( $color_link_hover ) . ';
			--color-link-light: ' . esc_attr( $color_link_light ) . ';
			--color-1-light: ' . esc_attr( $color_1_light ) . ';
			--color-1: ' . esc_attr( $color_1 ) . ';
			--color-2: ' . esc_attr( $color_2 ) . ';
                        --color-2-dark: ' . esc_attr( $color_2_dark ) . ';
                        --color-white: ' . esc_attr( $color_white ) . ';
                        --bg-light: ' . esc_attr( $bg_light ) . ';
                       --bg-light2: ' . esc_attr( $bg_light2 ) . ';
                       --topbar-bg: ' . esc_attr( $topbar_bg ) . ';
                       --topbar-text: ' . esc_attr( $topbar_text ) . ';
                       --topbar-link: ' . esc_attr( $topbar_link ) . ';
                       --topbar-link-hover: ' . esc_attr( $topbar_link_hover ) . ';
                       --topbar-social-icon: ' . esc_attr( $topbar_social_icon ) . ';
                       --masthead-bg: ' . esc_attr( $masthead_bg ) . ';
                       --masthead-text: ' . esc_attr( $masthead_text ) . ';
                       --masthead-link: ' . esc_attr( $masthead_link ) . ';
                       --masthead-link-hover: ' . esc_attr( $masthead_link_hover ) . ';
                       --masthead-scrolled-bg: ' . esc_attr( $masthead_scrolled_bg ) . ';
                       --footer-bg: ' . esc_attr( $footer_bg ) . ';
                       --footer-text: ' . esc_attr( $footer_text ) . ';
                       --footer-link: ' . esc_attr( $footer_link ) . ';
                       --footer-link-hover: ' . esc_attr( $footer_link_hover ) . ';
			--footer-border: ' . esc_attr( $footer_border ) . ';
			--footer-social-bg: ' . esc_attr( $footer_social_bg ) . ';
			--footer-social-icon: ' . esc_attr( $footer_social_icon ) . ';
			--border-color: ' . esc_attr( $border_color ) . ';
			--modal-border: ' . esc_attr( $modal_border ) . ';
		}
	';

	// Se agrega el CSS en línea al handle 'smile-web-main'.
	wp_add_inline_style( 'smile-web-main', $dynamic_css );
}
add_action( 'wp_enqueue_scripts', 'smile_web_add_dynamic_styles' );

/**
 * Outputs custom CSS stored via the Customizer.
 */
function smile_v6_custom_css_output() {
	$custom_css = wp_get_custom_css();
	if ( ! empty( $custom_css ) ) {
		echo '<style type="text/css">' . esc_html( wp_strip_all_tags( $custom_css ) ) . '</style>';
	}
}
add_action( 'wp_head', 'smile_v6_custom_css_output' );
