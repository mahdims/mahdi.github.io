<?php

// sticky header
$ovation_blog_custom_style= "";

if (false === get_option('ovation_blog_sticky_header')) {
    add_option('ovation_blog_sticky_header', 'off');
}

// Define the custom CSS based on the 'ovation_blog_sticky_header' option

if (get_option('ovation_blog_sticky_header', 'off') !== 'on') {
    $ovation_blog_custom_style .= '.wrap_figure.fixed {';
    $ovation_blog_custom_style .= 'position: static;';
    $ovation_blog_custom_style .= '}';
}

if (get_option('ovation_blog_sticky_header', 'off') !== 'off') {
    $ovation_blog_custom_style .= '.wrap_figure.fixed {';
    $ovation_blog_custom_style .= 'position: fixed; box-shadow: 0px 3px 10px 2px #eee;';
    $ovation_blog_custom_style .= '}';

    $ovation_blog_custom_style .= '.admin-bar .fixed {';
    $ovation_blog_custom_style .= ' margin-top: 32px;';
    $ovation_blog_custom_style .= '}';
}

// ---------logo-max-height

$ovation_blog_logo_max_height = get_theme_mod('ovation_blog_logo_max_height','100');

if($ovation_blog_logo_max_height != false){

$ovation_blog_custom_style .='.custom-logo-link img{';

	$ovation_blog_custom_style .='max-height: '.esc_html($ovation_blog_logo_max_height).'px;';

$ovation_blog_custom_style .='}';
}

/*---------------------------Scroll-top-position -------------------*/

$ovation_blog_scroll_options = get_theme_mod( 'ovation_blog_scroll_options','right_align');

if($ovation_blog_scroll_options == 'right_align'){

$ovation_blog_custom_style .='.scroll-top button{';

	$ovation_blog_custom_style .='';

$ovation_blog_custom_style .='}';

}else if($ovation_blog_scroll_options == 'center_align'){

$ovation_blog_custom_style .='.scroll-top button{';

	$ovation_blog_custom_style .='right: 0; left:0; margin: 0 auto; top:85% !important';

$ovation_blog_custom_style .='}';

}else if($ovation_blog_scroll_options == 'left_align'){

$ovation_blog_custom_style .='.scroll-top button{';

	$ovation_blog_custom_style .='right: auto; left:5%; margin: 0 auto';

$ovation_blog_custom_style .='}';
}
/*---------------------------text-transform-------------------*/

$ovation_blog_text_transform = get_theme_mod( 'ovation_blog_menu_text_transform','CAPITALISE');
if($ovation_blog_text_transform == 'CAPITALISE'){

$ovation_blog_custom_style .='nav#top_gb_menu ul li a{';

	$ovation_blog_custom_style .='text-transform: capitalize ; font-size: 14px;';

$ovation_blog_custom_style .='}';

}else if($ovation_blog_text_transform == 'UPPERCASE'){

$ovation_blog_custom_style .='nav#top_gb_menu ul li a{';

	$ovation_blog_custom_style .='text-transform: uppercase ; font-size: 14px;';

$ovation_blog_custom_style .='}';

}else if($ovation_blog_text_transform == 'LOWERCASE'){

$ovation_blog_custom_style .='nav#top_gb_menu ul li a{';

	$ovation_blog_custom_style .='text-transform: lowercase ; font-size: 14px;';

$ovation_blog_custom_style .='}';
}
/*---------------------------Width -------------------*/

$ovation_blog_theme_width = get_theme_mod( 'ovation_blog_width_options','full_width');

if($ovation_blog_theme_width == 'full_width'){

$ovation_blog_custom_style .='body{';

	$ovation_blog_custom_style .='max-width: 100%;';

$ovation_blog_custom_style .='}';

}else if($ovation_blog_theme_width == 'container'){

$ovation_blog_custom_style .='body{';

	$ovation_blog_custom_style .='width: 100%; padding-right: 15px; padding-left: 15px;  margin-right: auto !important; margin-left: auto !important;';

$ovation_blog_custom_style .='}';

$ovation_blog_custom_style .='@media screen and (min-width: 601px){';

$ovation_blog_custom_style .='body{';

    $ovation_blog_custom_style .='max-width: 720px;';
    
$ovation_blog_custom_style .='} }';

$ovation_blog_custom_style .='@media screen and (min-width: 992px){';

$ovation_blog_custom_style .='body{';

    $ovation_blog_custom_style .='max-width: 960px;';
    
$ovation_blog_custom_style .='} }';

$ovation_blog_custom_style .='@media screen and (min-width: 1200px){';

$ovation_blog_custom_style .='body{';

    $ovation_blog_custom_style .='max-width: 1140px;';
    
$ovation_blog_custom_style .='} }';

$ovation_blog_custom_style .='@media screen and (min-width: 1400px){';

$ovation_blog_custom_style .='body{';

    $ovation_blog_custom_style .='max-width: 1320px;';
    
$ovation_blog_custom_style .='} }';

$ovation_blog_custom_style .='@media screen and (max-width:600px){';

$ovation_blog_custom_style .='body{';

    $ovation_blog_custom_style .='max-width: 100%; padding-right:0px; padding-left: 0px';
    
$ovation_blog_custom_style .='} }';

}else if($ovation_blog_theme_width == 'container_fluid'){

$ovation_blog_custom_style .='body{';

	$ovation_blog_custom_style .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';

$ovation_blog_custom_style .='}';

$ovation_blog_custom_style .='@media screen and (max-width:600px){';

$ovation_blog_custom_style .='body{';

    $ovation_blog_custom_style .='max-width: 100%; padding-right:0px; padding-left: 0px';
    
$ovation_blog_custom_style .='} }';
}

//related products
if( get_option( 'ovation_blog_related_product',true) != 'on') {

$ovation_blog_custom_style .='.related.products{';

	$ovation_blog_custom_style .='display: none;';
	
$ovation_blog_custom_style .='}';
}

if( get_option( 'ovation_blog_related_product',true) != 'off') {

$ovation_blog_custom_style .='.related.products{';

	$ovation_blog_custom_style .='display: block;';
	
$ovation_blog_custom_style .='}';
}

// footer text alignment
$ovation_blog_footer_content_alignment = get_theme_mod( 'ovation_blog_footer_content_alignment','CENTER-ALIGN');

if($ovation_blog_footer_content_alignment == 'LEFT-ALIGN'){

$ovation_blog_custom_style .='.site-info{';

	$ovation_blog_custom_style .='text-align:left; padding-left: 30px;';

$ovation_blog_custom_style .='}';

$ovation_blog_custom_style .='.site-info a{';

	$ovation_blog_custom_style .='padding-left: 30px;';

$ovation_blog_custom_style .='}';


}else if($ovation_blog_footer_content_alignment == 'CENTER-ALIGN'){

$ovation_blog_custom_style .='.site-info{';

	$ovation_blog_custom_style .='text-align:center;';

$ovation_blog_custom_style .='}';


}else if($ovation_blog_footer_content_alignment == 'RIGHT-ALIGN'){

$ovation_blog_custom_style .='.site-info{';

	$ovation_blog_custom_style .='text-align:right; padding-right: 30px;';

$ovation_blog_custom_style .='}';

$ovation_blog_custom_style .='.site-info a{';

	$ovation_blog_custom_style .='padding-right: 30px;';

$ovation_blog_custom_style .='}';

}

// scroll button
$mobile_scroll_setting = get_option('ovation_blog_scroll_enable_mobile', '1');
$main_scroll_setting = get_option('ovation_blog_scroll_enable', '1');

$ovation_blog_custom_style .= '.scrollup {';

if ($main_scroll_setting == 'off') {
    $ovation_blog_custom_style .= 'display: none;';
}

$ovation_blog_custom_style .= '}';

// Add media query for mobile devices
$ovation_blog_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_scroll_setting == 'off' || $mobile_scroll_setting == 'off') {
    $ovation_blog_custom_style .= '.scrollup { display: none; }';
}
$ovation_blog_custom_style .= '}';

// theme breadcrumb
$mobile_breadcrumb_setting = get_option('ovation_blog_enable_breadcrumb_mobile', '1');
$main_breadcrumb_setting = get_option('ovation_blog_enable_breadcrumb', '1');

$ovation_blog_custom_style .= '.archieve_breadcrumb {';

if ($main_breadcrumb_setting == 'off') {
    $ovation_blog_custom_style .= 'display: none;';
}

$ovation_blog_custom_style .= '}';

// Add media query for mobile devices
$ovation_blog_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_breadcrumb_setting == 'off' || $mobile_breadcrumb_setting == 'off') {
    $ovation_blog_custom_style .= '.archieve_breadcrumb { display: none; }';
}
$ovation_blog_custom_style .= '}';

// single post and page breadcrumb
$mobile_single_breadcrumb_setting = get_option('ovation_blog_single_enable_breadcrumb_mobile', '1');
$main_single_breadcrumb_setting = get_option('ovation_blog_single_enable_breadcrumb', '1');

$ovation_blog_custom_style .= '.single_breadcrumb {';

if ($main_single_breadcrumb_setting == 'off') {
    $ovation_blog_custom_style .= 'display: none;';
}

$ovation_blog_custom_style .= '}';

// Add media query for mobile devices
$ovation_blog_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_single_breadcrumb_setting == 'off' || $mobile_single_breadcrumb_setting == 'off') {
    $ovation_blog_custom_style .= '.single_breadcrumb { display: none; }';
}
$ovation_blog_custom_style .= '}';

// woocommerce breadcrumb
$mobile_woo_breadcrumb_setting = get_option('ovation_blog_woocommerce_enable_breadcrumb_mobile', '1');
$main_woo_breadcrumb_setting = get_option('ovation_blog_woocommerce_enable_breadcrumb', '1');

$ovation_blog_custom_style .= '.woocommerce-breadcrumb {';

if ($main_woo_breadcrumb_setting == 'off') {
    $ovation_blog_custom_style .= 'display: none;';
}

$ovation_blog_custom_style .= '}';

// Add media query for mobile devices
$ovation_blog_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_woo_breadcrumb_setting == 'off' || $mobile_woo_breadcrumb_setting == 'off') {
    $ovation_blog_custom_style .= '.woocommerce-breadcrumb { display: none; }';
}
$ovation_blog_custom_style .= '}';


//colors
$color = get_theme_mod('ovation_blog_primary_color', '#7eaf83');
$color_top_head = get_theme_mod('ovation_blog_top_head_color', '#fafafa');
$color_heading = get_theme_mod('ovation_blog_heading_color', '#323232');
$color_text = get_theme_mod('ovation_blog_text_color', '#a8a8a8');
$color_fade = get_theme_mod('ovation_blog_primary_fade', '#d1fed5');
$color_footer_bg = get_theme_mod('ovation_blog_footer_bg', '#323232');
$color_post_bg = get_theme_mod('ovation_blog_post_bg', '#ffffff');


$ovation_blog_custom_style .= ":root {";
    $ovation_blog_custom_style .= "--theme-primary-color: {$color};";
    $ovation_blog_custom_style .= "--theme-top-head-color: {$color_top_head};";
    $ovation_blog_custom_style .= "--theme-heading-color: {$color_heading};";
    $ovation_blog_custom_style .= "--theme-text-color: {$color_text};";
    $ovation_blog_custom_style .= "--theme-primary-fade: {$color_fade};";
    $ovation_blog_custom_style .= "--theme-footer-color: {$color_footer_bg};";
    $ovation_blog_custom_style .= "--post-bg-color: {$color_post_bg};";
$ovation_blog_custom_style .= "}";

$ovation_blog_slider_opacity = get_theme_mod( 'ovation_blog_slider_opacity','0.7');

if($ovation_blog_slider_opacity == '0'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 0';
$ovation_blog_custom_style .='}';

}else if($ovation_blog_slider_opacity == '0.1'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 0.1';
$ovation_blog_custom_style .='}';

}else if($ovation_blog_slider_opacity == '0.2'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 0.2';
$ovation_blog_custom_style .='}';

}else if($ovation_blog_slider_opacity == '0.3'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 0.3';
$ovation_blog_custom_style .='}';

}else if($ovation_blog_slider_opacity == '0.4'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 0.4';
$ovation_blog_custom_style .='}';

}else if($ovation_blog_slider_opacity == '0.5'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 0.5';
$ovation_blog_custom_style .='}';

}else if($ovation_blog_slider_opacity == '0.6'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 0.6';
$ovation_blog_custom_style .='}';

}else if($ovation_blog_slider_opacity == '0.7'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 0.7';
$ovation_blog_custom_style .='}';

}else if($ovation_blog_slider_opacity == '0.8'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 0.8';
$ovation_blog_custom_style .='}';

}
else if($ovation_blog_slider_opacity == '0.9'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 0.9';
$ovation_blog_custom_style .='}';

}
else if($ovation_blog_slider_opacity == '1'){
$ovation_blog_custom_style .='#slider img {';
    $ovation_blog_custom_style .='opacity: 1';
$ovation_blog_custom_style .='}';

}