<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Clean Lite
 */
?>
<div id="footersocial">
    <div class="container">
         <div class="left">
		<?php
        $contact_no = esc_attr(get_theme_mod('contact_no'));
        if(!empty($contact_no)){
        ?>
        <span><?php echo esc_attr($contact_no); ?></span>        
        <?php } ?> 
        
		<?php 
	 	$contact_mail = get_theme_mod('contact_mail');
		if( !empty($contact_mail) ){ ?>
          <a href="mailto:<?php echo antispambot( sanitize_email( $contact_mail ) ); ?>"><?php echo antispambot( sanitize_email( $contact_mail ) ); ?></a>			
		<?php } ?>  
        
         </div>  
         <div class="right">
         	<div class="social-icons">
			<?php $fb_link = get_theme_mod('fb_link');?>
            <?php if( !empty($fb_link) ){ ?>
            <a title="facebook" class="fb" target="_blank" href="<?php echo esc_url($fb_link); ?>"></a> 
            <?php } ?>
            
            <?php $twitt_link = get_theme_mod('twitt_link');?>
            <?php if( !empty($twitt_link) ){ ?>
            <a title="twitter" class="tw" target="_blank" href="<?php echo esc_url($twitt_link); ?>"></a>
            <?php } ?>
            
            <?php $gplus_link = get_theme_mod('gplus_link');?>
            <?php if( !empty($gplus_link) ){ ?>
            <a title="google-plus" class="gp" target="_blank" href="<?php echo esc_url($gplus_link); ?>"></a>
            <?php } ?>
            
            <?php $linked_link = get_theme_mod('linked_link');?>
            <?php if( !empty($linked_link) ){ ?>
            <a title="linkedin" class="in" target="_blank" href="<?php echo esc_url($linked_link); ?>"></a>
            <?php } ?>
                   
           </div>  
         </div>      
        <div class="clear"></div>         
	</div><!--end .container-->
</div><!--end #footersocial-->

<div id="footer-wrapper">
    	<div class="container">
             <div class="cols-4 widget-column-1">  
             
            <?php $menu_title = get_theme_mod('menu_title');?>
            <?php if( !empty($menu_title) ){ ?>
                <h5><?php echo esc_attr($menu_title);
				?></h5>            
			  <?php } ?>
               
               <div class="menu">
                  <?php wp_nav_menu( array('theme_location' => 'footer', 'depth' => 1) ); ?>
                </div>                      
         
            </div><!--end .widget-column-1-->                  
			         
             
             <div class="cols-4 widget-column-2"> 
            <?php $newsfeed_title = get_theme_mod('newsfeed_title');?>
            <?php if( !empty($newsfeed_title) ){ ?>
                <h5><?php echo esc_attr($newsfeed_title); ?></h5>            
			  <?php } ?>  
              
              <?php $args = array( 'posts_per_page' => 2, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
					$postquery = new WP_Query( $args );
					?>
                    <?php while( $postquery->have_posts() ) : $postquery->the_post(); ?>
                        <div class="recent-post">
                         <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>                        
                            <p><?php the_excerpt(); ?></p> 
                            <p><a href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e('Read More','clean-lite'); ?></a></p>                     
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>                  	
                       	
              </div><!--end .widget-column-2-->     
                      
               <div class="cols-4 widget-column-3">            
               
               <?php $about_title = get_theme_mod('about_title'); ?>       
               <?php if( !empty($about_title) ){ ?> 
                <h5><?php echo esc_attr( $about_title); ?></h5>             
			   <?php } ?>
               
               <?php $about_description = get_theme_mod('about_description'); ?>       
               <?php if( !empty($about_description) ){ ?> 
                <p><?php echo esc_attr( $about_description); ?></p>
			   <?php } ?>    	

                </div><!--end .widget-column-3-->
                
                <div class="cols-4 widget-column-4">   
                             
               <?php $contact_title = get_theme_mod('contact_title'); ?>       
               <?php if( !empty($contact_title) ){ ?> 
               <h5><?php echo esc_attr($contact_title); ?></h5>              
			   <?php } ?>
                
               <?php $contact_add = get_theme_mod('contact_add'); ?>       
               <?php if( !empty($contact_add) ){ ?> 
                <p><?php echo esc_attr($contact_add); ?></p>             
			   <?php } ?>
                
                
              <div class="phone-no">	
               <?php $contact_no = get_theme_mod('contact_no'); ?>       
               <?php if( !empty($contact_no) ){ ?> 
                <p><?php echo esc_attr($contact_no); ?></p>              
			   <?php } ?>  
              
                         
               		<?php 
	 	$contact_mail = get_theme_mod('contact_mail');
		if( !empty($contact_mail) ){ ?>
          <a href="mailto:<?php echo antispambot( sanitize_email( $contact_mail ) ); ?>"><?php echo antispambot( sanitize_email( $contact_mail ) ); ?></a>			
		<?php } ?>                
               </div>    
               
             </div><!--end .widget-column-4-->
                
                
            <div class="clear"></div>
        </div><!--end .container--> 
        
         <div class="copyright-wrapper">
        	<div class="container">
           		 <div class="copyright-txt">&nbsp;</div>
            	 <div class="design-by"><?php printf('<a href="'.esc_url(SKT_FREE_THEME_URL).'" rel="nofollow">Clean Lite</a>' ); ?></div>
                 <div class="clear"></div>
            </div>           
        </div>
               
    </div><!--end .footer-wrapper-->
<?php wp_footer(); ?>

</body>
</html>