<?php

/* Load customizer sanitization functions */
require get_template_directory() . '/inc/customizer/sanitization.php';

/* Load custom control classes. */
add_action( 'customize_register', 'theone_load_custom_controls', 1 );

/* Theme Customizer setup. */
add_action( 'customize_register', 'theone_customize_register' );

/* Load customize preview scripts */
add_action( 'customize_preview_init', 'theone_customize_preview_js' );

/**
 * Load custom controls.
 */
function theone_load_custom_controls() {
	require get_template_directory() . '/inc/customizer/controls/multiple-select.php';
}

/**
 * Add theme specific customizer settings.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function theone_customize_register( WP_Customize_Manager $wp_customize ) {

	/**
	 * TABLE OF CONTENTS:
	 ***************************
	 * 1.0 Modify Core
	 * 2.0 Custom Settings
	 * Add sections
	 * Accent color
	 * Excerpts toggle
	 * Search form toggle
	 * Header
	 * Overlay Color
	 * Overlay Opacity
	 * Site title background color
	 * Site description toggle
	 * Site logo upload
	 * Social Network Share / Bookmark Links
	 * Enable Sharing
	 * Select Sharing Position
	 * Select Sharing/Bookmarking Services
	 */

	/********************************************************************************************************
	 * 1.0 - Modify Core
	 ********************************************************************************************************/

	/**
	 * Sections
	 */
	$wp_customize->get_section( 'title_tagline' )->title = esc_attr__( 'Title, Tagline, & Logo', 'the-one' );
	
	/**
	 * Controls
	 */
	$wp_customize->get_control( 'blogname' )->priority = 1;
	$wp_customize->get_control( 'blogdescription' )->priority = 3;
	$wp_customize->get_control( 'background_color' )->priority = 1;

	/**
	 * Settings
	 */
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
	/********************************************************************************************************
	 * 2.0 - Custom Settings
	 ********************************************************************************************************/

	/**
	 * Add sections for this theme
	 */
	$wp_customize->add_section( 'theone_section_general', array(
			'title' => __( 'General', 'the-one' ),
			'priority' => 30,
		) );
	$wp_customize->add_section( 'theone_section_sharing', array(
			'title' => __( 'Sharing', 'the-one' ),
			'priority' => 35,
			'description' => __( 'This theme integrates social network sharing and bookmarking links. Use the settings below to enable / customize it.', 'the-one' ),
		) );
	
	/**
	 * Accent color
	 */
	$wp_customize->add_setting( 'theone_accent_color', array(
			'default' => '#d64431',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theone_accent_color', array(
				'label' => __( 'Accent Color', 'the-one' ),
				'description' => '',
				'section' => 'colors',
				'settings' => 'theone_accent_color',
				'priority' => 2,
			) ) );
	
	/**
	 * Excerpts toggle
	 */
	$wp_customize->add_setting( 'theone_display_excerpt', array(
			'default' => 0,
			'sanitize_callback' => 'theone_sanitize_checkbox',
		) );
	$wp_customize->add_control( 'theone_display_excerpt', array(
			'label' => __( 'Display entry excerpts', 'the-one' ),
			'type' => 'checkbox',
			'section' => 'theone_section_general',
			'priority' => 1,
		) );

    /**
     * Cleaner Gallery toggle
     */
    $wp_customize->add_setting( 'theone_cleaner_gallery', array(
        'default' => 0,
        'sanitize_callback' => 'theone_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'theone_cleaner_gallery', array(
        'label' => __( 'Use Hybrid Core cleaner gallery', 'the-one' ),
        'type' => 'checkbox',
        'section' => 'theone_section_general',
        'priority' => 1,
    ) );

    /**
     * Ajaxify toggle
     */
    $wp_customize->add_setting( 'theone_ajaxify', array(
        'default' => 1,
        'sanitize_callback' => 'theone_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'theone_ajaxify', array(
        'label' => __( 'Turn on Axaxify', 'the-one' ),
        'type' => 'checkbox',
        'section' => 'theone_section_general',
        'priority' => 2,
    ) );

	/**
	 * Search form toggle
	 */
	$wp_customize->add_setting( 'theone_search_form_insert', array(
		'default' => 'none',
		'sanitize_callback' => 'theone_sanitize_choices',
	) );
	$wp_customize->add_control( 'theone_search_form_insert', array(
		'type' => 'radio',
		'section' => 'theone_section_general',
		'label' => __( 'Use search form at:', 'the-one' ),
		'description' => __( 'If search form is used with any menu, make sure that menu is active first.', 'the-one' ),
		'choices' => array(
			'none' => __( 'None', 'the-one' ),
			'menu_primary_top' => __( 'Top of Primary menu', 'the-one' ),
			'menu_primary_bottom' => __( 'Bottom of Primary menu', 'the-one' ),
			'menu_secondary_bottom' => __( 'Bottom of Secondary menu', 'the-one' ),
			'footer_top' => __( 'Top of Footer', 'the-one' ),
		),
	) );
	
	/**
	 * Header
	 */
	
	/* === Overlay Color === */
	$wp_customize->add_setting( 'theone_header_overlay_color', array(
			'default' => '#000000',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theone_header_overlay_color', array(
				'label' => __( 'Header Overlay Color', 'the-one' ),
				'description' => __( 'If you cannot see this color in the header, adjust the Header Overlay Opacity setting.', 'the-one' ),
				'section' => 'colors',
				'settings' => 'theone_header_overlay_color',
				'priority' => 3,
			) ) );

	/* === Overlay Opacity === */
	$wp_customize->add_setting( 'theone_header_overlay_opacity', array(
			'default' => '1',
			'sanitize_callback' => 'theone_sanitize_choices',
			'transport' => 'postMessage',
		) );
	$wp_customize->add_control( 'theone_header_overlay_opacity', array(
			'type' => 'select',
			'section' => 'colors',
			'label' => __( 'Header Overlay Opacity', 'the-one' ),
			'priority' => 4,
			'choices' => array(
				'0' => esc_html( '0' ),
				'1' => esc_html( '10%' ),
				'2' => esc_html( '20%' ),
				'3' => esc_html( '30%' ),
				'4' => esc_html( '40%' ),
				'5' => esc_html( '50%' ),
				'6' => esc_html( '60%' ),
				'7' => esc_html( '70%' ),
				'8' => esc_html( '80%' ),
				'9' => esc_html( '90%' ),
				'99' => esc_html( '99%' ),
			),
		) );
	
	/**
	 * Site title background color
	 */
	$wp_customize->add_setting( 'theone_site_title_bg_color', array(
			'default' => '#080808',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theone_site_title_bg_color', array(
				'label' => __( 'Site Title Background Color', 'the-one' ),
				'section' => 'colors',
				'settings' => 'theone_site_title_bg_color',
				'priority' => 5,
			) ) );
	
	/**
	 * Site description toggle
	 */
	$wp_customize->add_setting( 'theone_site_description_toggle', array(
			'default' => 1,
			'sanitize_callback' => 'theone_sanitize_checkbox',
		) );
	$wp_customize->add_control( 'theone_site_description_toggle', array(
			'label' => __( 'Display tagline', 'the-one' ),
			'type' => 'checkbox',
			'section' => 'title_tagline',
			'priority' => 5,
		) );
	
	/**
	 * Site logo upload
	 */
	$wp_customize->add_setting( 'theone_logo_image', array(
			'sanitize_callback' => 'esc_url_raw',
		) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theone_logo_image', array(
				'label' => __( 'Logo', 'the-one' ),
				'description' => __( 'If a logo exists, it automatically replaces the site title.', 'the-one' ),
				'settings' => 'theone_logo_image',
				'section' => 'title_tagline',
				'priority' => 7,
			) ) );
	
	/**
	 * Social Network Share / Bookmark Links
	 */

	/**
	 * Excerpts toggle
	 */
	$wp_customize->add_setting( 'theone_share_status', array(
			'default' => 0,
			'sanitize_callback' => 'theone_sanitize_checkbox',
		) );
	$wp_customize->add_control( 'theone_share_status', array(
			'label' => __( 'Turn on social network sharing', 'the-one' ),
			'type' => 'checkbox',
			'section' => 'theone_section_sharing',
			'priority' => 1,
		) );

	/**
	 * Sharing: Enable on which pages?
	 */
	$wp_customize->add_setting( 'theone_share_conditionals', array(
			'default' => array( 'is_home', 'is_archive', 'is_singular' ),
			'sanitize_callback' => 'theone_sanitize_multiple_choices',
		) );
	$wp_customize->add_control( new Multiple_Select_Custom_Control ( $wp_customize, 'theone_share_conditionals', array(
				'type' => 'multiple-select',
				'section' => 'theone_section_sharing',
				'settings' => 'theone_share_conditionals',
				'label' => __( 'Pages to display on:', 'the-one' ),
				'description' => __( 'Hold down Ctrl to deselect or select multiple choices.', 'the-one' ),
				'choices' => array(
					'none' => __( 'None', 'the-one' ),
					'is_home' => __( 'Home', 'the-one' ),
					'is_front_page' => __( 'Static Front Page', 'the-one' ),
					'is_archive' => __( 'Archives', 'the-one' ),
					'is_single' => __( 'Posts', 'the-one' ),
					'is_page' => __( 'Pages', 'the-one' ),
					'is_singular' => __( 'All Posts, Pages, and Post Types', 'the-one' ),
					'is_search' => __( 'Search Results', 'the-one' ),
				),
			) ) );

	/**
	 * Sharing: Position - Top, Bottom, Side, or Fixed
	 */
	$wp_customize->add_setting( 'theone_share_position', array(
			'default' => 'fixed',
			'sanitize_callback' => 'theone_sanitize_choices',
		) );
	$wp_customize->add_control( 'theone_share_position', array(
			'type' => 'radio',
			'section' => 'theone_section_sharing',
			'label' => __( 'Position to display at:', 'the-one' ),
			'description' => __( 'Where to display share links relative to the content.', 'the-one' ),
			'choices' => array(
				'top' => __( 'Top of Content', 'the-one' ),
				'bottom' => __( 'Bottom of Content', 'the-one' ),
				'side' => __( 'Bottom of Content for Archive view and Side of Content for Singular views', 'the-one' ),
				'fixed' => __( 'Fixed to Page (recommended) ', 'the-one' ),
			),
		) );
	
	/**
	 * Sharing: Services / Links
	 */
	$wp_customize->add_setting( 'theone_share_links', array(
			'default' => array( 'facebook', 'googleplus', 'pinterest', 'twitter' ),
			'sanitize_callback' => 'theone_sanitize_multiple_choices',
		) );
	$wp_customize->add_control( new Multiple_Select_Custom_Control ( $wp_customize, 'theone_share_links', array(
				'type' => 'multiple-select',
				'section' => 'theone_section_sharing',
				'settings' => 'theone_share_links',
				'label' => __( 'Services to use:', 'the-one' ),
				'description' => __( 'Hold down Ctrl to deselect or select multiple choices.', 'the-one' ),
				'choices' => array(
					'email' => 'Email',
					'facebook' => 'Facebook',
					'googleplus' => 'Google Plus',
					'linkedin' => 'LinkedIn',
					'pinterest' => 'Pinterest',
					'reddit' => 'Reddit',
					'stumbleupon' => 'Stumble Upon',
					'tumblr' => 'Tumblr',
					'twitter' => 'Twitter',
				),
			) ) );
	
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */
function theone_customize_preview_js() {
	wp_enqueue_script( 'theone-customizer', get_template_directory_uri() . '/inc/customizer/customizer.js', array( 'customize-preview' ), true );
}
