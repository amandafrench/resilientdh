<?php
/**
 * @package Clean Lite
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>

    
    <header class="entry-header">
        <h2 class="single_title"><?php the_title(); ?></h2>
    </header><!-- .entry-header -->
    
     <div class="postmeta">
            <div class="post-date"><?php echo get_the_date(); ?></div><!-- post-date -->
            <div class="post-comment"> &nbsp;|&nbsp; <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div> 
            <div class="clear"></div>         
    </div><!-- postmeta -->
    
	<?php if (has_post_thumbnail() ){ ?>
    	<div class="post-thumb"><?php the_post_thumbnail(); ?></div>
    <?php }?>

    <div class="entry-content">
         
		
        <?php the_content(); ?>
        
        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">',
            'after'  => '</div>',
        ) );
        ?>
        <div class="clear"></div>
        <div class="postmeta">
            <div class="post-categories"><?php the_category( esc_html_e( ', ', 'clean-lite' )); ?></div>
            <div class="post-tags"><?php the_tags( esc_html_e('&nbsp;|&nbsp; Tags: ', 'clean-lite')); ?> </div>
            <div class="clear"></div>
        </div><!-- postmeta -->
    </div><!-- .entry-content -->
   
    <footer class="entry-meta">
      <?php edit_post_link( esc_html_e( ' ', 'clean-lite' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->

</article>