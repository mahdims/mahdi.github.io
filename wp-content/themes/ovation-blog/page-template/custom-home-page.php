<?php
/**
 * Template Name: Custom Home Page
 */
get_header(); ?>

<main id="content" class="mt-md-5">
  <div class="row m-0">
    <div class="col-lg-6 col-md-6 p-0">
        <section id="slider">
          <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <?php $ovation_blog_slider_count = get_theme_mod('ovation_blog_slider_count');
              for ( $i = 1; $i <= $ovation_blog_slider_count; $i++ ) {
                $ovation_blog_mod =  get_theme_mod( 'ovation_blog_post_setting' . $i );
                if ( 'page-none-selected' != $ovation_blog_mod ) {
                  $ovation_blog_slide_pages[] = $ovation_blog_mod;
                }
              }
              
              if( !empty($ovation_blog_slide_pages) ) :
              $ovation_blog_args = array(
                'post_type' =>array('post','page'),
                'post__in' => $ovation_blog_slide_pages,
                'ignore_sticky_posts'  => true, // Exclude sticky posts by default
              );

              // Check if specific posts are selected
              if (empty($ovation_blog_slide_pages) && is_sticky()) {
                  $ovation_blog_args['post__in'] = get_option('sticky_posts');
              }

              $ovation_blog_query = new WP_Query( $ovation_blog_args );
              if ( $ovation_blog_query->have_posts() ) :
                $i = 1;
            ?>
            <div class="carousel-inner" role="listbox">
              <?php  while ( $ovation_blog_query->have_posts() ) : $ovation_blog_query->the_post(); ?>
              <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
                <?php if(has_post_thumbnail()){ ?>
                  <img src="<?php the_post_thumbnail_url('full'); ?>"/>
                <?php }else{?>
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/slider.jpg" alt="" />
                <?php } ?>
                <div class="carousel-caption">
                  <div class="inner_carousel">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                  </div>
                </div>
              </div>
              <?php $i++; endwhile;
              wp_reset_postdata();?>
            </div>
            <?php else : ?>
            <div class="no-postfound"></div>
              <?php endif;
            endif;?>
              <a class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
              </a>
              <a class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
              </a>
          </div>
          <div class="clearfix"></div>
        </section>
    </div>
    <div class="col-lg-6 col-md-6 media-post-pad">
      <?php if( get_theme_mod('ovation_blog_post_category_setting') != ''){ ?>
        <div id="our-post">
          <div class="row">
            <?php
            $ovation_blog_catData1=  get_theme_mod('ovation_blog_post_category_setting');if($ovation_blog_catData1){
            $ovation_blog_page_query = new WP_Query(array( 

              'category_name' => esc_html($ovation_blog_catData1 ,'ovation-blog'),

              'posts_per_page' => get_theme_mod('ovation_blog_post_cat_count')

            ));?>
              <?php while( $ovation_blog_page_query->have_posts() ) : $ovation_blog_page_query->the_post(); ?>
                <div class="col-lg-6 col-md-12 col-sm-6">
                  <div class="box pt-1">
                    <?php if(has_post_thumbnail()){ ?>
                      <img class="our-post-img" src="<?php the_post_thumbnail_url('full'); ?>"/>
                    <?php }else{?>
                      <img class="our-post-img" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image1.jpg" alt="" />
                    <?php } ?>
                    <div class="box-content">
                      <?php if( get_option('ovation_blog_front_date',false) != 'off'){ ?>
                      <p><?php the_time( get_option( 'date_format' ) ); ?></p>
                      <?php }?>
                      <a href="<?php the_permalink(); ?>"><h4><?php the_title();?></h4></a>
                       <?php if( get_option('ovation_blog_front_admin',false) != 'off'){ ?>
                      <p class="entry-author">
                        <?php echo get_avatar( get_the_author_meta('ID'), 60); ?>
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a>
                       <?php }?> 
                      </p>

                    </div>
                  </div>
                </div>
              <?php endwhile;
              wp_reset_postdata();
            }?>
          </div>
          <div class="clearfix"></div>
        </div>
      <?php }?>
    </div>
  </div>
  <?php if( get_option('ovation_blog_top_category_show_hide', false) !== 'off'){ ?>
    <?php if( get_theme_mod('ovation_blog_top_category_text') != '' || get_theme_mod('ovation_blog_top_category_heading') != ''|| get_theme_mod('ovation_blog_top_category_setting') != ''){ ?>
      <section id="top-cat">
        <div class="container-fluid">
          <p><?php echo esc_html(get_theme_mod('ovation_blog_top_category_text','')); ?></p>
          <h3><?php echo esc_html(get_theme_mod('ovation_blog_top_category_heading','')); ?></h3>
          <div class="row">
            <?php
            $ovation_blog_catData1=  get_theme_mod('ovation_blog_top_category_setting');if($ovation_blog_catData1){
            $ovation_blog_page_query = new WP_Query(array( 

              'category_name' => esc_html($ovation_blog_catData1 ,'ovation-blog'),

              'posts_per_page' => get_theme_mod('ovation_blog_top_post_count')

            ));?>
              <?php while( $ovation_blog_page_query->have_posts() ) : $ovation_blog_page_query->the_post(); ?>
                <div class="col-lg-4 col-md-4 wow zoomIn" data-wow-duration="2s">
                  <div class="box">
                    <?php if(has_post_thumbnail()){ ?>
                      <?php the_post_thumbnail(); ?>
                    <?php }else{?>
                      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/image2.jpg" alt="" />
                    <?php } ?>
                    <div class="box-content">
                      <h4><?php the_title();?></h4>
                      <a href="<?php the_permalink(); ?>"><?php esc_html_e('LEARN MORE','ovation-blog'); ?></a>
                    </div>
                  </div>
                </div>
              <?php endwhile;
              wp_reset_postdata();
            }?>
          </div>
        </div>
      </section>
    <?php }?>
  <?php }?>
  <section id="custom-page-content" <?php if ( have_posts() && trim( get_the_content() ) !== '' ) echo 'class="pt-3"'; ?>>
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
