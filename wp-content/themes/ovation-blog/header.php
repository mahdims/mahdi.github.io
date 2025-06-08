<?php
/**
 * The header for our theme
 *
 * @subpackage Ovation Blog
 * @since 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
	    do_action( 'wp_body_open' );
	}
?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ovation-blog' ); ?></a>
	<?php if( get_option('ovation_blog_theme_loader',true) != 'off'){ ?>
		<?php $ovation_blog_loader_option = get_theme_mod( 'ovation_blog_loader_style','style_one');
		if($ovation_blog_loader_option == 'style_one'){ ?>
			<div id="preloader" class="circle">
				<div id="loader"></div>
			</div>
		<?php }
		else if($ovation_blog_loader_option == 'style_two'){ ?>
			<div id="preloader">
				<div class="spinner">
					<div class="rect1"></div>
					<div class="rect2"></div>
					<div class="rect3"></div>
					<div class="rect4"></div>
					<div class="rect5"></div>
				</div>
			</div>
		<?php }?>
	<?php }?>
	<div id="page" class="site">
		<div id="header">
			<div class="wrap_figure wow bounceInDown delay-2000">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-2 col-sm-4 col-6 box-center">
							<div class="logo">
						        <?php if ( has_custom_logo() ) : ?>
				            		<?php the_custom_logo(); ?>
					            <?php endif; ?>
				              	<?php $ovation_blog_blog_info = get_bloginfo( 'name' ); ?>
						                <?php if ( ! empty( $ovation_blog_blog_info ) ) : ?>
						                  	<?php if ( is_front_page() && is_home() ) : ?>
												<?php if( get_option('ovation_blog_logo_title',false) != 'off'){ ?>
						                    	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
																	<?php }?>
						                  	<?php else : ?>
												<?php if( get_option('ovation_blog_logo_title',false) != 'off'){ ?>
					                      		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
																		<?php }?>
					                  		<?php endif; ?>
						                <?php endif; ?>
					                <?php
				                  		$ovation_blog_description = get_bloginfo( 'description', 'display' );
					                  	if ( $ovation_blog_description || is_customize_preview() ) :
					                ?>
					                <?php if( get_option('ovation_blog_logo_text',true) != 'off'){ ?>
					                  	<p class="site-description">
					                    	<?php echo esc_html($ovation_blog_description); ?>
					                  	</p>
					                <?php }?>
				              	<?php endif; ?>
						    </div>
						</div>
						<div class="col-lg-5 col-sm-2 col-6 box-center">
							<div class="toggle-menu gb_menu">
								<button onclick="ovation_blog_gb_Menu_open()" class="gb_toggle"><i class="fas fa-ellipsis-h"></i><p><?php esc_html_e('Menu','ovation-blog'); ?></p><span class="screen-reader-text"><?php esc_html_e('Menu','ovation-blog'); ?></span></button>
							</div>
						   	<div class="menu_box">
						   		<?php get_template_part('template-parts/navigation/navigation-top'); ?>
						   	</div>
						</div>
						<div class="col-lg-2 col-sm-3 col-6 box-center">
							<?php if( get_option('header_social_icon_enable',false) != 'off'){ ?>						
							<?php
					            $ovation_blog_header_twt_target = esc_attr(get_option('ovation_blog_header_twt_target','true'));
					            $ovation_blog_header_linkedin_target = esc_attr(get_option('ovation_blog_header_linkedin_target','true'));
					            $ovation_blog_header_youtube_target = esc_attr(get_option('ovation_blog_header_youtube_target','true'));
					            $ovation_blog_header_instagram_target = esc_attr(get_option('ovation_blog_header_instagram_target','true'));
				          	?>  							
							 <div class="links">
					          <?php if( get_theme_mod('ovation_blog_twitter') != ''){ ?>
					            <a target="<?php echo $ovation_blog_header_twt_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('ovation_blog_twitter','')); ?>">
					              <i class="<?php echo esc_attr(get_theme_mod('ovation_blog_twitter_icon','fab fa-x-twitter')); ?>"></i>
					            </a>
					          <?php }?>
					          <?php if( get_theme_mod('ovation_blog_linkedin') != ''){ ?>
					            <a target="<?php echo $ovation_blog_header_linkedin_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('ovation_blog_linkedin','')); ?>">
					              <i class="<?php echo esc_attr(get_theme_mod('ovation_blog_linkedin_icon','fab fa-linkedin-in')); ?>"></i>
					            </a>
					          <?php }?>
					          <?php if( get_theme_mod('ovation_blog_youtube') != ''){ ?>
					            <a target="<?php echo $ovation_blog_header_youtube_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('ovation_blog_youtube','')); ?>">
					              <i class="<?php echo esc_attr(get_theme_mod('ovation_blog_youtube_icon','fab fa-youtube')); ?>"></i>
					            </a>
					          <?php }?>
					          <?php if( get_theme_mod('ovation_blog_instagram') != ''){ ?>
					            <a target="<?php echo $ovation_blog_header_instagram_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('ovation_blog_instagram','')); ?>">
					              <i class="<?php echo esc_attr(get_theme_mod('ovation_blog_instagram_icon','fab fa-instagram')); ?>"></i>
					            </a>
					          <?php }?>
					        </div>
							<?php }?>
						</div>
						<div class="col-lg-3 col-sm-3 col-6 box-center">
							<?php if( get_option('header_search_enable',false) != 'off'){ ?>
								<div class="search-box">
									<?php get_search_form(); ?>
								</div>
							 <?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
