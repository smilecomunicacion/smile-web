<?php
/**
 * Customizer Options for SMiLE Web Theme.
 *
 * @package smile-web
 */

/**
 * Registers customizer sections, settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function smile_v6_customize_theme_sections( $wp_customize ) {
	// Remove default colors section.
	$wp_customize->remove_section( 'colors' );

	// Add custom Theme Colors section.
	$wp_customize->add_section(
		'custom_theme_colors_section',
		array(
			'title'      => esc_html__( 'Theme Colors', 'smile-web' ),
			'priority'   => 30,
			'capability' => 'edit_theme_options',
		)
	);

	// Add theme settings section.
	$wp_customize->add_section(
		'smile_v6_settings',
		array(
			'title'    => esc_html__( 'SMiLE Web Settings', 'smile-web' ),
			'priority' => 160,
		)
	);

	// Array with general settings.
	$settings = array(
		'top_bar_email'      => array(
			'label'   => esc_html__( 'Top Bar Email', 'smile-web' ),
			'type'    => 'email',
			'default' => '',
		),
		'top_bar_telephone'  => array(
			'label'   => esc_html__( 'Top Bar Telephone', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'whatsapp_telephone' => array(
			'label'   => esc_html__( 'Whatsapp Telephone', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'whatsapp_message'   => array(
			'label'   => esc_html__( 'Whatsapp Message', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'blog_title'         => array(
			'label'   => esc_html__( 'Blog Title', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'blog_description'   => array(
			'label'   => esc_html__( 'Blog Description', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'blog_default_image' => array(
			'label'   => esc_html__( 'Blog Default Image', 'smile-web' ),
			'type'    => 'image',
			'default' => '',
		),
		'blog_post_quantity' => array(
			'label'   => esc_html__( 'Blog Post Quantity', 'smile-web' ),
			'type'    => 'number',
			'default' => 0,
		),
		'footer_logo'        => array(
			'label'   => esc_html__( 'Footer Logo', 'smile-web' ),
			'type'    => 'image',
			'default' => '',
		),
	);

	// Create settings and controls for general settings.
	foreach ( $settings as $id => $args ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => ( 'email' === $args['type'] ) ? 'sanitize_email' : 'sanitize_text_field',
			)
		);
		$control_type = ( 'image' === $args['type'] ) ? 'WP_Customize_Image_Control' : 'WP_Customize_Control';
		$wp_customize->add_control(
			new $control_type(
				$wp_customize,
				$id,
				array(
					'label'    => $args['label'],
					'section'  => 'smile_v6_settings',
					'settings' => $id,
					'type'     => $args['type'],
				)
			)
		);
	}

	// Array for theme color controls.
	$colors = array(
		'color_text'       => array(
			'default' => '#00112b',
			'label'   => esc_html__( 'Text Color', 'smile-web' ),
		),
		'color_link'       => array(
			'default' => '#307C03',
			'label'   => esc_html__( 'Link Color', 'smile-web' ),
		),
		'color_link_hover' => array(
			'default' => '#306a93',
			'label'   => esc_html__( 'Link Color Hover', 'smile-web' ),
		),
		'color_link_light' => array(
			'default' => '#4a994f',
			'label'   => esc_html__( 'Link Color Light', 'smile-web' ),
		),
		'color_1_light'    => array(
			'default' => '#d2e1ef',
			'label'   => esc_html__( 'Color 1 Light', 'smile-web' ),
		),
		'color_1'          => array(
			'default' => '#d2e1ef',
			'label'   => esc_html__( 'Color 1', 'smile-web' ),
		),
		'color_2'          => array(
			'default' => '#225274',
			'label'   => esc_html__( 'Color 2', 'smile-web' ),
		),
		'color_2_dark'     => array(
			'default' => '#001833',
			'label'   => esc_html__( 'Color 2 Dark', 'smile-web' ),
		),
		'bg_light'         => array(
			'default' => '#edf7ef',
			'label'   => esc_html__( 'Primary Background Color', 'smile-web' ),
		),
		'bg_light2'        => array(
			'default' => '#f8f9fa',
			'label'   => esc_html__( 'Secondary Background Color', 'smile-web' ),
		),
                'footer_bg'        => array(
                        'default' => '#274c77',
                        'label'   => esc_html__( 'Footer Background Color', 'smile-web' ),
                ),
                'footer_text'      => array(
                        'default' => '#FFFEFA',
                        'label'   => esc_html__( 'Footer Text Color', 'smile-web' ),
                ),
               'footer_link_color' => array(
                       'default' => '#307C03',
                       'label'   => esc_html__( 'Footer Link Color', 'smile-web' ),
               ),
               'footer_link_hover_color' => array(
                       'default' => '#306a93',
                       'label'   => esc_html__( 'Footer Link Hover Color', 'smile-web' ),
               ),
               'footer_border_color' => array(
                       'default' => '#f6fbf7',
                       'label'   => esc_html__( 'Footer Border Color', 'smile-web' ),
               ),
               'footer_social_bg' => array(
                       'default' => '#4a994f',
                       'label'   => esc_html__( 'Footer Social Background Color', 'smile-web' ),
               ),
               'footer_social_icon' => array(
                       'default' => '#ffffff',
                       'label'   => esc_html__( 'Footer Social Icon Color', 'smile-web' ),
               ),
       );

	// Create settings and controls for color options.
	foreach ( $colors as $id => $args ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$id,
				array(
					'label'    => $args['label'],
					'section'  => 'custom_theme_colors_section',
					'settings' => $id,
				)
			)
		);
	}
}
add_action( 'customize_register', 'smile_v6_customize_theme_sections' );

/**
 * Registers the contact section in the customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function smile_v6_customize_contact_section( $wp_customize ) {
	$wp_customize->add_section(
		'contact_section',
		array(
			'title'      => esc_html__( 'Contact Section', 'smile-web' ),
			'priority'   => 170,
			'capability' => 'edit_theme_options',
		)
	);

	$contact_settings = array(
		'footer_contact_display'        => array(
			'label'   => esc_html__( 'Display Contact Section?', 'smile-web' ),
			'type'    => 'radio',
			'default' => 'yes',
			'choices' => array(
				'yes' => esc_html__( 'Yes', 'smile-web' ),
				'no'  => esc_html__( 'No', 'smile-web' ),
			),
		),
		'footer_contact_title'          => array(
			'label'   => esc_html__( 'Footer Contact Title', 'smile-web' ),
			'type'    => 'text',
			'default' => esc_html__( 'Contact', 'smile-web' ),
		),
		'footer_contact_description'    => array(
			'label'   => esc_html__( 'Footer Contact Description', 'smile-web' ),
			'type'    => 'textarea',
			'default' => esc_html__( 'Use this form to reach out with any questions or comments. We will respond as soon as possible.', 'smile-web' ),
		),
		'footer_telephone'              => array(
			'label'   => esc_html__( 'Footer Contact Telephone', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'footer_address'                => array(
			'label'   => esc_html__( 'Footer Contact Address', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'footer_postal_code'            => array(
			'label'   => esc_html__( 'Footer Contact Postal Code', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'footer_place'                  => array(
			'label'   => esc_html__( 'Footer Contact Place', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'footer_city'                   => array(
			'label'   => esc_html__( 'Footer Contact City', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'footer_link_to_google_maps'    => array(
			'label'   => esc_html__( 'Footer Contact Link to Google Maps (SRC)', 'smile-web' ),
			'type'    => 'url',
			'default' => '',
		),
		'footer_email'                  => array(
			'label'   => esc_html__( 'Footer Contact Email', 'smile-web' ),
			'type'    => 'email',
			'default' => '',
		),
		'footer_contact_shortcode_form' => array(
			'label'   => esc_html__( 'Footer Contact Shortcode Form', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
	);

	foreach ( $contact_settings as $id => $args ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => ( 'email' === $args['type'] ) ? 'sanitize_email' : 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'    => $args['label'],
				'section'  => 'contact_section',
				'settings' => $id,
				'type'     => $args['type'],
				'choices'  => isset( $args['choices'] ) ? $args['choices'] : array(),
			)
		);
	}
}
add_action( 'customize_register', 'smile_v6_customize_contact_section' );

/**
 * Registers header image display option in the customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function smile_v6_customize_header_image_display( $wp_customize ) {
	$wp_customize->add_setting(
		'header_image_display',
		array(
			'default'           => 'yes',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'header_image_display_control',
		array(
			'label'    => esc_html__( 'Display Header Image', 'smile-web' ),
			'section'  => 'header_image',
			'settings' => 'header_image_display',
			'type'     => 'radio',
			'choices'  => array(
				'yes' => esc_html__( 'Yes', 'smile-web' ),
				'no'  => esc_html__( 'No', 'smile-web' ),
			),
		)
	);
}
add_action( 'customize_register', 'smile_v6_customize_header_image_display' );
