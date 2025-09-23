<?php
/**
 * Customizer Dynamic Styles for SMiLE Web Theme.
 *
 * @package smile-web
 */

/**
 * Generates the dynamic CSS variables based on Customizer settings.
 *
 * @return string
 */
function smile_web_get_dynamic_root_styles() {
		$link_default                          = sanitize_hex_color( get_theme_mod( 'link_default', '#0F7B5C' ) );
		$link_hover                            = sanitize_hex_color( get_theme_mod( 'link_hover', '#1E3A5F' ) );
		$link_active                           = sanitize_hex_color( get_theme_mod( 'link_active', '#0F7B5C' ) );
		$link_visited                          = sanitize_hex_color( get_theme_mod( 'link_visited', '#2E5984' ) );
		$comment_color                         = sanitize_hex_color( get_theme_mod( 'comment_color', '#0F7B5C' ) );
		$card_text_color                       = sanitize_hex_color( get_theme_mod( 'card_text_color', '#1A202C' ) );
		$color_warning                         = sanitize_hex_color( get_theme_mod( 'color_warning', '#E67E22' ) );
		$cta_bg                                = sanitize_hex_color( get_theme_mod( 'cta_bg', '#E67E22' ) );
		$breadcrumb_separator                  = sanitize_text_field( get_theme_mod( 'breadcrumb_separator', '/' ) );
		$text_base                             = sanitize_hex_color( get_theme_mod( 'text_base', '#1A202C' ) );
		$text_muted                            = sanitize_hex_color( get_theme_mod( 'text_muted', '#64748B' ) );
		$text_heading                          = sanitize_hex_color( get_theme_mod( 'text_heading', '#1E3A5F' ) );
		$text_subheading                       = sanitize_hex_color( get_theme_mod( 'text_subheading', '#2E5984' ) );
		$text_emphasis                         = sanitize_hex_color( get_theme_mod( 'text_emphasis', '#0F7B5C' ) );
		$text_quote                            = sanitize_hex_color( get_theme_mod( 'text_quote', '#2E5984' ) );
		$text_list                             = sanitize_hex_color( get_theme_mod( 'text_list', '#1A202C' ) );
		$accent_primary_light                  = sanitize_hex_color( get_theme_mod( 'accent-primary-light', '#E8F2FF' ) );
				$accent_primary                = sanitize_hex_color( get_theme_mod( 'accent-primary', '#E8F2FF' ) );
				$accent_secondary              = sanitize_hex_color( get_theme_mod( 'accent-secondary', '#2E5984' ) );
				$accent_secondary_dark         = sanitize_hex_color( get_theme_mod( 'accent-secondary-dark', '#0B1426' ) );
                $front_intro_overlay_color     = sanitize_hex_color( get_theme_mod( 'front_intro_overlay', '#0B1426' ) );
                $front_intro_overlay_alpha     = floatval( get_theme_mod( 'front_intro_overlay_alpha', 0.8 ) );
                $front_intro_overlay_alpha     = min( 1, max( 0, $front_intro_overlay_alpha ) );
                list( $fio_r, $fio_g, $fio_b ) = sscanf( $front_intro_overlay_color, '#%02x%02x%02x' );
                $front_intro_overlay           = sprintf( 'rgba(%d,%d,%d,%s)', $fio_r, $fio_g, $fio_b, $front_intro_overlay_alpha );
                $front_intro_heading           = sanitize_hex_color( get_theme_mod( 'front_intro_heading', '#E8F2FF' ) );
                $front_intro_text              = sanitize_hex_color( get_theme_mod( 'front_intro_text', '#FFFFFF' ) );
                $header_image_display          = get_theme_mod( 'header_image_display', 'yes' );
                $header_image_url              = get_header_image();
                $front_intro_image             = 'none';
                if ( 'yes' === $header_image_display && ! empty( $header_image_url ) ) {
                        $front_intro_image = 'url(' . esc_url_raw( $header_image_url ) . ')';
                }
				$page_intro_bg_color           = sanitize_hex_color( get_theme_mod( 'page_intro_bg', '#0B1426' ) );
				$page_intro_bg_alpha           = floatval( get_theme_mod( 'page_intro_bg_alpha', 1 ) );
				$page_intro_bg_alpha           = min( 1, max( 0, $page_intro_bg_alpha ) );
				list( $pib_r, $pib_g, $pib_b ) = sscanf( $page_intro_bg_color, '#%02x%02x%02x' );
				$page_intro_bg                 = sprintf( 'rgba(%d,%d,%d,%s)', $pib_r, $pib_g, $pib_b, $page_intro_bg_alpha );
				$page_intro_heading            = sanitize_hex_color( get_theme_mod( 'page_intro_heading', '#E8F2FF' ) );
				$single_intro_bg_color         = sanitize_hex_color( get_theme_mod( 'single_intro_bg', '#0B1426' ) );
				$single_intro_bg_alpha         = floatval( get_theme_mod( 'single_intro_bg_alpha', 1 ) );
				$single_intro_bg_alpha         = min( 1, max( 0, $single_intro_bg_alpha ) );
				list( $sib_r, $sib_g, $sib_b ) = sscanf( $single_intro_bg_color, '#%02x%02x%02x' );
				$single_intro_bg               = sprintf( 'rgba(%d,%d,%d,%s)', $sib_r, $sib_g, $sib_b, $single_intro_bg_alpha );
				$single_intro_heading          = sanitize_hex_color( get_theme_mod( 'single_intro_heading', '#E8F2FF' ) );
				$bg_primary                    = sanitize_hex_color( get_theme_mod( 'bg_primary', '#F7FAFC' ) );
				$bg_secondary                  = sanitize_hex_color( get_theme_mod( 'bg_secondary', '#E8F2FF' ) );
				$breadcrumb_bg                 = sanitize_hex_color( get_theme_mod( 'breadcrumb_bg_color', '#F7FAFC' ) );
				$button_text                   = sanitize_hex_color( get_theme_mod( 'button_text', '#FFFFFF' ) );
				$button_text_hover             = sanitize_hex_color( get_theme_mod( 'button_text_hover', '#0F7B5C' ) );
				$button_bg                     = sanitize_hex_color( get_theme_mod( 'button_bg', '#0F7B5C' ) );
				$button_bg_hover               = sanitize_hex_color( get_theme_mod( 'button_bg_hover', '#FFFFFF' ) );
                $button_border                 = sanitize_hex_color( get_theme_mod( 'button_border', '#0F7B5C' ) );
                $button_border_hover           = sanitize_hex_color( get_theme_mod( 'button_border_hover', '#0F7B5C' ) );
                $button_border_radius          = absint( get_theme_mod( 'button_border_radius', 50 ) ) . 'px';
                $logo_max_height               = absint( get_theme_mod( 'logo_max_height', 80 ) ) . 'px';
                $whatsapp_button_offset_right  = absint( get_theme_mod( 'whatsapp_button_offset_right', 15 ) ) . 'px';
                $whatsapp_button_offset_bottom = absint( get_theme_mod( 'whatsapp_button_offset_bottom', 15 ) ) . 'px';
				$form_text                     = sanitize_hex_color( get_theme_mod( 'form_text', '#1A202C' ) );
				$form_placeholder              = sanitize_hex_color( get_theme_mod( 'form_placeholder', '#64748B' ) );
				$form_border                   = sanitize_hex_color( get_theme_mod( 'form_border', '#E2E8F0' ) );
				$form_border_focus             = sanitize_hex_color( get_theme_mod( 'form_border_focus', '#0F7B5C' ) );
				$form_bg                       = sanitize_hex_color( get_theme_mod( 'form_bg', '#FFFFFF' ) );
				$form_error                    = sanitize_hex_color( get_theme_mod( 'form_error', '#E53E3E' ) );
				$form_success                  = sanitize_hex_color( get_theme_mod( 'form_success', '#0F7B5C' ) );
				$alert_success                 = sanitize_hex_color( get_theme_mod( 'alert_success', '#0F7B5C' ) );
				$alert_error                   = sanitize_hex_color( get_theme_mod( 'alert_error', '#E53E3E' ) );
				$alert_warning                 = sanitize_hex_color( get_theme_mod( 'alert_warning', '#E67E22' ) );
				$alert_info                    = sanitize_hex_color( get_theme_mod( 'alert_info', '#1E3A5F' ) );
				$topbar_bg                     = sanitize_hex_color( get_theme_mod( 'topbar_bg', '#F7FAFC' ) );
		$topbar_text                           = sanitize_hex_color( get_theme_mod( 'topbar_text', '#1A202C' ) );
		$topbar_link                           = sanitize_hex_color( get_theme_mod( 'topbar_link', '#0F7B5C' ) );
		$topbar_link_hover                     = sanitize_hex_color( get_theme_mod( 'topbar_link_hover', '#1E3A5F' ) );
		$topbar_social_icon                    = sanitize_hex_color( get_theme_mod( 'topbar_social_icon', '#0B1426' ) );
		$masthead_bg                           = sanitize_hex_color( get_theme_mod( 'masthead_bg', '#0B1426' ) );
		$masthead_submenu_bg                   = sanitize_hex_color( get_theme_mod( 'masthead_submenu_bg', '#0B1426' ) );
		$masthead_submenu_text                 = sanitize_hex_color( get_theme_mod( 'masthead_submenu_text', '#E8F2FF' ) );
		$masthead_text                         = sanitize_hex_color( get_theme_mod( 'masthead_text', '#E8F2FF' ) );
		$masthead_link                         = sanitize_hex_color( get_theme_mod( 'masthead_link', '#E8F2FF' ) );
		$masthead_link_hover                   = sanitize_hex_color( get_theme_mod( 'masthead_link_hover', '#1E3A5F' ) );
		$masthead_scrolled_bg                  = sanitize_hex_color( get_theme_mod( 'masthead_scrolled_bg', '#E8F2FF' ) );
		$footer_bg                             = sanitize_hex_color( get_theme_mod( 'footer_bg', '#1E3A5F' ) );
		$footer_text                           = sanitize_hex_color( get_theme_mod( 'footer_text', '#FFFFFF' ) );
		$footer_link                           = sanitize_hex_color( get_theme_mod( 'footer_link_color', '#0F7B5C' ) );
				$footer_link_hover             = sanitize_hex_color( get_theme_mod( 'footer_link_hover_color', '#E8F2FF' ) );
				$footer_border                 = sanitize_hex_color( get_theme_mod( 'footer_border_color', '#2E5984' ) );
		$footer_social_bg                      = sanitize_hex_color( get_theme_mod( 'footer_social_bg', '#0F7B5C' ) );
		$footer_social_icon                    = sanitize_hex_color( get_theme_mod( 'footer_social_icon', '#FFFFFF' ) );
		$footer_social_icon_hover              = sanitize_hex_color( get_theme_mod( 'footer_social_icon_hover', '#0F7B5C' ) );
				$color_white                   = sanitize_hex_color( '#FFFFFF' );
				$border_color                  = sanitize_hex_color( get_theme_mod( 'border_color', '#E2E8F0' ) );
				$footer_top_bg                 = sanitize_hex_color( get_theme_mod( 'footer_top_bg', '#1E3A5F' ) );
				$selection_bg                  = sanitize_hex_color( get_theme_mod( 'selection_bg', '#1E3A5F' ) );
		$icon_color                            = sanitize_hex_color( get_theme_mod( 'icon_color', '#0B1426' ) );
		$toc_link                              = sanitize_hex_color( get_theme_mod( 'toc_link', '#0F7B5C' ) );
		$category_bg                           = sanitize_hex_color( get_theme_mod( 'category_bg', '#0F7B5C' ) );
		$category_bg_hover                     = sanitize_hex_color( get_theme_mod( 'category_bg_hover', '#1E3A5F' ) );
		$category_text                         = sanitize_hex_color( get_theme_mod( 'category_text', '#FFFFFF' ) );
		$category_text_hover                   = sanitize_hex_color( get_theme_mod( 'category_text_hover', '#FFFFFF' ) );
		$modal_border                          = sanitize_hex_color( '#64748B' );

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
                        --front-intro-image: ' . esc_attr( $front_intro_image ) . ';
                        --front-intro-heading: ' . esc_attr( $front_intro_heading ) . ';
                        --front-intro-text: ' . esc_attr( $front_intro_text ) . ';
                        --page-intro-bg: ' . esc_attr( $page_intro_bg ) . ';
                        --page-intro-heading: ' . esc_attr( $page_intro_heading ) . ';
                        --single-intro-bg: ' . esc_attr( $single_intro_bg ) . ';
                        --single-intro-heading: ' . esc_attr( $single_intro_heading ) . ';
                        --btn-text: ' . esc_attr( $button_text ) . ';
                        --btn-text-hover: ' . esc_attr( $button_text_hover ) . ';
                        --btn-bg: ' . esc_attr( $button_bg ) . ';
                        --btn-bg-hover: ' . esc_attr( $button_bg_hover ) . ';
                        --btn-border: ' . esc_attr( $button_border ) . ';
                        --btn-border-hover: ' . esc_attr( $button_border_hover ) . ';
                        --btn-radius: ' . esc_attr( $button_border_radius ) . ';
                        --logo-max-height: ' . esc_attr( $logo_max_height ) . ';
                        --whatsapp-offset-right: ' . esc_attr( $whatsapp_button_offset_right ) . ';
                        --whatsapp-offset-bottom: ' . esc_attr( $whatsapp_button_offset_bottom ) . ';
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
                        --footer-top-bg: ' . esc_attr( $footer_top_bg ) . ';
                        --selection-bg: ' . esc_attr( $selection_bg ) . ';
                        --icon: ' . esc_attr( $icon_color ) . ';
                        --category-bg: ' . esc_attr( $category_bg ) . ';
                        --category-bg-hover: ' . esc_attr( $category_bg_hover ) . ';
                        --category-text: ' . esc_attr( $category_text ) . ';
                        --category-text-hover: ' . esc_attr( $category_text_hover ) . ';
                        --toc-link: ' . esc_attr( $toc_link ) . ';
                        --modal-border: ' . esc_attr( $modal_border ) . ';
                }
        ';

        return apply_filters( 'smile_web_dynamic_root_styles', $dynamic_css );
}

/**
 * Outputs inline dynamic CSS based on customizer settings.
 */
function smile_web_add_dynamic_styles() {
        $dynamic_css = smile_web_get_dynamic_root_styles();

        if ( empty( $dynamic_css ) ) {
                return;
        }

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