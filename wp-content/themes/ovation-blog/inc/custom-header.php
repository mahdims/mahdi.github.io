<?php
/**
 * Custom header implementation
 */

function ovation_blog_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'ovation_blog_custom_header_args', array(
		'default-image'          => get_parent_theme_file_uri( '/assets/images/header-img.png' ),
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1200,
		'height'                 => 80,
		'flex-width'			 => true,
		'flex-height'			 => true,
		'wp-head-callback'       => 'ovation_blog_header_style',
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header-img.png',
			'thumbnail_url' => '%s/assets/images/header-img.png',
			'description'   => __( 'Default Header Image', 'ovation-blog' ),
		),
		'default-image-2' => array(
			'url'           => '%s/assets/images/header-img-2.png',
			'thumbnail_url' => '%s/assets/images/header-img-2.png',
			'description'   => __( 'Default Header Image 2', 'ovation-blog' ),
		),
	) );
}

add_action( 'after_setup_theme', 'ovation_blog_custom_header_setup' );

if ( ! function_exists( 'ovation_blog_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see ovation_blog_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'ovation_blog_header_style' );
function ovation_blog_header_style() {
	if ( get_header_image() ) :
	$custom_css = "
		.header-image, .woocommerce-page .single-post-image  {
			background-image:url('".esc_url(get_header_image())."');
			background-position: top;
			background-size:cover;
			background-repeat:no-repeat;
		}
		";
	   	wp_add_inline_style( 'ovation-blog-style', $custom_css );
	endif;
}
endif;


