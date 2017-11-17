<?php
//about theme info
add_action( 'admin_menu', 'clean_lite_abouttheme' );
function clean_lite_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'clean-lite'), esc_html__('About Theme', 'clean-lite'), 'edit_theme_options', 'clean_lite_guide', 'clean_lite_mostrar_guide');   
} 

//guidline for about theme
function clean_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<style type="text/css">
@media screen and (min-width: 800px) {
.col-left {float:left; width: 65%; padding: 1%;}
.col-right {float:right; width: 30%; padding:1%; border-left:1px solid #DDDDDD; }
}
</style>

<div class="wrapper-info">
	<div class="col-left">
   		   <div style="font-size:16px; font-weight:bold; padding-bottom:5px; border-bottom:1px solid #ccc;">
			  <?php esc_html_e('About Theme Info', 'clean-lite'); ?>
		   </div>
          <p><?php esc_html_e('Clean Lite is a simple responsive and adaptable multipurpose WordPress theme with focus more on construction, industrial, commercial, corporate, and business websites. However it can be used for personal and blogging purposes.','clean-lite'); ?></p>
		  <a href="<?php echo SKT_PRO_THEME_URL; ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	
	<div class="col-right">			
			<div style="text-align:center; font-weight:bold;">
				<hr />
				<a href="<?php echo SKT_LIVE_DEMO; ?>" target="_blank"><?php esc_html_e('Live Demo', 'clean-lite'); ?></a> | 
				<a href="<?php echo SKT_PRO_THEME_URL; ?>"><?php esc_html_e('Buy Pro', 'clean-lite'); ?></a> | 
				<a href="<?php echo SKT_THEME_DOC; ?>" target="_blank"><?php esc_html_e('Documentation', 'clean-lite'); ?></a>
                <div style="height:5px"></div>
				<hr />                
                <a href="<?php echo SKT_THEMES; ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>