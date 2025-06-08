<?php

add_action( 'admin_menu', 'ovation_blog_gettingstarted' );
function ovation_blog_gettingstarted() {
	add_theme_page( esc_html__('Begin Installation', 'ovation-blog'), esc_html__('Begin Installation', 'ovation-blog'), 'edit_theme_options', 'ovation-blog-guide-page', 'ovation_blog_guide');
}

function ovation_blog_admin_theme_style() {
   wp_enqueue_style('ovation-blog-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/dashboard.css');
}
add_action('admin_enqueue_scripts', 'ovation_blog_admin_theme_style');

if ( ! defined( 'OVATION_BLOG_SUPPORT' ) ) {
	define('OVATION_BLOG_SUPPORT',__('https://wordpress.org/support/theme/ovation-blog/','ovation-blog'));
}
if ( ! defined( 'OVATION_BLOG_REVIEW' ) ) {
	define('OVATION_BLOG_REVIEW',__('https://wordpress.org/support/theme/ovation-blog/reviews/','ovation-blog'));
}
if ( ! defined( 'OVATION_BLOG_LIVE_DEMO' ) ) {
define('OVATION_BLOG_LIVE_DEMO',__('https://trial.ovationthemes.com/ovation-blog-pro/','ovation-blog'));
}
if ( ! defined( 'OVATION_BLOG_BUY_PRO' ) ) {
define('OVATION_BLOG_BUY_PRO',__('https://www.ovationthemes.com/products/blog-wordpress-theme','ovation-blog'));
}
if ( ! defined( 'OVATION_BLOG_PRO_DOC' ) ) {
define('OVATION_BLOG_PRO_DOC',__('https://trial.ovationthemes.com/docs/ot-blog-pro/','ovation-blog'));
}
if ( ! defined( 'OVATION_BLOG_FREE_DOC' ) ) {
define('OVATION_BLOG_FREE_DOC',__('https://trial.ovationthemes.com/docs/ot-ovation-blog-free-doc/','ovation-blog'));
}
if ( ! defined( 'OVATION_BLOG_THEME_NAME' ) ) {
define('OVATION_BLOG_THEME_NAME',__('Premium Blog Theme','ovation-blog'));
}


/**
 * Theme Info Page
 */
function ovation_blog_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$ovation_blog_theme = wp_get_theme(); ?>

	<div class="getting-started__header">
		<div class="header-box-left">
			<h2><?php echo esc_html( $ovation_blog_theme ); ?></h2>
			<p><?php esc_html_e('Version: ', 'ovation-blog'); ?><?php echo esc_html($ovation_blog_theme['Version']);?></p>
		</div>
		<div class="header-box-right">
			<div class="btn_box">
				<a class="button-primary" href="<?php echo esc_url( OVATION_BLOG_FREE_DOC ); ?>" target="_blank"><?php esc_html_e('Theme Documentation', 'ovation-blog'); ?></a>
				<a class="button-primary" href="<?php echo esc_url( OVATION_BLOG_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support', 'ovation-blog'); ?></a>
				<a class="button-primary" href="<?php echo esc_url( OVATION_BLOG_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'ovation-blog'); ?></a>
			</div>
		</div>
	</div>
	<div class="import-box">
		<div class="box-container">
			<h2><?php esc_html_e( 'DEMO IMPORT', 'ovation-blog' ); ?></h2>
			<p><?php esc_html_e('To import all of the demo content, click the Begin With Demo Import button.','ovation-blog'); ?></p>
			<?php require get_theme_file_path( '/inc/dashboard/setup.php' ); ?>
		</div>
	</div>
	<div class="wrap getting-started">
		<div class="box-container">
			<div class="box-left-main">
				<div class="leftbox">
					<h3><?php esc_html_e('Documentation','ovation-blog'); ?></h3>
					<p><?php esc_html_e('To step the ovation blog theme follow the below steps.','ovation-blog'); ?></p>

					<h4><?php esc_html_e('1. Setup Logo','ovation-blog'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Site Identity >> Upload your logo or Add site title and site description.','ovation-blog'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','ovation-blog'); ?></a>

					<h4><?php esc_html_e('2. Setup Menus','ovation-blog'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Menus >> Create Menus >> Add pages, post or custom link then save it.','ovation-blog'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Add Menus','ovation-blog'); ?></a>

					<h4><?php esc_html_e('3. Setup Social Icons','ovation-blog'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Social Media >> Add social links.','ovation-blog'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=ovation_blog_urls') ); ?>" target="_blank"><?php esc_html_e('Add Social Icons','ovation-blog'); ?></a>

					<h4><?php esc_html_e('4. Setup Footer','ovation-blog'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Widgets >> Add widgets in footer 1, footer 2, footer 3, footer 4. >> ','ovation-blog'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widgets','ovation-blog'); ?></a>

					<h4><?php esc_html_e('5. Setup Footer Text','ovation-blog'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Footer Text >> Add copyright text. >> ','ovation-blog'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=ovation_blog_footer_copyright') ); ?>" target="_blank"><?php esc_html_e('Footer Text','ovation-blog'); ?></a>

					<h3><?php esc_html_e('Setup Home Page','ovation-blog'); ?></h3>
					<p><?php esc_html_e('To step the home page follow the below steps.','ovation-blog'); ?></p>

					<h4><?php esc_html_e('1. Setup Page','ovation-blog'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Pages >> Add New Page >> Select "Custom Home Page" from templates. >> Publish it.','ovation-blog'); ?></p>
					<a class="dashboard_add_new_page button-primary"><?php esc_html_e('Add New Page','ovation-blog'); ?></a>

					<h4><?php esc_html_e('2. Setup Slider','ovation-blog'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post >> Add title, content and featured image >> Publish it.','ovation-blog'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Slider Settings >> Select post.','ovation-blog'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=ovation_blog_slider_section') ); ?>" target="_blank"><?php esc_html_e('Add Slider','ovation-blog'); ?></a>

					<h4><?php esc_html_e('4. Setup Popular Post','ovation-blog'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post Category >> Add New Post >> Add title, content, select post category and featured image >> Publish it.','ovation-blog'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Popular Post >> Select post category.','ovation-blog'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=ovation_blog_post') ); ?>" target="_blank"><?php esc_html_e('Add Popular Post','ovation-blog'); ?></a>

					<h4><?php esc_html_e('4. Setup Top Categories','ovation-blog'); ?></h4>
					<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post Category >> Add New Post >> Add title, content, select post category and featured image >> Publish it.','ovation-blog'); ?></p>
					<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Top Categories >> Add headings and select post category.','ovation-blog'); ?></p>
					<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=ovation_blog_top_category') ); ?>" target="_blank"><?php esc_html_e('Add Top Categories','ovation-blog'); ?></a>
				</div>
        	</div>
			<div class="box-right-main">
				<h3><?php echo esc_html(OVATION_BLOG_THEME_NAME); ?></h3>
				<img class="ovation_blog_img_responsive" style="width: 100%;" src="<?php echo esc_url( $ovation_blog_theme->get_screenshot() ); ?>" />
				<div class="pro-links">
					<hr>
					<a class="button-primary livedemo" href="<?php echo esc_url( OVATION_BLOG_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'ovation-blog'); ?></a>
					<a class="button-primary buynow" href="<?php echo esc_url( OVATION_BLOG_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'ovation-blog'); ?></a>
					<a class="button-primary docs" href="<?php echo esc_url( OVATION_BLOG_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'ovation-blog'); ?></a>
					<hr>
				</div>
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
		</div>
	</div>

<?php }?>
