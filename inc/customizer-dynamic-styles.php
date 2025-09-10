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
        $link_default                = sanitize_hex_color( get_theme_mod( 'link_default', '#307C03' ) );
        $link_hover                  = sanitize_hex_color( get_theme_mod( 'link_hover', '#306a93' ) );
        $link_active                 = sanitize_hex_color( get_theme_mod( 'link_active', '#4a994f' ) );
        $link_visited                = sanitize_hex_color( get_theme_mod( 'link_visited', '#4a994f' ) );
        $comment_color                = sanitize_hex_color( get_theme_mod( 'comment_color', '#307C03' ) );
        $card_text_color              = sanitize_hex_color( get_theme_mod( 'card_text_color', '#00112b' ) );
        $color_warning                = sanitize_hex_color( get_theme_mod( 'color_warning', '#ffc107' ) );
        $cta_bg                       = sanitize_hex_color( get_theme_mod( 'cta_bg', '#ffc107' ) );
        $breadcrumb_separator         = sanitize_text_field( get_theme_mod( 'breadcrumb_separator', '/' ) );
        $text_base                    = sanitize_hex_color( get_theme_mod( 'text_base', '#00112b' ) );
        $text_muted                   = sanitize_hex_color( get_theme_mod( 'text_muted', '#6c757d' ) );
        $text_heading                 = sanitize_hex_color( get_theme_mod( 'text_heading', '#306a93' ) );
        $text_subheading              = sanitize_hex_color( get_theme_mod( 'text_subheading', '#225274' ) );
        $text_emphasis                = sanitize_hex_color( get_theme_mod( 'text_emphasis', '#307C03' ) );
        $text_quote                   = sanitize_hex_color( get_theme_mod( 'text_quote', '#225274' ) );
        $text_list                    = sanitize_hex_color( get_theme_mod( 'text_list', '#00112b' ) );
		$accent_primary_light     = sanitize_hex_color( get_theme_mod( 'accent-primary-light', '#d2e1ef' ) );
		$accent_primary           = sanitize_hex_color( get_theme_mod( 'accent-primary', '#d2e1ef' ) );
		$accent_secondary         = sanitize_hex_color( get_theme_mod( 'accent-secondary', '#225274' ) );
		$accent_secondary_dark    = sanitize_hex_color( get_theme_mod( 'accent-secondary-dark', '#001833' ) );
                $bg_primary               = sanitize_hex_color( get_theme_mod( 'bg_primary', '#edf7ef' ) );
                $bg_secondary             = sanitize_hex_color( get_theme_mod( 'bg_secondary', '#f8f9fa' ) );
                $bg_button                = sanitize_hex_color( get_theme_mod( 'bg_button', '#307C03' ) );
                $bg_input                 = sanitize_hex_color( get_theme_mod( 'bg_input', '#FFFFFF' ) );
		$topbar_bg                = sanitize_hex_color( get_theme_mod( 'topbar_bg', '#f8f9fa' ) );
		$topbar_text              = sanitize_hex_color( get_theme_mod( 'topbar_text', '#00112b' ) );
		$topbar_link              = sanitize_hex_color( get_theme_mod( 'topbar_link', '#307C03' ) );
		$topbar_link_hover        = sanitize_hex_color( get_theme_mod( 'topbar_link_hover', '#306a93' ) );
		$topbar_social_icon       = sanitize_hex_color( get_theme_mod( 'topbar_social_icon', '#001833' ) );
		$masthead_bg              = sanitize_hex_color( get_theme_mod( 'masthead_bg', '#001833' ) );
		$masthead_submenu_bg      = sanitize_hex_color( get_theme_mod( 'masthead_submenu_bg', '#001833' ) );
		$masthead_submenu_text    = sanitize_hex_color( get_theme_mod( 'masthead_submenu_text', '#d2e1ef' ) );
		$masthead_text            = sanitize_hex_color( get_theme_mod( 'masthead_text', '#d2e1ef' ) );
		$masthead_link            = sanitize_hex_color( get_theme_mod( 'masthead_link', '#d2e1ef' ) );
		$masthead_link_hover      = sanitize_hex_color( get_theme_mod( 'masthead_link_hover', '#306a93' ) );
		$masthead_scrolled_bg     = sanitize_hex_color( get_theme_mod( 'masthead_scrolled_bg', '#d2e1ef' ) );
		$footer_bg                = sanitize_hex_color( get_theme_mod( 'footer_bg', '#274c77' ) );
		$footer_text              = sanitize_hex_color( get_theme_mod( 'footer_text', '#FFFEFA' ) );
		$footer_link              = sanitize_hex_color( get_theme_mod( 'footer_link_color', '#307C03' ) );
	$footer_link_hover            = sanitize_hex_color( get_theme_mod( 'footer_link_hover_color', '#306a93' ) );
	$footer_border                = sanitize_hex_color( get_theme_mod( 'footer_border_color', '#f6fbf7' ) );
		$footer_social_bg         = sanitize_hex_color( get_theme_mod( 'footer_social_bg', '#4a994f' ) );
		$footer_social_icon       = sanitize_hex_color( get_theme_mod( 'footer_social_icon', '#FFFFFF' ) );
		$footer_social_icon_hover = sanitize_hex_color( get_theme_mod( 'footer_social_icon_hover', '#4a994f' ) );
$color_white                  = sanitize_hex_color( '#FFFFFF' );
$border_color                 = sanitize_hex_color( get_theme_mod( 'border_color', '#dee2e6' ) );
$modal_border                 = sanitize_hex_color( '#888888' );

        $dynamic_css = '
                :root {
                        --link: ' . esc_attr( $link_default ) . ';
                        --link-hover: ' . esc_attr( $link_hover ) . ';
                        --link-active: ' . esc_attr( $link_active ) . ';
                        --link-visited: ' . esc_attr( $link_visited ) . ';
                        --comment-color: ' . esc_attr( $comment_color ) . ';
                        --card-text-color: ' . esc_attr( $card_text_color ) . ';
                        --color-warning: ' . esc_attr( $color_warning ) . ';
                        --cta-bg: ' . esc_attr( $cta_bg ) . ';
                        --breadcrumb-separator: "' . esc_attr( $breadcrumb_separator ) . '";
                        --text-base: ' . esc_attr( $text_base ) . ';
                        --text-muted: ' . esc_attr( $text_muted ) . ';
                        --text-heading: ' . esc_attr( $text_heading ) . ';
                        --text-subheading: ' . esc_attr( $text_subheading ) . ';
                        --text-emphasis: ' . esc_attr( $text_emphasis ) . ';
                        --text-quote: ' . esc_attr( $text_quote ) . ';
                        --text-list: ' . esc_attr( $text_list ) . ';
                       --accent-primary-light: ' . esc_attr( $accent_primary_light ) . ';
                       --accent-primary: ' . esc_attr( $accent_primary ) . ';
                       --accent-secondary: ' . esc_attr( $accent_secondary ) . ';
                       --accent-secondary-dark: ' . esc_attr( $accent_secondary_dark ) . ';
                        --color-white: ' . esc_attr( $color_white ) . ';
                       --bg-primary: ' . esc_attr( $bg_primary ) . ';
                       --bg-secondary: ' . esc_attr( $bg_secondary ) . ';
                       --bg-button: ' . esc_attr( $bg_button ) . ';
                       --bg-input: ' . esc_attr( $bg_input ) . ';
                       --topbar-bg: ' . esc_attr( $topbar_bg ) . ';
                       --topbar-text: ' . esc_attr( $topbar_text ) . ';
                       --topbar-link: ' . esc_attr( $topbar_link ) . ';
                       --topbar-link-hover: ' . esc_attr( $topbar_link_hover ) . ';
                       --topbar-social-icon: ' . esc_attr( $topbar_social_icon ) . ';
                       --masthead-bg: ' . esc_attr( $masthead_bg ) . ';
                       --masthead-submenu-bg: ' . esc_attr( $masthead_submenu_bg ) . ';
                       --masthead-submenu-text: ' . esc_attr( $masthead_submenu_text ) . ';
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
                       --footer-social-icon-hover: ' . esc_attr( $footer_social_icon_hover ) . ';
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
