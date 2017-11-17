<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Clean Lite
 */

get_header(); ?>
<?php if (is_front_page() && !is_home()) { ?>
<?php if( get_theme_mod( 'hide_pagefourboxes' ) == '') { ?>

<section id="pagearea">
  <div class="container">
    <?php
$pages = array();
for ( $count = 1; $count<5; $count++ ) {
	$mod = get_theme_mod( 'page-column' . $count );
	if ( 'page-none-selected' != $mod ) {
		$pages[] = $mod;
	}
}
$filterArray = array_filter($pages);
if(count($filterArray) == 0){ ?>
	<?php if ( current_user_can( 'edit_theme_options' ) ) { ?>
    <p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/home-boxes.jpg" /></p>
    <?php } ?>
    <?php 	
}else{

$filled_array=array_filter($pages);
	
$args = array(
	'posts_per_page' => 4,
	'post_type' => 'page',
	'post__in' => $pages,
	'orderby' => 'post__in'
);
$query = new WP_Query( $args );
if ( $query->have_posts() ) :
	$count = 1;
	while ( $query->have_posts() ) : $query->the_post();
	?>
    <div class="fourbox <?php if($count % 4 == 0) { echo "last_column"; } ?>"> <a href="<?php echo esc_url( get_permalink() ); ?>">
      <?php if ( has_post_thumbnail() ) : ?>
      <div class="thumbbx">
        <?php the_post_thumbnail( array(30,30, true) );?>
      </div>
      <?php endif; ?>
      <h3>
        <?php the_title(); ?>
      </h3>
      </a> <?php the_excerpt(); ?> </div>
    <?php if($count == 0) { ?>
    <div class="clear"></div>
    <?php } ?>
    <?php
	$count++;
	endwhile;
 endif;
}
 
?>
    <div class="clear"></div>
  </div>
  <!-- container --> 
</section>
<!-- #pagearea -->
<?php } ?>
<div class="clear"></div>
<?php if( get_theme_mod( 'hide_welcome' ) == '') { ?>
<section id="wrapfirst">
  <div class="container">
    <div class="welcomewrap">
      <?php if( get_theme_mod('page-setting1')) { ?>
      <?php $queryvar = new WP_query('page_id='.get_theme_mod('page-setting1' ,true)); ?>
      <?php while( $queryvar->have_posts() ) : $queryvar->the_post();?>
      <?php the_post_thumbnail( array(500,500, true));?>
      <h2 class="section-title">
        <?php the_title(); ?>
      </h2>
      <p><?php the_excerpt(); ?></p>
      <a class="ReadMore" href="<?php echo esc_url( get_permalink() ); ?>">
      <?php esc_html_e('Read More','clean-lite'); ?>
      </a>
      <div class="clear"></div>
      <?php endwhile; } else { ?>
      	<?php if ( current_user_can( 'edit_theme_options' ) ) { ?>
      	<p><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/welcome.jpg" alt=""/></p>
        <?php } ?>
      <?php } ?>
    </div>
    <!-- welcomewrap-->
    <div class="clear"></div>
  </div>
  <!-- container --> 
</section>
<div class="clear"></div>
<?php } ?>

<?php } ?>
<div class="container">
  <div class="page_content">
  
      <?php 
	if ( 'posts' == get_option( 'show_on_front' ) ) {
    ?>
    <section class="site-main">
      <div class="blog-post">
        <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                    
                        endwhile;
                        // Previous/next post navigation.
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'clean-lite' ),
							'next_text' => esc_html__( 'Next', 'clean-lite' ),
						) );
                    
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    
                    endif;
                    ?>
      </div>
      <!-- blog-post --> 
    </section>
    <?php
} else {
    ?>
	<section class="site-main">
      <div class="blog-post">
        <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
							 ?>
                             <header class="entry-header">           
            				<h1><?php the_title(); ?></h1>
                    		</header>
                             <?php
                            the_content();
                    
                        endwhile;
                        // Previous/next post navigation.
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'clean-lite' ),
							'next_text' => esc_html__( 'Next', 'clean-lite' ),
						) );
                    
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    
                    endif;
                    ?>
      </div>
      <!-- blog-post --> 
    </section>
	<?php
}
	?>
 
    
    
    
    <?php get_sidebar();?>
    <div class="clear"></div>
  </div>
  <!--.page_content --> 
</div>
<!-- .container -->
<?php get_footer(); ?>
