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

		// Add custom Theme Colors panel.
		$wp_customize->add_panel(
			'custom_theme_colors_panel',
			array(
				'title'      => esc_html__( 'Theme Colors', 'smile-web' ),
				'priority'   => 30,
				'capability' => 'edit_theme_options',
			)
		);

		// Add Global Colors subsection.
		$wp_customize->add_section(
			'custom_theme_global_colors',
			array(
				'title'      => esc_html__( 'Global Colors', 'smile-web' ),
				'priority'   => 10,
				'capability' => 'edit_theme_options',
				'panel'      => 'custom_theme_colors_panel',
			)
		);

		// Add Top Bar Colors subsection.
		$wp_customize->add_section(
			'custom_theme_topbar_colors',
			array(
				'title'      => esc_html__( 'Top Bar Colors', 'smile-web' ),
				'priority'   => 15,
				'capability' => 'edit_theme_options',
				'panel'      => 'custom_theme_colors_panel',
			)
		);

		// Add Masthead Colors subsection.
		$wp_customize->add_section(
			'custom_theme_masthead_colors',
			array(
				'title'      => esc_html__( 'Masthead Colors', 'smile-web' ),
				'priority'   => 16,
				'capability' => 'edit_theme_options',
				'panel'      => 'custom_theme_colors_panel',
			)
		);

		// Add Footer Colors subsection.
		$wp_customize->add_section(
			'custom_theme_footer_colors',
			array(
				'title'      => esc_html__( 'Footer Colors', 'smile-web' ),
				'priority'   => 20,
				'capability' => 'edit_theme_options',
				'panel'      => 'custom_theme_colors_panel',
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
               'breadcrumb_separator' => array(
                       'label'   => esc_html__( 'Breadcrumb Separator', 'smile-web' ),
                       'type'    => 'text',
                       'default' => '/',
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

               // Global color controls.
               // Ensure chosen colors maintain a 4.5:1 contrast ratio for accessibility.
               $global_colors = array(
                        'color_text'            => array(
                                'default' => '#00112b',
                                'label'   => esc_html__( 'Text Color', 'smile-web' ),
                        ),
			'color_link'            => array(
				'default' => '#307C03',
				'label'   => esc_html__( 'Link Color', 'smile-web' ),
			),
			'color_link_hover'      => array(
				'default' => '#306a93',
				'label'   => esc_html__( 'Link Color Hover', 'smile-web' ),
			),
                        'color_link_light'      => array(
                                'default' => '#4a994f',
                                'label'   => esc_html__( 'Link Color Light', 'smile-web' ),
                        ),
                        'comment_color'        => array(
                                'default' => '#307C03',
                                'label'   => esc_html__( 'Comment Color', 'smile-web' ),
                        ),
                       'card_text_color'     => array(
                               'default' => '#00112b',
                               'label'   => esc_html__( 'Card Text Color', 'smile-web' ),
                       ),
                       'text_base'           => array(
                               'default' => '#00112b',
                               'label'   => esc_html__( 'Base Text Color', 'smile-web' ),
                       ),
                       'text_muted'          => array(
                               'default' => '#6c757d',
                               'label'   => esc_html__( 'Muted Text Color', 'smile-web' ),
                       ),
                       'text_heading'        => array(
                               'default' => '#306a93',
                               'label'   => esc_html__( 'Heading Text Color', 'smile-web' ),
                       ),
                       'text_subheading'     => array(
                               'default' => '#225274',
                               'label'   => esc_html__( 'Subheading Text Color', 'smile-web' ),
                       ),
                       'text_emphasis'       => array(
                               'default' => '#307C03',
                               'label'   => esc_html__( 'Emphasis Text Color', 'smile-web' ),
                       ),
                       'text_quote'          => array(
                               'default' => '#225274',
                               'label'   => esc_html__( 'Quote Text Color', 'smile-web' ),
                       ),
                       'text_list'           => array(
                               'default' => '#00112b',
                               'label'   => esc_html__( 'List Text Color', 'smile-web' ),
                       ),
                       'color_muted'           => array(
                               'default' => '#6c757d',
                               'label'   => esc_html__( 'Muted Color', 'smile-web' ),
                       ),
                        'color_warning'         => array(
                                'default' => '#ffc107',
                                'label'   => esc_html__( 'Warning Color', 'smile-web' ),
                        ),
                       'cta_bg'                => array(
                               'default' => '#ffc107',
                               'label'   => esc_html__( 'CTA Background Color', 'smile-web' ),
                       ),
                        'accent-primary-light'  => array(
                                'default' => '#d2e1ef',
                                'label'   => esc_html__( 'Primary Accent Color Light', 'smile-web' ),
                        ),
			'accent-primary'        => array(
				'default' => '#d2e1ef',
				'label'   => esc_html__( 'Primary Accent Color', 'smile-web' ),
			),
			'accent-secondary'      => array(
				'default' => '#225274',
				'label'   => esc_html__( 'Secondary Accent Color', 'smile-web' ),
			),
			'accent-secondary-dark' => array(
				'default' => '#001833',
				'label'   => esc_html__( 'Secondary Accent Color Dark', 'smile-web' ),
			),
			'bg_light'              => array(
				'default' => '#edf7ef',
				'label'   => esc_html__( 'Primary Background Color', 'smile-web' ),
			),
'bg_light2'             => array(
'default' => '#f8f9fa',
'label'   => esc_html__( 'Secondary Background Color', 'smile-web' ),
),
'heading_color'        => array(
'default' => '#306a93',
'label'   => esc_html__( 'Heading Color', 'smile-web' ),
),
'lead_color'           => array(
'default' => '#306a93',
'label'   => esc_html__( 'Lead Color', 'smile-web' ),
),
'border_color'         => array(
'default' => '#dee2e6',
'label'   => esc_html__( 'Border Color', 'smile-web' ),
),
);

		// Top bar color controls.
		$topbar_colors = array(
			'topbar_bg'          => array(
				'default' => '#f8f9fa',
				'label'   => esc_html__( 'Top Bar Background Color', 'smile-web' ),
			),
			'topbar_text'        => array(
				'default' => '#00112b',
				'label'   => esc_html__( 'Top Bar Text Color', 'smile-web' ),
			),
			'topbar_link'        => array(
				'default' => '#307C03',
				'label'   => esc_html__( 'Top Bar Link Color', 'smile-web' ),
			),
			'topbar_link_hover'  => array(
				'default' => '#306a93',
				'label'   => esc_html__( 'Top Bar Link Hover Color', 'smile-web' ),
			),
			'topbar_social_icon' => array(
				'default' => '#001833',
				'label'   => esc_html__( 'Top Bar Social Icon Color', 'smile-web' ),
			),
		);

				// Masthead color controls.
				$masthead_colors = array(
					'masthead_bg'           => array(
						'default' => '#001833',
						'label'   => esc_html__( 'Masthead Background Color', 'smile-web' ),
					),
					'masthead_submenu_bg'   => array(
						'default' => '#001833',
						'label'   => esc_html__( 'Masthead Submenu Background Color', 'smile-web' ),
					),
					'masthead_submenu_text' => array(
						'default' => '#d2e1ef',
						'label'   => esc_html__( 'Masthead Submenu Text Color', 'smile-web' ),
					),
					'masthead_link'         => array(
						'default' => '#d2e1ef',
						'label'   => esc_html__( 'Masthead Link Color', 'smile-web' ),
					),
					'masthead_link_hover'   => array(
						'default' => '#306a93',
						'label'   => esc_html__( 'Masthead Link Hover Color', 'smile-web' ),
					),
					'masthead_scrolled_bg'  => array(
						'default' => '#d2e1ef',
						'label'   => esc_html__( 'Masthead Scrolled Background Color', 'smile-web' ),
					),
				);

				// Footer color controls.
				$footer_colors = array(
					'footer_bg'                => array(
						'default' => '#274c77',
						'label'   => esc_html__( 'Footer Background Color', 'smile-web' ),
					),
					'footer_text'              => array(
						'default' => '#FFFEFA',
						'label'   => esc_html__( 'Footer Text Color', 'smile-web' ),
					),
					'footer_link_color'        => array(
						'default' => '#307C03',
						'label'   => esc_html__( 'Footer Link Color', 'smile-web' ),
					),
					'footer_link_hover_color'  => array(
						'default' => '#306a93',
						'label'   => esc_html__( 'Footer Link Hover Color', 'smile-web' ),
					),
					'footer_border_color'      => array(
						'default' => '#f6fbf7',
						'label'   => esc_html__( 'Footer Border Color', 'smile-web' ),
					),
					'footer_social_bg'         => array(
						'default' => '#4a994f',
						'label'   => esc_html__( 'Footer Social Background Color', 'smile-web' ),
					),
					'footer_social_icon'       => array(
						'default' => '#ffffff',
						'label'   => esc_html__( 'Footer Social Icon Color', 'smile-web' ),
					),
					'footer_social_icon_hover' => array(
						'default' => '#4a994f',
						'label'   => esc_html__( 'Footer Social Icon Hover Color', 'smile-web' ),
					),
				);

				// Create settings and controls for global colors.
				foreach ( $global_colors as $id => $args ) {
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
									'section'  => 'custom_theme_global_colors',
									'settings' => $id,
								)
							)
						);
				}

				// Create settings and controls for top bar colors.
				foreach ( $topbar_colors as $id => $args ) {
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
									'section'  => 'custom_theme_topbar_colors',
									'settings' => $id,
								)
							)
						);
				}

				// Create settings and controls for masthead colors.
				foreach ( $masthead_colors as $id => $args ) {
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
									'section'  => 'custom_theme_masthead_colors',
									'settings' => $id,
								)
							)
						);
				}

				// Create settings and controls for footer colors.
				foreach ( $footer_colors as $id => $args ) {
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
									'section'  => 'custom_theme_footer_colors',
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

/**
 * Registers front page intro section in the customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 * @since 6.0.7
 */
function smile_v6_customize_front_page_intro_section( $wp_customize ) {
	$wp_customize->add_section(
		'front_page_intro_section',
		array(
			'title'      => esc_html__( 'Front Page Intro', 'smile-web' ),
			'priority'   => 180,
			'capability' => 'edit_theme_options',
		)
	);

	$intro_settings = array(
		'intro_content_type'       => array(
			'label'   => esc_html__( 'Intro Content Type', 'smile-web' ),
			'type'    => 'radio',
			'default' => 'automatic',
			'choices' => array(
				'automatic' => esc_html__( 'Automatic (use page title and excerpt)', 'smile-web' ),
				'custom'    => esc_html__( 'Custom (use custom title and description)', 'smile-web' ),
			),
		),
		'intro_custom_title'       => array(
			'label'   => esc_html__( 'Custom Intro Title', 'smile-web' ),
			'type'    => 'text',
			'default' => '',
		),
		'intro_custom_description' => array(
			'label'   => esc_html__( 'Custom Intro Description', 'smile-web' ),
			'type'    => 'textarea',
			'default' => '',
		),
	);

	foreach ( $intro_settings as $id => $args ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'    => $args['label'],
				'section'  => 'front_page_intro_section',
				'settings' => $id,
				'type'     => $args['type'],
				'choices'  => isset( $args['choices'] ) ? $args['choices'] : array(),
			)
		);
	}
}
add_action( 'customize_register', 'smile_v6_customize_front_page_intro_section' );
