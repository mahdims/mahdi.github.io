<?php
/**
 * Ovation Blog: Customizer
 *
 * @subpackage Ovation Blog
 * @since 1.0
 */

function ovation_blog_customize_register( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/assets/css/customizer.css');

	// fontawesome icon-picker

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	// Add custom control.
  	
  	require get_parent_theme_file_path( 'inc/switch/control_switch.php' );

  	require get_parent_theme_file_path( 'inc/custom-control.php' );

  	//Register the sortable control type.
	$wp_customize->register_control_type( 'Ovation_Blog_Control_Sortable' );

  	// Add homepage customizer file
  	require get_template_directory() . '/inc/customizer-home-page.php';

  	//pro section
 	$wp_customize->add_section('ovation_blog_pro', array(
        'title'    => __('UPGRADE BLOG PREMIUM', 'ovation-blog'),
        'priority' => 1,
    ));
    $wp_customize->add_setting('ovation_blog_pro', array(
        'default'           => null,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Ovation_Blog_Pro_Control($wp_customize, 'ovation_blog_pro', array(
        'label'    => __('BLOG PREMIUM', 'ovation-blog'),
        'section'  => 'ovation_blog_pro',
        'settings' => 'ovation_blog_pro',
        'priority' => 1,
    )));

    //Logo
	$wp_customize->add_setting('ovation_blog_logo_max_height',array(
		'default'=> '100',
		'transport' => 'refresh',
		'sanitize_callback' => 'ovation_blog_sanitize_integer'
	));
	$wp_customize->add_control(new Ovation_Blog_Slider_Custom_Control( $wp_customize, 'ovation_blog_logo_max_height',array(
		'label'	=> esc_html__('Logo height','ovation-blog'),
		'section'=> 'title_tagline',
		'settings'=>'ovation_blog_logo_max_height',
		'input_attrs' => array(
			'reset'				=> 100,
            'step'             	=> 1,
			'min'              	=> 0,
			'max'              	=> 250,
        ),
        'priority' => 9,
	)));
	$wp_customize->add_setting('ovation_blog_logo_title',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_logo_title',
			array(
				'settings'        => 'ovation_blog_logo_title',
				'section'         => 'title_tagline',
				'label'           => __( 'Show Site Title', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('ovation_blog_logo_text',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_logo_text',
			array(
				'settings'        => 'ovation_blog_logo_text',
				'section'         => 'title_tagline',
				'label'           => __( 'Show Site Tagline', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);

	//colors
	if ( $wp_customize->get_section( 'colors' ) ) {
        $wp_customize->get_section( 'colors' )->title = __( 'Global Colors', 'ovation-blog' );
        $wp_customize->get_section( 'colors' )->priority = 2;
    }

    $wp_customize->add_setting( 'ovation_blog_global_color_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_global_color_heading', array(
			'label'       => esc_html__( 'Global Colors', 'ovation-blog' ),
			'section'     => 'colors',
			'settings'    => 'ovation_blog_global_color_heading',
			'priority'       => 1,

	) ) );

    $wp_customize->add_setting('ovation_blog_primary_color', array(
	    'default' => '#7eaf83',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ovation_blog_primary_color', array(
	    'section' => 'colors',
	    'label' => esc_html__('Theme Color', 'ovation-blog'),
	 
	)));

	$wp_customize->add_setting('ovation_blog_top_head_color', array(
	    'default' => '#fafafa',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ovation_blog_top_head_color', array(
	    'section' => 'colors',
	    'label' => esc_html__('Top Header Color', 'ovation-blog'),
	 
	)));

	$wp_customize->add_setting('ovation_blog_heading_color', array(
	    'default' => '#323232',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ovation_blog_heading_color', array(
	    'section' => 'colors',
	    'label' => esc_html__('Theme Heading Color', 'ovation-blog'),
	 
	)));

	$wp_customize->add_setting('ovation_blog_text_color', array(
	    'default' => '#a8a8a8',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ovation_blog_text_color', array(
	    'section' => 'colors',
	    'label' => esc_html__('Theme Text Color', 'ovation-blog'),
	 
	)));

	$wp_customize->add_setting('ovation_blog_primary_fade', array(
	    'default' => '#d1fed5',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ovation_blog_primary_fade', array(
	    'section' => 'colors',
	    'label' => esc_html__('theme Color Light', 'ovation-blog'),
	 
	)));

	$wp_customize->add_setting('ovation_blog_footer_bg', array(
	    'default' => '#323232',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ovation_blog_footer_bg', array(
	    'section' => 'colors',
	    'label' => esc_html__('Footer Bg color', 'ovation-blog'),
	)));

	$wp_customize->add_setting('ovation_blog_post_bg', array(
	    'default' => '#ffffff',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ovation_blog_post_bg', array(
	    'section' => 'colors',
	    'label' => esc_html__('White bg color', 'ovation-blog'),
	)));

    // typography
	$wp_customize->add_section( 'ovation_blog_typography_settings', array(
		'title'       => __( 'Typography Settings', 'ovation-blog' ),
		'priority'       => 3,
	) );
	$font_choices = array(
		'' => 'Select',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);
	$wp_customize->add_setting( 'ovation_blog_section_typo_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_typo_heading', array(
		'label'       => esc_html__( 'Typography Settings', 'ovation-blog' ),
		'section'     => 'ovation_blog_typography_settings',
		'settings'    => 'ovation_blog_section_typo_heading',
	) ) );
	$wp_customize->add_setting( 'ovation_blog_headings_text', array(
		'sanitize_callback' => 'ovation_blog_sanitize_fonts',
	));
	$wp_customize->add_control( 'ovation_blog_headings_text', array(
		'type' => 'select',
		'description' => __('Select your suitable font for the headings.', 'ovation-blog'),
		'section' => 'ovation_blog_typography_settings',
		'choices' => $font_choices
	));
	$wp_customize->add_setting( 'ovation_blog_body_text', array(
		'sanitize_callback' => 'ovation_blog_sanitize_fonts'
	));
	$wp_customize->add_control( 'ovation_blog_body_text', array(
		'type' => 'select',
		'description' => __( 'Select your suitable font for the body.', 'ovation-blog' ),
		'section' => 'ovation_blog_typography_settings',
		'choices' => $font_choices
	) );

    // Theme General Settings
    $wp_customize->add_section('ovation_blog_theme_settings',array(
        'title' => __('Theme General Settings', 'ovation-blog'),
        'priority' => 3,
    ) );
    $wp_customize->add_setting( 'ovation_blog_section_sticky_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_sticky_heading', array(
		'label'       => esc_html__( 'Sticky header Setting', 'ovation-blog' ),
		'section'     => 'ovation_blog_theme_settings',
		'settings'    => 'ovation_blog_section_sticky_heading',
	) ) );
    $wp_customize->add_setting(
		'ovation_blog_sticky_header',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_sticky_header',
			array(
				'settings'        => 'ovation_blog_sticky_header',
				'section'         => 'ovation_blog_theme_settings',
				'label'           => __( 'Show Sticky Header', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'ovation_blog_section_search_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_search_heading', array(
		'label'       => esc_html__( 'Search Bar Setting', 'ovation-blog' ),		
		'section'     => 'ovation_blog_theme_settings',
		'settings'    => 'ovation_blog_section_search_heading',
	) ) );
	$wp_customize->add_setting(
		'header_search_enable',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'header_search_enable',
			array(
				'settings'        => 'header_search_enable',
				'section'         => 'ovation_blog_theme_settings',
				'label'           => __( 'Check to show search bar', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'ovation_blog_section_site_loader_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_site_loader_heading', array(
		'label'       => esc_html__( 'Loader Setting', 'ovation-blog' ),
		'section'     => 'ovation_blog_theme_settings',
		'settings'    => 'ovation_blog_section_site_loader_heading',
	) ) );
	$wp_customize->add_setting(
		'ovation_blog_theme_loader',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_theme_loader',
			array(
				'settings'        => 'ovation_blog_theme_loader',
				'section'         => 'ovation_blog_theme_settings',
				'label'           => __( 'Show Site Loader', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting('ovation_blog_loader_style',array(
        'default' => 'style_one',
        'sanitize_callback' => 'ovation_blog_sanitize_choices'
	));
	$wp_customize->add_control('ovation_blog_loader_style',array(
        'type' => 'select',
        'label' => __('Select Loader Design','ovation-blog'),
        'section' => 'ovation_blog_theme_settings',
        'choices' => array(
            'style_one' => __('Circle','ovation-blog'),
            'style_two' => __('Bar','ovation-blog'),
        ),
	) );
	
	$wp_customize->add_setting( 'ovation_blog_section_theme_width_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_theme_width_heading', array(
		'label'       => esc_html__( 'Theme Width Settings', 'ovation-blog' ),
		'section'     => 'ovation_blog_theme_settings',
		'settings'    => 'ovation_blog_section_theme_width_heading',
	) ) );
	$wp_customize->add_setting('ovation_blog_width_options',array(
        'default' => 'full_width',
        'sanitize_callback' => 'ovation_blog_sanitize_choices'
	));
	$wp_customize->add_control('ovation_blog_width_options',array(
        'type' => 'select',
        'label' => __('Theme Width Option','ovation-blog'),
        'section' => 'ovation_blog_theme_settings',
        'choices' => array(
            'full_width' => __('fullwidth','ovation-blog'),
            'container' => __('container','ovation-blog'),
            'container_fluid' => __('container fluid','ovation-blog'),
        ),
	) );
	$wp_customize->add_setting( 'ovation_blog_section_menu_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_menu_heading', array(
		'label'       => esc_html__( 'Menu Setting', 'ovation-blog' ),
		'section'     => 'ovation_blog_theme_settings',
		'settings'    => 'ovation_blog_section_menu_heading',
	) ) );
	$wp_customize->add_setting('ovation_blog_menu_text_transform',array(
        'default' => 'CAPITALISE',
        'sanitize_callback' => 'ovation_blog_sanitize_choices'
	));
	$wp_customize->add_control('ovation_blog_menu_text_transform',array(
        'type' => 'select',
        'label' => __('Menus Text Transform','ovation-blog'),
        'section' => 'ovation_blog_theme_settings',
        'choices' => array(
            'CAPITALISE' => __('CAPITALISE','ovation-blog'),
            'UPPERCASE' => __('UPPERCASE','ovation-blog'),
            'LOWERCASE' => __('LOWERCASE','ovation-blog'),
        ),
	) );
	$wp_customize->add_setting( 'ovation_blog_section_scroll_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_scroll_heading', array(
		'label'       => esc_html__( 'Scroll Top Settings', 'ovation-blog' ),
		'section'     => 'ovation_blog_theme_settings',
		'settings'    => 'ovation_blog_section_scroll_heading',
	) ) );
	$wp_customize->add_setting(
		'ovation_blog_scroll_enable',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_scroll_enable',
			array(
				'settings'        => 'ovation_blog_scroll_enable',
				'section'         => 'ovation_blog_theme_settings',
				'label'           => __( 'Show Scroll Top', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('ovation_blog_scroll_options',array(
        'default' => 'right_align',
        'sanitize_callback' => 'ovation_blog_sanitize_choices'
	));
	$wp_customize->add_control('ovation_blog_scroll_options',array(
		'type' => 'radio',
		'label'     => __('Scroll Top Alignment', 'ovation-blog'),
		'section' => 'ovation_blog_theme_settings',
		'type' => 'select',
		'choices' => array(
			'left_align' => __('LEFT','ovation-blog'),
			'center_align' => __('CENTER','ovation-blog'),
			'right_align' => __('RIGHT','ovation-blog'),
		)
	) );
	$wp_customize->add_setting('ovation_blog_scroll_top_icon',array(
		'default'	=> 'fas fa-chevron-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_scroll_top_icon',array(
		'label'	=> __('Add Scroll Top Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_theme_settings',
		'setting'	=> 'ovation_blog_scroll_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'ovation_blog_section_cursor_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_cursor_heading', array(
		'label'       => esc_html__( 'Cursor Setting', 'ovation-blog' ),
		'section'     => 'ovation_blog_theme_settings',
		'settings'    => 'ovation_blog_section_cursor_heading',
	) ) );

	$wp_customize->add_setting(
		'ovation_blog_enable_custom_cursor',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_enable_custom_cursor',
			array(
				'settings'        => 'ovation_blog_enable_custom_cursor',
				'section'         => 'ovation_blog_theme_settings',
				'label'           => __( 'show custom cursor', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting( 'ovation_blog_section_animation_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_animation_heading', array(
		'label'       => esc_html__( 'Animation Setting', 'ovation-blog' ),
		'section'     => 'ovation_blog_theme_settings',
		'settings'    => 'ovation_blog_section_animation_heading',
	) ) );

	$wp_customize->add_setting(
		'ovation_blog_animation_enable',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_animation_enable',
			array(
				'settings'        => 'ovation_blog_animation_enable',
				'section'         => 'ovation_blog_theme_settings',
				'label'           => __( 'show/Hide Animation', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);

	// Post Layouts
	$wp_customize->add_panel( 'ovation_blog_post_panel', array(
		'title' => esc_html__( 'Post Layout', 'ovation-blog' ),
		'priority' => 4,
	));
    $wp_customize->add_section('ovation_blog_layout',array(
        'title' => __('Single-Post Layout', 'ovation-blog'),
        'panel' => 'ovation_blog_post_panel',
    ) );
    $wp_customize->add_setting( 'ovation_blog_section_post_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_post_heading', array(
		'label'       => esc_html__( 'Single Post Structure', 'ovation-blog' ),
		'section'     => 'ovation_blog_layout',
		'settings'    => 'ovation_blog_section_post_heading',
	) ) );
	$wp_customize->add_setting( 'ovation_blog_single_post_option',
		array(
			'default' => 'single_right_sidebar',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Ovation_Blog_Radio_Image_Control( $wp_customize, 'ovation_blog_single_post_option',
		array(
			'type'=>'select',
			'label' => __( 'select Single Post Page Layout', 'ovation-blog' ),
			'section' => 'ovation_blog_layout',
			'choices' => array(

				'single_right_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/2column.jpg',
					'name' => __( 'Right Sidebar', 'ovation-blog' )
				),
				'single_left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/left.png',
					'name' => __( 'Left Sidebar', 'ovation-blog' )
				),
				'single_full_width' => array(
					'image' => get_template_directory_uri().'/assets/images/1column.jpg',
					'name' => __( 'One Column', 'ovation-blog' )
				),
			)
		)
	) );
	$wp_customize->add_setting('ovation_blog_single_post_date',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_single_post_date',
			array(
				'settings'        => 'ovation_blog_single_post_date',
				'section'         => 'ovation_blog_layout',
				'label'           => __( 'Show Date', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'ovation_blog_single_post_date', array(
		'selector' => '.date-box',
		'render_callback' => 'ovation_blog_customize_partial_ovation_blog_single_post_date',
	) );
	$wp_customize->add_setting('ovation_blog_single_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_single_date_icon',array(
		'label'	=> __('date Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_layout',
		'setting'	=> 'ovation_blog_single_date_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_single_post_admin',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_single_post_admin',
			array(
				'settings'        => 'ovation_blog_single_post_admin',
				'section'         => 'ovation_blog_layout',
				'label'           => __( 'Show Author/Admin', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'ovation_blog_single_post_admin', array(
		'selector' => '.entry-author',
		'render_callback' => 'ovation_blog_customize_partial_ovation_blog_single_post_admin',
	) );
	$wp_customize->add_setting('ovation_blog_single_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_single_author_icon',array(
		'label'	=> __('Author Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_layout',
		'setting'	=> 'ovation_blog_single_author_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_single_post_comment',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_single_post_comment',
			array(
				'settings'        => 'ovation_blog_single_post_comment',
				'section'         => 'ovation_blog_layout',
				'label'           => __( 'Show Comment', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('ovation_blog_single_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_single_comment_icon',array(
		'label'	=> __('comment Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_layout',
		'setting'	=> 'ovation_blog_single_comment_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_single_post_tag_count',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_single_post_tag_count',
			array(
				'settings'        => 'ovation_blog_single_post_tag_count',
				'section'         => 'ovation_blog_layout',
				'label'           => __( 'Show tag count', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('ovation_blog_single_tag_icon',array(
		'default'	=> 'fas fa-tags',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_single_tag_icon',array(
		'label'	=> __('tag Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_layout',
		'setting'	=> 'ovation_blog_single_tag_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_single_post_tag',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_single_post_tag',
			array(
				'settings'        => 'ovation_blog_single_post_tag',
				'section'         => 'ovation_blog_layout',
				'label'           => __( 'Show Tags', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'ovation_blog_single_post_tag', array(
		'selector' => '.single-tags',
		'render_callback' => 'ovation_blog_customize_partial_ovation_blog_single_post_tag',
	) );
	$wp_customize->add_setting('ovation_blog_similar_post',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_similar_post',
			array(
				'settings'        => 'ovation_blog_similar_post',
				'section'         => 'ovation_blog_layout',
				'label'           => __( 'Show Similar post', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('ovation_blog_similar_text',array(
		'default' => 'Explore More',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('ovation_blog_similar_text',array(
		'label' => esc_html__('Similar Post Heading','ovation-blog'),
		'section' => 'ovation_blog_layout',
		'setting' => 'ovation_blog_similar_text',
		'type'    => 'text'
	));
	$wp_customize->add_section('ovation_blog_archieve_post_layot',array(
        'title' => __('Archieve-Post Layout', 'ovation-blog'),
        'panel' => 'ovation_blog_post_panel',
    ) );
	$wp_customize->add_setting( 'ovation_blog_section_archive_post_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_archive_post_heading', array(
		'label'       => esc_html__( 'Archieve Post Structure', 'ovation-blog' ),
		'section'     => 'ovation_blog_archieve_post_layot',
		'settings'    => 'ovation_blog_section_archive_post_heading',
	) ) );
    $wp_customize->add_setting( 'ovation_blog_post_option',
		array(
			'default' => 'right_sidebar',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Ovation_Blog_Radio_Image_Control( $wp_customize, 'ovation_blog_post_option',
		array(
			'type'=>'select',
			'label' => __( 'select Post Page Layout', 'ovation-blog' ),
			'section' => 'ovation_blog_archieve_post_layot',
			'choices' => array(
				'right_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/2column.jpg',
					'name' => __( 'Right Sidebar', 'ovation-blog' )
				),
				'left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/left.png',
					'name' => __( 'Left Sidebar', 'ovation-blog' )
				),
				'one_column' => array(
					'image' => get_template_directory_uri().'/assets/images/1column.jpg',
					'name' => __( 'One Column', 'ovation-blog' )
				),
				'three_column' => array(
					'image' => get_template_directory_uri().'/assets/images/3column.jpg',
					'name' => __( 'Three Column', 'ovation-blog' )
				),
				'four_column' => array(
					'image' => get_template_directory_uri().'/assets/images/4column.jpg',
					'name' => __( 'Four Column', 'ovation-blog' )
				),
				'grid_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/grid-sidebar.jpg',
					'name' => __( 'Grid-Right-Sidebar Layout', 'ovation-blog' )
				),
				'grid_left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/grid-left.png',
					'name' => __( 'Grid-Left-Sidebar Layout', 'ovation-blog' )
				),
				'grid_post' => array(
					'image' => get_template_directory_uri().'/assets/images/grid.jpg',
					'name' => __( 'Grid Layout', 'ovation-blog' )
				)
			)
		)
	) );
	$wp_customize->add_setting('ovation_blog_grid_column',array(
        'default' => '3_column',
        'sanitize_callback' => 'ovation_blog_sanitize_choices'
	));
	$wp_customize->add_control('ovation_blog_grid_column',array(
		'type' => 'radio',
		'label'     => __('Grid Post Per Row', 'ovation-blog'),
		'section' => 'ovation_blog_archieve_post_layot',
		'type' => 'select',
		'choices' => array(
			'1_column' => __('1','ovation-blog'),
            '2_column' => __('2','ovation-blog'),
            '3_column' => __('3','ovation-blog'),
            '4_column' => __('4','ovation-blog'),
		)
	) );
	$wp_customize->add_setting('archieve_post_order', array(
        'default' => array('title', 'image', 'meta','excerpt','btn'),
        'sanitize_callback' => 'ovation_blog_sanitize_sortable',
    ));
    $wp_customize->add_control(new Ovation_Blog_Control_Sortable($wp_customize, 'archieve_post_order', array(
    	'label' => esc_html__('Post Order', 'ovation-blog'),
        'description' => __('Drag & Drop post items to re-arrange the order and also hide and show items as per the need by clicking on the eye icon.', 'ovation-blog') ,
        'section' => 'ovation_blog_archieve_post_layot',
        'choices' => array(
            'title' => __('title', 'ovation-blog') ,
            'image' => __('media', 'ovation-blog') ,
            'meta' => __('meta', 'ovation-blog') ,
            'excerpt' => __('excerpt', 'ovation-blog') ,
            'btn' => __('Read more', 'ovation-blog') ,
        ) ,
    )));
	$wp_customize->add_setting('ovation_blog_post_excerpt',array(
		'default'=> 30,
		'transport' => 'refresh',
		'sanitize_callback' => 'ovation_blog_sanitize_integer'
	));
	$wp_customize->add_control(new Ovation_Blog_Slider_Custom_Control( $wp_customize, 'ovation_blog_post_excerpt',array(
		'label' => esc_html__( 'Excerpt Limit','ovation-blog' ),
		'section'=> 'ovation_blog_archieve_post_layot',
		'settings'=>'ovation_blog_post_excerpt',
		'input_attrs' => array(
			'reset'			   => 30,
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));
	$wp_customize->add_setting('ovation_blog_read_more_text',array(
		'default' => 'Read More',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('ovation_blog_read_more_text',array(
		'label' => esc_html__('Read More Text','ovation-blog'),
		'section' => 'ovation_blog_archieve_post_layot',
		'setting' => 'ovation_blog_read_more_text',
		'type'    => 'text'
	));
	$wp_customize->add_setting('ovation_blog_date',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_date',
			array(
				'settings'        => 'ovation_blog_date',
				'section'         => 'ovation_blog_archieve_post_layot',
				'label'           => __( 'Show Date', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'ovation_blog_date', array(
		'selector' => '.date-box',
		'render_callback' => 'ovation_blog_customize_partial_ovation_blog_date',
	) );
	$wp_customize->add_setting('ovation_blog_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_date_icon',array(
		'label'	=> __('date Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_archieve_post_layot',
		'setting'	=> 'ovation_blog_date_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_sticky_icon',array(
		'default'	=> 'fas fa-thumb-tack',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_sticky_icon',array(
		'label'	=> __('Sticky Post Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_archieve_post_layot',
		'setting'	=> 'ovation_blog_sticky_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_admin',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_admin',
			array(
				'settings'        => 'ovation_blog_admin',
				'section'         => 'ovation_blog_archieve_post_layot',
				'label'           => __( 'Show Author/Admin', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'ovation_blog_admin', array(
		'selector' => '.entry-author',
		'render_callback' => 'ovation_blog_customize_partial_ovation_blog_admin',
	) );
	$wp_customize->add_setting('ovation_blog_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_author_icon',array(
		'label'	=> __('Author Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_archieve_post_layot',
		'setting'	=> 'ovation_blog_author_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_comment',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_comment',
			array(
				'settings'        => 'ovation_blog_comment',
				'section'         => 'ovation_blog_archieve_post_layot',
				'label'           => __( 'Show Comment', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'ovation_blog_comment', array(
		'selector' => '.entry-comments',
		'render_callback' => 'ovation_blog_customize_partial_ovation_blog_comment',
	) );
	$wp_customize->add_setting('ovation_blog_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_comment_icon',array(
		'label'	=> __('comment Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_archieve_post_layot',
		'setting'	=> 'ovation_blog_comment_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_tag',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_tag',
			array(
				'settings'        => 'ovation_blog_tag',
				'section'         => 'ovation_blog_archieve_post_layot',
				'label'           => __( 'Show tag count', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'ovation_blog_tag', array(
		'selector' => '.tags',
		'render_callback' => 'ovation_blog_customize_partial_ovation_blog_tag',
	) );
	$wp_customize->add_setting('ovation_blog_tag_icon',array(
		'default'	=> 'fas fa-tags',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_tag_icon',array(
		'label'	=> __('tag Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_archieve_post_layot',
		'setting'	=> 'ovation_blog_tag_icon',
		'type'		=> 'icon'
	)));

	// header-image
	$wp_customize->add_setting( 'ovation_blog_section_header_image_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_header_image_heading', array(
		'label'       => esc_html__( 'Header Image Settings', 'ovation-blog' ),
		'section'     => 'header_image',
		'settings'    => 'ovation_blog_section_header_image_heading',
		'priority'    =>'1',
	) ) );

	$wp_customize->add_setting('ovation_blog_show_header_image',array(
        'default' => 'on',
        'sanitize_callback' => 'ovation_blog_sanitize_choices'
	));
	$wp_customize->add_control('ovation_blog_show_header_image',array(
        'type' => 'select',
        'label' => __('Select Option','ovation-blog'),
        'section' => 'header_image',
        'choices' => array(
            'on' => __('With Header Image','ovation-blog'),
            'off' => __('Without Header Image','ovation-blog'),
        ),
	) );

	// breadcrumb
	$wp_customize->add_section('ovation_blog_breadcrumb_settings',array(
        'title' => __('Breadcrumb Settings', 'ovation-blog'),
        'priority' => 4
    ) );
	$wp_customize->add_setting( 'ovation_blog_section_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_breadcrumb_heading', array(
		'label'       => esc_html__( ' theme Breadcrumb Settings', 'ovation-blog' ),
		'section'     => 'ovation_blog_breadcrumb_settings',
		'settings'    => 'ovation_blog_section_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'ovation_blog_enable_breadcrumb',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_enable_breadcrumb',
			array(
				'settings'        => 'ovation_blog_enable_breadcrumb',
				'section'         => 'ovation_blog_breadcrumb_settings',
				'label'           => __( 'Show Breadcrumb', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);	
	$wp_customize->add_setting('ovation_blog_breadcrumb_separator', array(
        'default' => ' / ',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('ovation_blog_breadcrumb_separator', array(
        'label' => __('Breadcrumb Separator', 'ovation-blog'),
        'section' => 'ovation_blog_breadcrumb_settings',
        'type' => 'text',
    ));
	$wp_customize->add_setting( 'ovation_blog_single_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_single_breadcrumb_heading', array(
		'label'       => esc_html__( 'Single post & Page', 'ovation-blog' ),
		'section'     => 'ovation_blog_breadcrumb_settings',
		'settings'    => 'ovation_blog_single_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'ovation_blog_single_enable_breadcrumb',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_single_enable_breadcrumb',
			array(
				'settings'        => 'ovation_blog_single_enable_breadcrumb',
				'section'         => 'ovation_blog_breadcrumb_settings',
				'label'           => __( 'Show Breadcrumb', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	if ( class_exists( 'WooCommerce' ) ) { 
		$wp_customize->add_setting( 'ovation_blog_woocommerce_breadcrumb_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_woocommerce_breadcrumb_heading', array(
			'label'       => esc_html__( 'Woocommerce Breadcrumb', 'ovation-blog' ),
			'section'     => 'ovation_blog_breadcrumb_settings',
			'settings'    => 'ovation_blog_woocommerce_breadcrumb_heading',
		) ) );
		$wp_customize->add_setting(
			'ovation_blog_woocommerce_enable_breadcrumb',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(
			new Ovation_Blog_Customizer_Customcontrol_Switch(
				$wp_customize,
				'ovation_blog_woocommerce_enable_breadcrumb',
				array(
					'settings'        => 'ovation_blog_woocommerce_enable_breadcrumb',
					'section'         => 'ovation_blog_breadcrumb_settings',
					'label'           => __( 'Show Breadcrumb', 'ovation-blog' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'ovation-blog' ),
						'off'    => __( 'Off', 'ovation-blog' ),
					),
					'active_callback' => '',
				)
			)
		);
		$wp_customize->add_setting('woocommerce_breadcrumb_separator', array(
	        'default' => ' / ',
	        'sanitize_callback' => 'sanitize_text_field',
	    ));
	    $wp_customize->add_control('woocommerce_breadcrumb_separator', array(
	        'label' => __('Breadcrumb Separator', 'ovation-blog'),
	        'section' => 'ovation_blog_breadcrumb_settings',
	        'type' => 'text',
	    ));
	}

	// woocommerce
	if ( class_exists( 'WooCommerce' ) ) { 
		$wp_customize->add_section('ovation_blog_woocoomerce_section',array(
	        'title' => __('Custom Woocommerce Settings', 'ovation-blog'),
	        'panel' => 'woocommerce',
	        'priority' => 4,
	    ) );
		$wp_customize->add_setting( 'ovation_blog_section_shoppage_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_shoppage_heading', array(
			'label'       => esc_html__( 'Sidebar Settings', 'ovation-blog' ),
			'section'     => 'ovation_blog_woocoomerce_section',
			'settings'    => 'ovation_blog_section_shoppage_heading',
		) ) );
		$wp_customize->add_setting( 'ovation_blog_shop_page_sidebar',
			array(
				'default' => 'right_sidebar',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control( new Ovation_Blog_Radio_Image_Control( $wp_customize, 'ovation_blog_shop_page_sidebar',
			array(
				'type'=>'select',
				'label' => __( 'Show Shop Page Sidebar', 'ovation-blog' ),
				'section'     => 'ovation_blog_woocoomerce_section',
				'choices' => array(

					'right_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/2column.jpg',
						'name' => __( 'Right Sidebar', 'ovation-blog' )
					),
					'left_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/left.png',
						'name' => __( 'Left Sidebar', 'ovation-blog' )
					),
					'full_width' => array(
						'image' => get_template_directory_uri().'/assets/images/1column.jpg',
						'name' => __( 'Full Width', 'ovation-blog' )
					),
				)
			)
		) );
		$wp_customize->add_setting( 'ovation_blog_wocommerce_single_page_sidebar',
			array(
				'default' => 'right_sidebar',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control( new Ovation_Blog_Radio_Image_Control( $wp_customize, 'ovation_blog_wocommerce_single_page_sidebar',
			array(
				'type'=>'select',
				'label'           => __( 'Show Single Product Page Sidebar', 'ovation-blog' ),
				'section'     => 'ovation_blog_woocoomerce_section',
				'choices' => array(

					'right_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/2column.jpg',
						'name' => __( 'Right Sidebar', 'ovation-blog' )
					),
					'left_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/left.png',
						'name' => __( 'Left Sidebar', 'ovation-blog' )
					),
					'full_width' => array(
						'image' => get_template_directory_uri().'/assets/images/1column.jpg',
						'name' => __( 'Full Width', 'ovation-blog' )
					),
				)
			)
		) );
		$wp_customize->add_setting( 'ovation_blog_section_archieve_product_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_archieve_product_heading', array(
			'label'       => esc_html__( 'Archieve Product Settings', 'ovation-blog' ),
			'section'     => 'ovation_blog_woocoomerce_section',
			'settings'    => 'ovation_blog_section_archieve_product_heading',
		) ) );
		$wp_customize->add_setting('ovation_blog_archieve_item_columns',array(
	        'default' => '3',
	        'sanitize_callback' => 'ovation_blog_sanitize_choices'
		));
		$wp_customize->add_control('ovation_blog_archieve_item_columns',array(
	        'type' => 'select',
	        'label' => __('Select No of Columns','ovation-blog'),
	        'section' => 'ovation_blog_woocoomerce_section',
	        'choices' => array(
	            '1' => __('One Column','ovation-blog'),
	            '2' => __('Two Column','ovation-blog'),
	            '3' => __('Three Column','ovation-blog'),
	            '4' => __('four Column','ovation-blog'),
	            '5' => __('Five Column','ovation-blog'),
	            '6' => __('Six Column','ovation-blog'),
	        ),
		) );
		$wp_customize->add_setting( 'ovation_blog_archieve_shop_perpage', array(
			'default'              => 6,
			'type'                 => 'theme_mod',
			'transport' 		   => 'refresh',
			'sanitize_callback'    => 'ovation_blog_sanitize_number_absint',
			'sanitize_js_callback' => 'absint',
		) );
		$wp_customize->add_control( 'ovation_blog_archieve_shop_perpage', array(
			'label'       => esc_html__( 'Display Products','ovation-blog' ),
			'section'     => 'ovation_blog_woocoomerce_section',
			'type'        => 'number',
			'input_attrs' => array(
				'step'             => 1,
				'min'              => 0,
				'max'              => 30,
			),
		) );
		$wp_customize->add_setting( 'ovation_blog_section_related_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_related_heading', array(
			'label'       => esc_html__( 'Related Product Settings', 'ovation-blog' ),
			'section'     => 'ovation_blog_woocoomerce_section',
			'settings'    => 'ovation_blog_section_related_heading',
		) ) );
		$wp_customize->add_setting('ovation_blog_related_item_columns',array(
	        'default' => '3',
	        'sanitize_callback' => 'ovation_blog_sanitize_choices'
		));
		$wp_customize->add_control('ovation_blog_related_item_columns',array(
	        'type' => 'select',
	        'label' => __('Select No of Columns','ovation-blog'),
	        'section' => 'ovation_blog_woocoomerce_section',
	        'choices' => array(
	            '1' => __('One Column','ovation-blog'),
	            '2' => __('Two Column','ovation-blog'),
	            '3' => __('Three Column','ovation-blog'),
	            '4' => __('four Column','ovation-blog'),
	            '5' => __('Five Column','ovation-blog'),
	            '6' => __('Six Column','ovation-blog'),
	        ),
		) );
		$wp_customize->add_setting( 'ovation_blog_related_shop_perpage', array(
			'default'              => 3,
			'type'                 => 'theme_mod',
			'transport' 		   => 'refresh',
			'sanitize_callback'    => 'ovation_blog_sanitize_number_absint',
			'sanitize_js_callback' => 'absint',
		) );
		$wp_customize->add_control( 'ovation_blog_related_shop_perpage', array(
			'label'       => esc_html__( 'Display Products','ovation-blog' ),
			'section'     => 'ovation_blog_woocoomerce_section',
			'type'        => 'number',
			'input_attrs' => array(
				'step'             => 1,
				'min'              => 0,
				'max'              => 10,
			),
		) );
		$wp_customize->add_setting(
			'ovation_blog_related_product',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(new Ovation_Blog_Customizer_Customcontrol_Switch($wp_customize,'ovation_blog_related_product',
			array(
				'settings'        => 'ovation_blog_related_product',
				'section'         => 'ovation_blog_woocoomerce_section',
				'label'           => __( 'Show Related Products', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		));
	}

	// mobile width
	$wp_customize->add_section('ovation_blog_mobile_options',array(
        'title' => __('Mobile Media settings', 'ovation-blog'),
        'priority' => 4,
    ) );
    $wp_customize->add_setting( 'ovation_blog_section_mobile_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_mobile_heading', array(
		'label'       => esc_html__( 'Mobile Media settings', 'ovation-blog' ),
		'section'     => 'ovation_blog_mobile_options',
		'settings'    => 'ovation_blog_section_mobile_heading',
		'priority' => 1,
	) ) );
	$wp_customize->add_setting(
		'ovation_blog_scroll_enable_mobile',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_scroll_enable_mobile',
			array(
				'settings'        => 'ovation_blog_scroll_enable_mobile',
				'section'         => 'ovation_blog_mobile_options',
				'label'           => __( 'Show Scroll Top', 'ovation-blog' ),
				'description' => __('Control wont function if scroll-top is off in the main settings.', 'ovation-blog') ,					
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'ovation_blog_section_mobile_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_mobile_breadcrumb_heading', array(
		'label'       => esc_html__( 'Mobile Breadcrumb settings', 'ovation-blog' ),
		'description' => __('Controls wont function if the breadcrumb is off in the main breadcrumb settings.', 'ovation-blog') ,
		'section'     => 'ovation_blog_mobile_options',
		'settings'    => 'ovation_blog_section_mobile_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'ovation_blog_enable_breadcrumb_mobile',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_enable_breadcrumb_mobile',
			array(
				'settings'        => 'ovation_blog_enable_breadcrumb_mobile',
				'section'         => 'ovation_blog_mobile_options',
				'label'           => __( 'Theme Breadcrumb', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting(
		'ovation_blog_single_enable_breadcrumb_mobile',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Ovation_Blog_Customizer_Customcontrol_Switch(
			$wp_customize,
			'ovation_blog_single_enable_breadcrumb_mobile',
			array(
				'settings'        => 'ovation_blog_single_enable_breadcrumb_mobile',
				'section'         => 'ovation_blog_mobile_options',
				'label'           => __( 'Single Post & Page', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_setting(
			'ovation_blog_woocommerce_enable_breadcrumb_mobile',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'ovation_blog_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(
			new Ovation_Blog_Customizer_Customcontrol_Switch(
				$wp_customize,
				'ovation_blog_woocommerce_enable_breadcrumb_mobile',
				array(
					'settings'        => 'ovation_blog_woocommerce_enable_breadcrumb_mobile',
					'section'         => 'ovation_blog_mobile_options',
					'label'           => __( 'wooCommerce Breadcrumb', 'ovation-blog' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'ovation-blog' ),
						'off'    => __( 'Off', 'ovation-blog' ),
					),
					'active_callback' => '',
				)
			)
		);
	}

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'ovation_blog_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'ovation_blog_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'ovation_blog_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'ovation_blog_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'ovation-blog' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'ovation-blog' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'ovation_blog_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'ovation_blog_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'ovation_blog_customize_register' );

function ovation_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

function ovation_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function ovation_blog_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function ovation_blog_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

define('OVATION_BLOG_PRO_LINK',__('https://www.ovationthemes.com/products/blog-wordpress-theme','ovation-blog'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Ovation_Blog_Pro_Control')):
    class Ovation_Blog_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
	        <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( OVATION_BLOG_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE BLOG PREMIUM','ovation-blog');?> </a>
	        </div>
            <div class="col-md">
                <img class="ovation_blog_img_responsive " src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png">
            </div>
	        <div class="col-md">
	            <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('BLOG PREMIUM - Features', 'ovation-blog'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'ovation-blog');?> </li>
                    <li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'ovation-blog');?> </li>
                   	<li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'ovation-blog');?> </li>
                   	<li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'ovation-blog');?> </li>
                   	<li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'ovation-blog');?> </li>
                   	<li class="upsell-ovation_blog"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'ovation-blog');?> </li>
                </ul>
        	</div>
		    <div class="col-md upsell-btn upsell-btn-bottom">
	            <a href="<?php echo esc_url( OVATION_BLOG_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE BLOG PREMIUM','ovation-blog');?> </a>
		    </div>
        </label>
    <?php } }
endif;
