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
	$color_text       = get_theme_mod( 'color_text', '#00112b' );
	$color_link       = get_theme_mod( 'color_link', '#307C03' );
	$color_link_hover = get_theme_mod( 'color_link_hover', '#306a93' );
	$color_link_light = get_theme_mod( 'color_link_light', '#4a994f' );
	$color_1_light    = get_theme_mod( 'color_1_light', '#d2e1ef' );
	$color_1          = get_theme_mod( 'color_1', '#d2e1ef' );
	$color_2          = get_theme_mod( 'color_2', '#225274' );
	$color_2_dark     = get_theme_mod( 'color_2_dark', '#001833' );
	$bg_light         = get_theme_mod( 'bg_light', '#f6fbf7' );
	$bg_light2        = get_theme_mod( 'bg_light2', '#f8f9fa' );
        $footer_bg        = get_theme_mod( 'footer_bg', '#274c77' );
        $footer_text      = get_theme_mod( 'footer_text', '#FFFEFA' );
       $footer_link       = get_theme_mod( 'footer_link_color', '#307C03' );
       $footer_link_hover = get_theme_mod( 'footer_link_hover_color', '#306a93' );
       $footer_border     = get_theme_mod( 'footer_border_color', '#f6fbf7' );
        $color_white      = '#FFFFFF';

	$dynamic_css = "
		:root {
			--color-text: {$color_text};
			--color-link: {$color_link};
			--color-link-hover: {$color_link_hover};
			--color-link-light: {$color_link_light};
			--color-1-light: {$color_1_light};
			--color-1: {$color_1};
			--color-2: {$color_2};
			--color-2-dark: {$color_2_dark};
			--color-white: {$color_white};
			--bg-light: {$bg_light};
			--bg-light2: {$bg_light2};
                        --footer-bg: {$footer_bg};
                        --footer-text: {$footer_text};
                       --footer-link: {$footer_link};
                       --footer-link-hover: {$footer_link_hover};
                       --footer-border: {$footer_border};
               }
       ";

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
                echo '<style type="text/css">' . wp_strip_all_tags( $custom_css ) . '</style>';
        }
}
add_action( 'wp_head', 'smile_v6_custom_css_output' );
