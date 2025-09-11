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
		$comment_color               = sanitize_hex_color( get_theme_mod( 'comment_color', '#307C03' ) );
		$card_text_color             = sanitize_hex_color( get_theme_mod( 'card_text_color', '#00112b' ) );
		$color_warning               = sanitize_hex_color( get_theme_mod( 'color_warning', '#ffc107' ) );
		$cta_bg                      = sanitize_hex_color( get_theme_mod( 'cta_bg', '#ffc107' ) );
		$breadcrumb_separator        = sanitize_text_field( get_theme_mod( 'breadcrumb_separator', '/' ) );
		$text_base                   = sanitize_hex_color( get_theme_mod( 'text_base', '#00112b' ) );
		$text_muted                  = sanitize_hex_color( get_theme_mod( 'text_muted', '#6c757d' ) );
		$text_heading                = sanitize_hex_color( get_theme_mod( 'text_heading', '#306a93' ) );
		$text_subheading             = sanitize_hex_color( get_theme_mod( 'text_subheading', '#225274' ) );
		$text_emphasis               = sanitize_hex_color( get_theme_mod( 'text_emphasis', '#307C03' ) );
		$text_quote                  = sanitize_hex_color( get_theme_mod( 'text_quote', '#225274' ) );
		$text_list                   = sanitize_hex_color( get_theme_mod( 'text_list', '#00112b' ) );
		$accent_primary_light        = sanitize_hex_color( get_theme_mod( 'accent-primary-light', '#d2e1ef' ) );
                $accent_primary              = sanitize_hex_color( get_theme_mod( 'accent-primary', '#d2e1ef' ) );
                $accent_secondary            = sanitize_hex_color( get_theme_mod( 'accent-secondary', '#225274' ) );
                $accent_secondary_dark       = sanitize_hex_color( get_theme_mod( 'accent-secondary-dark', '#001833' ) );
               $front_intro_overlay         = sanitize_hex_color( get_theme_mod( 'front_intro_overlay', '#001833' ) );
               $front_intro_heading         = sanitize_hex_color( get_theme_mod( 'front_intro_heading', '#d2e1ef' ) );
               $front_intro_text            = sanitize_hex_color( get_theme_mod( 'front_intro_text', '#FFFFFF' ) );
                                $bg_primary          = sanitize_hex_color( get_theme_mod( 'bg_primary', '#edf7ef' ) );
                               $bg_secondary        = sanitize_hex_color( get_theme_mod( 'bg_secondary', '#f8f9fa' ) );
                               $breadcrumb_bg       = sanitize_hex_color( get_theme_mod( 'breadcrumb_bg_color', '#edf7ef' ) );
                               $button_text         = sanitize_hex_color( get_theme_mod( 'button_text', '#FFFFFF' ) );
				$button_text_hover   = sanitize_hex_color( get_theme_mod( 'button_text_hover', '#307C03' ) );
				$button_bg           = sanitize_hex_color( get_theme_mod( 'button_bg', '#307C03' ) );
				$button_bg_hover     = sanitize_hex_color( get_theme_mod( 'button_bg_hover', '#FFFFFF' ) );
				$button_border       = sanitize_hex_color( get_theme_mod( 'button_border', '#307C03' ) );
				$button_border_hover = sanitize_hex_color( get_theme_mod( 'button_border_hover', '#307C03' ) );
				$form_text           = sanitize_hex_color( get_theme_mod( 'form_text', '#00112b' ) );
				$form_placeholder    = sanitize_hex_color( get_theme_mod( 'form_placeholder', '#6c757d' ) );
				$form_border         = sanitize_hex_color( get_theme_mod( 'form_border', '#ced4da' ) );
				$form_border_focus   = sanitize_hex_color( get_theme_mod( 'form_border_focus', '#307C03' ) );
				$form_bg             = sanitize_hex_color( get_theme_mod( 'form_bg', '#FFFFFF' ) );
				$form_error          = sanitize_hex_color( get_theme_mod( 'form_error', '#dc3545' ) );
				$form_success        = sanitize_hex_color( get_theme_mod( 'form_success', '#198754' ) );
				$alert_success       = sanitize_hex_color( get_theme_mod( 'alert_success', '#198754' ) );
				$alert_error         = sanitize_hex_color( get_theme_mod( 'alert_error', '#dc3545' ) );
				$alert_warning       = sanitize_hex_color( get_theme_mod( 'alert_warning', '#ffc107' ) );
				$alert_info          = sanitize_hex_color( get_theme_mod( 'alert_info', '#0dcaf0' ) );
				$topbar_bg           = sanitize_hex_color( get_theme_mod( 'topbar_bg', '#f8f9fa' ) );
		$topbar_text                 = sanitize_hex_color( get_theme_mod( 'topbar_text', '#00112b' ) );
		$topbar_link                 = sanitize_hex_color( get_theme_mod( 'topbar_link', '#307C03' ) );
		$topbar_link_hover           = sanitize_hex_color( get_theme_mod( 'topbar_link_hover', '#306a93' ) );
		$topbar_social_icon          = sanitize_hex_color( get_theme_mod( 'topbar_social_icon', '#001833' ) );
		$masthead_bg                 = sanitize_hex_color( get_theme_mod( 'masthead_bg', '#001833' ) );
		$masthead_submenu_bg         = sanitize_hex_color( get_theme_mod( 'masthead_submenu_bg', '#001833' ) );
		$masthead_submenu_text       = sanitize_hex_color( get_theme_mod( 'masthead_submenu_text', '#d2e1ef' ) );
		$masthead_text               = sanitize_hex_color( get_theme_mod( 'masthead_text', '#d2e1ef' ) );
		$masthead_link               = sanitize_hex_color( get_theme_mod( 'masthead_link', '#d2e1ef' ) );
		$masthead_link_hover         = sanitize_hex_color( get_theme_mod( 'masthead_link_hover', '#306a93' ) );
		$masthead_scrolled_bg        = sanitize_hex_color( get_theme_mod( 'masthead_scrolled_bg', '#d2e1ef' ) );
		$footer_bg                   = sanitize_hex_color( get_theme_mod( 'footer_bg', '#274c77' ) );
		$footer_text                 = sanitize_hex_color( get_theme_mod( 'footer_text', '#FFFEFA' ) );
		$footer_link                 = sanitize_hex_color( get_theme_mod( 'footer_link_color', '#307C03' ) );
	$footer_link_hover               = sanitize_hex_color( get_theme_mod( 'footer_link_hover_color', '#306a93' ) );
	$footer_border                   = sanitize_hex_color( get_theme_mod( 'footer_border_color', '#f6fbf7' ) );
		$footer_social_bg            = sanitize_hex_color( get_theme_mod( 'footer_social_bg', '#4a994f' ) );
		$footer_social_icon          = sanitize_hex_color( get_theme_mod( 'footer_social_icon', '#FFFFFF' ) );
		$footer_social_icon_hover    = sanitize_hex_color( get_theme_mod( 'footer_social_icon_hover', '#4a994f' ) );
	$color_white                     = sanitize_hex_color( '#FFFFFF' );
	$border_color                    = sanitize_hex_color( get_theme_mod( 'border_color', '#dee2e6' ) );
	$selection_bg                    = sanitize_hex_color( get_theme_mod( 'selection_bg', '#306a93' ) );
	$icon_color                      = sanitize_hex_color( get_theme_mod( 'icon_color', '#001833' ) );
	$toc_link                        = sanitize_hex_color( get_theme_mod( 'toc_link', '#307C03' ) );
	$modal_border                    = sanitize_hex_color( '#888888' );

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
                      --breadcrumb-bg: ' . esc_attr( $breadcrumb_bg ) . ';
                      --front-intro-overlay: ' . esc_attr( $front_intro_overlay ) . ';
                      --front-intro-heading: ' . esc_attr( $front_intro_heading ) . ';
                      --front-intro-text: ' . esc_attr( $front_intro_text ) . ';
                      --btn-text: ' . esc_attr( $button_text ) . ';
                       --btn-text-hover: ' . esc_attr( $button_text_hover ) . ';
                       --btn-bg: ' . esc_attr( $button_bg ) . ';
                       --btn-bg-hover: ' . esc_attr( $button_bg_hover ) . ';
                       --btn-border: ' . esc_attr( $button_border ) . ';
                       --btn-border-hover: ' . esc_attr( $button_border_hover ) . ';
                       --form-text: ' . esc_attr( $form_text ) . ';
                       --form-placeholder: ' . esc_attr( $form_placeholder ) . ';
                       --form-border: ' . esc_attr( $form_border ) . ';
                       --form-border-focus: ' . esc_attr( $form_border_focus ) . ';
                       --form-bg: ' . esc_attr( $form_bg ) . ';
                       --form-error: ' . esc_attr( $form_error ) . ';
                       --form-success: ' . esc_attr( $form_success ) . ';
                       --alert-success: ' . esc_attr( $alert_success ) . ';
                       --alert-error: ' . esc_attr( $alert_error ) . ';
                       --alert-warning: ' . esc_attr( $alert_warning ) . ';
                       --alert-info: ' . esc_attr( $alert_info ) . ';
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
                        --border: ' . esc_attr( $border_color ) . ';
                        --selection-bg: ' . esc_attr( $selection_bg ) . ';
                        --icon: ' . esc_attr( $icon_color ) . ';
                        --toc-link: ' . esc_attr( $toc_link ) . ';
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
