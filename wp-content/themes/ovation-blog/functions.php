<?php
/**
 * Ovation Blog functions and definitions
 *
 * @subpackage Ovation Blog
 * @since 1.0
 */

//woocommerce//
//shop page no of columns
function ovation_blog_woocommerce_loop_columns() {
	
	$retrun = get_theme_mod( 'ovation_blog_archieve_item_columns', 3 );
    
    return $retrun;
}
add_filter( 'loop_shop_columns', 'ovation_blog_woocommerce_loop_columns' );
function ovation_blog_woocommerce_products_per_page() {

		$retrun = get_theme_mod( 'ovation_blog_archieve_shop_perpage', 6 );
    
    return $retrun;
}
add_filter( 'loop_shop_per_page', 'ovation_blog_woocommerce_products_per_page' );
// related products
function ovation_blog_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => get_theme_mod( 'ovation_blog_related_shop_perpage', 3 ),
        'columns'        => get_theme_mod( 'ovation_blog_related_item_columns', 3),
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'ovation_blog_related_products_args' );

// breadcrumb seperator
function ovation_blog_woocommerce_breadcrumb_separator($ovation_blog_defaults) {
    $ovation_blog_separator = get_theme_mod('woocommerce_breadcrumb_separator', ' / ');

    // Update the separator
    $ovation_blog_defaults['delimiter'] = $ovation_blog_separator;

    return $ovation_blog_defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'ovation_blog_woocommerce_breadcrumb_separator');

//add animation class
if ( class_exists( 'WooCommerce' ) ) { 
	add_filter('post_class', function($ovation_blog_classes, $class, $product_id) {
	    if( is_shop() || is_product_category() ){
	        
	        $ovation_blog_classes = array_merge(['wow','zoomIn'], $ovation_blog_classes);
	    }
	    return $ovation_blog_classes;
	},10,3);
}
//woocommerce-end//

// Get start function

// Enqueue scripts and styles
function ovation_blog_enqueue_admin_script($hook) {
    // Admin JS
    wp_enqueue_script('ovation-blog-admin-js', get_theme_file_uri('/assets/js/ovation-blog-admin.js'), array('jquery'), true);
    wp_localize_script(
		'ovation-blog-admin-js',
		'ovation_blog',
		array(
			'admin_ajax'	=>	admin_url('admin-ajax.php'),
			'wpnonce'			=>	wp_create_nonce('ovation_blog_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('ovation-blog-admin-js');

    wp_localize_script( 'ovation-blog-admin-js', 'ovation_blog_scripts_localize',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action('admin_enqueue_scripts', 'ovation_blog_enqueue_admin_script');

//dismiss function 
add_action( 'wp_ajax_ovation_blog_dismissed_notice_handler', 'ovation_blog_ajax_notice_dismiss_fuction' );

function ovation_blog_ajax_notice_dismiss_fuction() {
	if (!wp_verify_nonce($_POST['wpnonce'], 'ovation_blog_dismissed_notice_nonce')) {
		exit;
	}
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

//get start box
function ovation_blog_custom_admin_notice() {
    // Check if the notice is dismissed
    if ( ! get_option('dismissed-get_started_notice', FALSE ) )  {
        // Check if not on the theme documentation page
        $ovation_blog_current_screen = get_current_screen();
        if ($ovation_blog_current_screen && $ovation_blog_current_screen->id !== 'appearance_page_ovation-blog-guide-page') {
            $ovation_blog_theme = wp_get_theme();
            ?>
            <div class="notice notice-info is-dismissible" data-notice="get_started_notice">
                <div class="notice-div">
                    <div>
                        <p class="theme-name"><?php echo esc_html($ovation_blog_theme->get('Name')); ?></p>
                        <p><?php _e('For information and detailed instructions, check out our theme documentation.', 'ovation-blog'); ?></p>
                    </div>
                    <div class="notice-buttons-box">
                        <a class="button-primary livedemo" href="<?php echo esc_url( OVATION_BLOG_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'ovation-blog'); ?></a>
                        <a class="button-primary buynow" href="<?php echo esc_url( OVATION_BLOG_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'ovation-blog'); ?></a>
                        <a class="button-primary theme-install" href="themes.php?page=ovation-blog-guide-page"><?php _e('Begin Installation', 'ovation-blog'); ?></a> 
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
add_action('admin_notices', 'ovation_blog_custom_admin_notice');

//after switch theme
add_action('after_switch_theme', 'ovation_blog_after_switch_theme');
function ovation_blog_after_switch_theme () {
    update_option('dismissed-get_started_notice', FALSE );
}
//get-start-function-end//

// tag count
function ovation_blog_display_post_tag_count() {
    $ovation_blog_tags = get_the_tags();
    $ovation_blog_tag_count = ($ovation_blog_tags) ? count($ovation_blog_tags) : 0;
    $ovation_blog_tag_text = ($ovation_blog_tag_count === 1) ? 'tag' : 'tags';
    echo $ovation_blog_tag_count . ' ' . $ovation_blog_tag_text;
}

//media post format
function ovation_blog_get_media($ovation_blog_type = array()){
	$ovation_blog_content = apply_filters( 'the_content', get_the_content() );
  	$output = false;

  // Only get media from the content if a playlist isn't present.
  if ( false === strpos( $ovation_blog_content, 'wp-playlist-script' ) ) {
    $output = get_media_embedded_in_content( $ovation_blog_content, $ovation_blog_type );
    return $output;
  }
}

// excerpt function
function ovation_blog_custom_excerpt() {
    $ovation_blog_excerpt = get_the_excerpt();
    $ovation_blog_plain_text_excerpt = wp_strip_all_tags($ovation_blog_excerpt);
    
    // Get dynamic word limit from theme mod
    $ovation_blog_word_limit = esc_attr(get_theme_mod('ovation_blog_post_excerpt', '30'));
    
    // Limit the number of words
    $ovation_blog_limited_excerpt = implode(' ', array_slice(explode(' ', $ovation_blog_plain_text_excerpt), 0, $ovation_blog_word_limit));

    echo esc_html($ovation_blog_limited_excerpt);
}

// front page template
function ovation_blog_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'ovation_blog_front_page_template' );

// typography
function ovation_blog_fonts_scripts() {
	$headings_font = esc_html(get_theme_mod('ovation_blog_headings_text'));
	$body_font = esc_html(get_theme_mod('ovation_blog_body_text'));

	if( $headings_font ) {
		wp_enqueue_style( 'ovation-blog-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );
	} else {
		wp_enqueue_style( 'ovation-blog-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
	}
	if( $body_font ) {
		wp_enqueue_style( 'ovation-blog-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );
	} else {
		wp_enqueue_style( 'ovation-blog-source-body', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600');
	}
}
add_action( 'wp_enqueue_scripts', 'ovation_blog_fonts_scripts' );

// Footer Text
function ovation_blog_copyright_link() {
    $ovation_blog_footer_text = get_theme_mod('ovation_blog_footer_text', esc_html__('Blog WordPress Theme', 'ovation-blog'));
    $ovation_blog_credit_link = esc_url('https://www.ovationthemes.com/products/free-blog-wordpress-theme');

    echo '<a href="' . $ovation_blog_credit_link . '" target="_blank">' . esc_html($ovation_blog_footer_text) . '<span class="footer-copyright">' . esc_html__(' By Ovation Themes', 'ovation-blog') . '</span></a>';
}

// custom sanitizations
// dropdown
function ovation_blog_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}
// slider custom control
if ( ! function_exists( 'ovation_blog_sanitize_integer' ) ) {
	function ovation_blog_sanitize_integer( $input ) {
		return (int) $input;
	}
}
// range contol
function ovation_blog_sanitize_number_absint( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
// select post page
function ovation_blog_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
// toggle switch
function ovation_blog_callback_sanitize_switch( $value ) {
	
	// Switch values must be equal to 1 of off. Off is indicator and should not be translated.
	return ( ( isset( $value ) && $value == 1 ) ? 1 : 'off' );

}
//choices control
function ovation_blog_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
// Sanitize Sortable control.
function ovation_blog_sanitize_sortable( $val, $setting ) {
	if ( is_string( $val ) || is_numeric( $val ) ) {
		return array(
			esc_attr( $val ),
		);
	}
	$sanitized_value = array();
	foreach ( $val as $item ) {
		if ( isset( $setting->manager->get_control( $setting->id )->choices[ $item ] ) ) {
			$sanitized_value[] = esc_attr( $item );
		}
	}
	return $sanitized_value;
}

// theme setup
function ovation_blog_setup() {
	add_theme_support( "align-wide" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'ovation-blog-featured-image', 2000, 1200, true );
	add_image_size( 'ovation-blog-thumbnail-avatar', 100, 100, true );

	define( 'THEME_DIR', dirname( __FILE__ ) );

	load_theme_textdomain( 'ovation-blog', get_template_directory() . '/languages' );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ovation-blog' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio','quote',) );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', ovation_blog_fonts_url() ) );
}
add_action( 'after_setup_theme', 'ovation_blog_setup' );

// widgets
function ovation_blog_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ovation-blog' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ovation-blog' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'ovation-blog' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'ovation-blog' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'ovation-blog' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ovation-blog' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'ovation-blog' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ovation-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'ovation-blog' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ovation-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'ovation-blog' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ovation-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'ovation-blog' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ovation-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'ovation_blog_widgets_init' );

// google fonts
function ovation_blog_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Playfair Display:ital,wght@0,400;0,500;0,600;0,669;0,700;0,800;0,900;1,400;1,500;1,600;1,669;1,700;1,800;1,900';
	$font_family[] = 'Open Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800';

	$ovation_blog_query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($ovation_blog_query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

//Enqueue scripts and styles.
function ovation_blog_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'ovation-blog-fonts', ovation_blog_fonts_url(), array());

	//Bootstarp
	wp_enqueue_style( 'bootstrap-style', esc_url( get_template_directory_uri() ).'/assets/css/bootstrap.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'ovation-blog-style', get_stylesheet_uri() );

	// Theme Customize CSS.
	require get_parent_theme_file_path( 'inc/extra_customization.php' );
	wp_add_inline_style( 'ovation-blog-style',$ovation_blog_custom_style );

	//font-awesome
	wp_enqueue_style( 'font-awesome-style', esc_url( get_template_directory_uri() ).'/assets/css/fontawesome-all.css' );

	//Block Style
	wp_enqueue_style( 'ovation-blog-block-style', esc_url( get_template_directory_uri() ).'/assets/css/blocks.css' );

	//Custom JS
	wp_enqueue_script( 'ovation-blog-custom.js', get_theme_file_uri( '/assets/js/ovation-blog-custom.js' ), array( 'jquery' ), true );

	//Nav Focus JS
	wp_enqueue_script( 'ovation-blog-navigation-focus', get_theme_file_uri( '/assets/js/navigation-focus.js' ), array( 'jquery' ), true );
	
	//Bootstarp JS
	wp_enqueue_script( 'bootstrap.js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ),true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	//rtl-support
	wp_style_add_data( 'ovation-blog-style', 'rtl', 'replace' );

	if (get_option('ovation_blog_animation_enable', false) !== 'off') {
		//wow.js
		wp_enqueue_script( 'ovation-blog-wow-js', get_theme_file_uri( '/assets/js/wow.js' ), array( 'jquery' ), true );

		//animate.css
		wp_enqueue_style( 'ovation-blog-animate-css', get_template_directory_uri().'/assets/css/animate.css' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'ovation_blog_scripts' );

function ovation_blog_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'ovation-blog-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'ovation-blog-fonts', ovation_blog_fonts_url(), array());
}
add_action( 'enqueue_block_editor_assets', 'ovation_blog_block_editor_styles' );

# Load scripts and styles.(fontawesome)
add_action( 'customize_controls_enqueue_scripts', 'ovation_blog_customize_controls_register_scripts' );
function ovation_blog_customize_controls_register_scripts() {
	
	wp_enqueue_style( 'ovation-blog-ctypo-customize-controls-style', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
}

// enque files
require get_parent_theme_file_path( '/inc/custom-header.php' );
require get_parent_theme_file_path( '/inc/template-tags.php' );
require get_parent_theme_file_path( '/inc/template-functions.php' );
require get_parent_theme_file_path( '/inc/customizer.php' );
require get_parent_theme_file_path( '/inc/dashboard/dashboard.php' );
require get_parent_theme_file_path( '/inc/typofont.php' );
require get_parent_theme_file_path( '/inc/wptt-webfont-loader.php' );
require get_parent_theme_file_path( '/inc/breadcrumb.php' );
require get_parent_theme_file_path( 'inc/sortable/sortable_control.php' );
require get_template_directory() .'/inc/TGM/tgm.php';