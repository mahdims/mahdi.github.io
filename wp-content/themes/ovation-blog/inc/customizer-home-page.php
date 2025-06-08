<?php
/**
 * Ovation Blog: Customizer-home-page
 *
 * @subpackage Ovation Blog
 * @since 1.0
 */

	//  Home Page Panel
	$wp_customize->add_panel( 'ovation_blog_custompage_panel', array(
		'title' => esc_html__( 'Custom Page Settings', 'ovation-blog' ),
		'priority' => 2,
	));
	// Social Media
    $wp_customize->add_section('ovation_blog_urls',array(
        'title' => __('Social Media', 'ovation-blog'),
        'priority' => 3,
        'panel' => 'ovation_blog_custompage_panel',
    ) );
    $wp_customize->add_setting( 'ovation_blog_section_social_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_social_heading', array(
		'label'       => esc_html__( 'Social Media Settings', 'ovation-blog' ),
		'description' => __( 'Add social media links in the below feilds', 'ovation-blog' ),			
		'section'     => 'ovation_blog_urls',
		'settings'    => 'ovation_blog_section_social_heading',
	) ) );
	$wp_customize->add_setting(
		'header_social_icon_enable',
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
			'header_social_icon_enable',
			array(
				'settings'        => 'header_social_icon_enable',
				'section'         => 'ovation_blog_urls',
				'label'           => __( 'Check to show social fields', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'ovation_blog_section_twitter_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_twitter_heading', array(
		'label'       => esc_html__( 'Twitter Settings', 'ovation-blog' ),			
		'section'     => 'ovation_blog_urls',
		'settings'    => 'ovation_blog_section_twitter_heading',
	) ) );
   	$wp_customize->add_setting('ovation_blog_twitter_icon',array(
		'default'	=> 'fab fa-x-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_twitter_icon',array(
		'label'	=> __('Add Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_urls',
		'setting'	=> 'ovation_blog_twitter_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_twitter',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('ovation_blog_twitter',array(
		'label' => esc_html__('Add URL','ovation-blog'),
		'section' => 'ovation_blog_urls',
		'setting' => 'ovation_blog_twitter',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'ovation_blog_header_twt_target',
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
			'ovation_blog_header_twt_target',
			array(
				'settings'        => 'ovation_blog_header_twt_target',
				'section'         => 'ovation_blog_urls',
				'label'           => __( 'Open link in a new tab', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'ovation_blog_section_linkedin_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_linkedin_heading', array(
		'label'       => esc_html__( 'Linkedin Settings', 'ovation-blog' ),			
		'section'     => 'ovation_blog_urls',
		'settings'    => 'ovation_blog_section_linkedin_heading',
	) ) );
	$wp_customize->add_setting('ovation_blog_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_linkedin_icon',array(
		'label'	=> __('Add Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_urls',
		'setting'	=> 'ovation_blog_linkedin_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_linkedin',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('ovation_blog_linkedin',array(
		'label' => esc_html__('Add URL','ovation-blog'),
		'section' => 'ovation_blog_urls',
		'setting' => 'ovation_blog_linkedin',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'ovation_blog_header_linkedin_target',
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
			'ovation_blog_header_linkedin_target',
			array(
				'settings'        => 'ovation_blog_header_linkedin_target',
				'section'         => 'ovation_blog_urls',
				'label'           => __( 'Open link in a new tab', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'ovation_blog_section_youtube_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_youtube_heading', array(
		'label'       => esc_html__( 'Youtube Settings', 'ovation-blog' ),			
		'section'     => 'ovation_blog_urls',
		'settings'    => 'ovation_blog_section_youtube_heading',
	) ) );
	$wp_customize->add_setting('ovation_blog_youtube_icon',array(
		'default'	=> 'fab fa-youtube',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_youtube_icon',array(
		'label'	=> __('Add Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_urls',
		'setting'	=> 'ovation_blog_youtube_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_youtube',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('ovation_blog_youtube',array(
		'label' => esc_html__('Add URL','ovation-blog'),
		'section' => 'ovation_blog_urls',
		'setting' => 'ovation_blog_youtube',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'ovation_blog_header_youtube_target',
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
			'ovation_blog_header_youtube_target',
			array(
				'settings'        => 'ovation_blog_header_youtube_target',
				'section'         => 'ovation_blog_urls',
				'label'           => __( 'Open link in a new tab', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'ovation_blog_section_instagram_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_instagram_heading', array(
		'label'       => esc_html__( 'Instagram Settings', 'ovation-blog' ),			
		'section'     => 'ovation_blog_urls',
		'settings'    => 'ovation_blog_section_instagram_heading',
	) ) );
	$wp_customize->add_setting('ovation_blog_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Ovation_Blog_Fontawesome_Icon_Chooser(
        $wp_customize,'ovation_blog_instagram_icon',array(
		'label'	=> __('Add Icon','ovation-blog'),
		'transport' => 'refresh',
		'section'	=> 'ovation_blog_urls',
		'setting'	=> 'ovation_blog_instagram_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('ovation_blog_instagram',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('ovation_blog_instagram',array(
		'label' => esc_html__('Add URL','ovation-blog'),
		'section' => 'ovation_blog_urls',
		'setting' => 'ovation_blog_instagram',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'ovation_blog_header_instagram_target',
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
			'ovation_blog_header_instagram_target',
			array(
				'settings'        => 'ovation_blog_header_instagram_target',
				'section'         => 'ovation_blog_urls',
				'label'           => __( 'Open link in a new tab', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);

    //Slider
	$wp_customize->add_section( 'ovation_blog_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'ovation-blog' ),
		'priority'   => 4,
		'panel' => 'ovation_blog_custompage_panel',
	) );
	$wp_customize->add_setting( 'ovation_blog_section_slide_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_slide_heading', array(
		'label'       => esc_html__( 'Slider Settings', 'ovation-blog' ),
		'description' => __( 'Slider Image Dimension ( 600px x 700px )', 'ovation-blog' ),
		'section'     => 'ovation_blog_slider_section',
		'settings'    => 'ovation_blog_section_slide_heading',
		'priority'   => 1,
	) ) );

	$wp_customize->add_setting('ovation_blog_slider_count',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ovation_blog_slider_count',array(
		'label'	=> esc_html__('Slider Count','ovation-blog'),
		'section'	=> 'ovation_blog_slider_section',
		'description' => __( 'After increasing/decreasing counter refresh site for changes to be applied.', 'ovation-blog' ),
		'type'		=> 'number',
		'priority'    =>1,
	));

	$ovation_blog_slider_count = get_theme_mod('ovation_blog_slider_count');

	// $post_list = get_posts();
	$ovation_blog_args = array('numberposts' => -1);
	$post_list = get_posts($ovation_blog_args);
	$i = 0;
	$pst_sls[]= __('Select','ovation-blog');
	foreach ($post_list as $key => $p_post) {
		$pst_sls[$p_post->ID]=$p_post->post_title;
	}
	for ( $s = 1; $s <= $ovation_blog_slider_count; $s++ ) {
		$wp_customize->add_setting('ovation_blog_post_setting'.$s,array(
			'sanitize_callback' => 'ovation_blog_sanitize_choices',
		));
		$wp_customize->add_control('ovation_blog_post_setting'.$s,array(
			'type'    => 'select',
			'choices' => $pst_sls,
			'label' => __('Select post','ovation-blog'),
			'section' => 'ovation_blog_slider_section',
			'priority' => 2,
		));
		$wp_customize->selective_refresh->add_partial( 'ovation_blog_post_setting'.$s, array(
			'selector' => '#slider .inner_carousel h2',
			'render_callback' => 'ovation_blog_customize_partial_ovation_blog_post_setting'.$s,
		) );
	}

	wp_reset_postdata();

	$wp_customize->add_setting('ovation_blog_slider_opacity',array(
        'default' => '0.7',
        'sanitize_callback' => 'ovation_blog_sanitize_choices'
	));
	$wp_customize->add_control('ovation_blog_slider_opacity',array(
		'type' => 'radio',
		'label'     => __('Slider Opacity', 'ovation-blog'),
		'section' => 'ovation_blog_slider_section',
		'type' => 'select',
		'choices' => array(
			'0' => __('0','ovation-blog'),
			'0.1' => __('0.1','ovation-blog'),
			'0.2' => __('0.2','ovation-blog'),
			'0.3' => __('0.3','ovation-blog'),
			'0.4' => __('0.4','ovation-blog'),
			'0.5' => __('0.5','ovation-blog'),
			'0.6' => __('0.6','ovation-blog'),
			'0.7' => __('0.7','ovation-blog'),
			'0.8' => __('0.8','ovation-blog'),
			'0.9' => __('0.9','ovation-blog'),
			'1' => __('1','ovation-blog')
		),
	) );

	// Popular Post
	$wp_customize->add_section('ovation_blog_post',array(
		'title' => esc_html__('Popular Post','ovation-blog'),
		'priority' => 5,
		'panel' => 'ovation_blog_custompage_panel',
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= __('Select','ovation-blog');
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}
	$wp_customize->add_setting( 'ovation_blog_section_popular_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_popular_heading', array(
		'label'       => esc_html__( 'Popular Post Setting', 'ovation-blog' ),
		'description' => __( 'Image Dimension ( 270 x 295 ) px', 'ovation-blog' ),		
		'section'     => 'ovation_blog_post',
		'settings'    => 'ovation_blog_section_popular_heading',
	) ) );
	$wp_customize->add_setting('ovation_blog_post_category_setting',array(
		'default' => 0,
		'sanitize_callback' => 'ovation_blog_sanitize_select',
	));
	$wp_customize->add_control('ovation_blog_post_category_setting',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => esc_html__('Select Category to display Post','ovation-blog'),
		'section' => 'ovation_blog_post',
	));

	$wp_customize->add_setting('ovation_blog_post_cat_count',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ovation_blog_post_cat_count',array(
		'label'	=> esc_html__('Post Count','ovation-blog'),
		'section'	=> 'ovation_blog_post',
		'type'		=> 'number',
	));

	$wp_customize->add_setting('ovation_blog_front_date',
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
			'ovation_blog_front_date',
			array(
				'settings'        => 'ovation_blog_front_date',
				'section'         => 'ovation_blog_post',
				'label'           => __( 'Show Date', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('ovation_blog_front_admin',
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
			'ovation_blog_front_admin',
			array(
				'settings'        => 'ovation_blog_front_admin',
				'section'         => 'ovation_blog_post',
				'label'           => __( 'Show Author/Admin', 'ovation-blog' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'ovation-blog' ),
					'off'    => __( 'Off', 'ovation-blog' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'ovation_blog_post_category_setting', array(
		'selector' => '#our-post h4',
		'render_callback' => 'ovation_blog_customize_partial_ovation_blog_post_category_setting',
	) );

	// Top Categories
	$wp_customize->add_section('ovation_blog_top_category',array(
		'title' => esc_html__('Top Categories','ovation-blog'),
		'priority' => 6,
		'panel' => 'ovation_blog_custompage_panel',
	));
	$wp_customize->add_setting( 'ovation_blog_section_top_categories_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_top_categories_heading', array(
		'label'       => esc_html__( 'Top Categories Settings', 'ovation-blog' ),
		'description' => __( 'Image Dimension ( 410 x 260 ) px', 'ovation-blog' ),		
		'section'     => 'ovation_blog_top_category',
		'settings'    => 'ovation_blog_section_top_categories_heading',
		'priority' => 1,
	) ) );
	$wp_customize->add_setting(
        'ovation_blog_top_category_show_hide',
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
            'ovation_blog_top_category_show_hide',
            array(
                'settings'        => 'ovation_blog_top_category_show_hide',
                'section'         => 'ovation_blog_top_category',
                'label'           => __( 'Check To Show Section', 'ovation-blog' ),                
                'choices'         => array(
                    '1'      => __( 'On', 'ovation-blog' ),
                    'off'    => __( 'Off', 'ovation-blog' ),
                ),
                'priority' => 1,
                'active_callback' => '',
            )
        )
    );
	$wp_customize->add_setting('ovation_blog_top_category_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ovation_blog_top_category_text',array(
		'label' => esc_html__('Heading Text','ovation-blog'),
		'section' => 'ovation_blog_top_category',
		'setting' => 'ovation_blog_top_category_text',
		'type'    => 'text',
	));
	$wp_customize->add_setting('ovation_blog_top_category_heading',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ovation_blog_top_category_heading',array(
		'label' => esc_html__('Heading','ovation-blog'),
		'section' => 'ovation_blog_top_category',
		'setting' => 'ovation_blog_top_category_heading',
		'type'    => 'text',
	));
	$wp_customize->selective_refresh->add_partial( 'ovation_blog_top_category_heading', array(
		'selector' => '#top-cat h3',
		'render_callback' => 'ovation_blog_customize_partial_ovation_blog_top_category_heading',
	) );

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= __('Select','ovation-blog');
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('ovation_blog_top_category_setting',array(
		'default' => 0,
		'sanitize_callback' => 'ovation_blog_sanitize_select',
	));
	$wp_customize->add_control('ovation_blog_top_category_setting',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => esc_html__('Select Category to display Post','ovation-blog'),
		'section' => 'ovation_blog_top_category',
	));

	$wp_customize->add_setting('ovation_blog_top_post_count',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ovation_blog_top_post_count',array(
		'label'	=> esc_html__('Post Count','ovation-blog'),
		'section'	=> 'ovation_blog_top_category',
		'type'		=> 'number',
	));

	//Footer
    $wp_customize->add_section( 'ovation_blog_footer_copyright', array(
    	'title'      => esc_html__( 'Footer Text', 'ovation-blog' ),
    	'priority' => 8,
    	'panel' => 'ovation_blog_custompage_panel',
	) );
	$wp_customize->add_setting( 'ovation_blog_section_footer_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Ovation_Blog_Customizer_Customcontrol_Section_Heading( $wp_customize, 'ovation_blog_section_footer_heading', array(
		'label'       => esc_html__( 'Footer Settings', 'ovation-blog' ),		
		'section'     => 'ovation_blog_footer_copyright',
		'settings'    => 'ovation_blog_section_footer_heading',
		'priority' => 1,
	) ) );
    $wp_customize->add_setting('ovation_blog_footer_text',array(
		'default'	=> 'Blog WordPress Theme',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ovation_blog_footer_text',array(
		'label'	=> esc_html__('Copyright Text','ovation-blog'),
		'section'	=> 'ovation_blog_footer_copyright',
		'type'		=> 'textarea'
	));
	$wp_customize->add_setting('ovation_blog_footer_content_alignment',array(
        'default' => 'CENTER-ALIGN',
        'sanitize_callback' => 'ovation_blog_sanitize_choices'
	));
	$wp_customize->add_control('ovation_blog_footer_content_alignment',array(
		'type' => 'radio',
		'label'     => __('Footer Content Alignment', 'ovation-blog'),
		'section' => 'ovation_blog_footer_copyright',
		'type' => 'select',
		'choices' => array(
			'LEFT-ALIGN' => __('LEFT','ovation-blog'),
            'CENTER-ALIGN' => __('CENTER','ovation-blog'),
            'RIGHT-ALIGN' => __('RIGHT','ovation-blog'),
		),
	) );

	$wp_customize->add_setting('ovation_blog_footer_widget',array(
        'default' => '4',
        'sanitize_callback' => 'ovation_blog_sanitize_choices'
	));
	$wp_customize->add_control('ovation_blog_footer_widget',array(
		'type' => 'radio',
		'label'     => __('Footer Per Column', 'ovation-blog'),
		'section' => 'ovation_blog_footer_copyright',
		'type' => 'select',
		'choices' => array(
			'1' => __('1','ovation-blog'),
            '2' => __('2','ovation-blog'),
            '3' => __('3','ovation-blog'),
            '4' => __('4','ovation-blog'),
		)
	) );