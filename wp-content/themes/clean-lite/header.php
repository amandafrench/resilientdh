<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Clean Lite
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="headertop">
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
  </div> <!-- .container -->
</div><!-- .headertop -->
<div class="header">
  <div class="container">
    <div class="logo">
	<?php clean_lite_the_custom_logo(); ?>
    <div class="clear"></div>
      <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php bloginfo('name'); ?>
        </a></h1>
      <p><?php bloginfo('description'); ?></p>
    </div><!-- logo -->
    <div class="header_right">
    <div class="toggle"> <a class="toggleMenu" href="<?php echo esc_url('#');?>" style="display:none;">
      <?php esc_html_e('Menu','clean-lite'); ?>
      </a> </div> <!-- toggle -->
    <div class="sitenav">
      <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
    </div><!-- sitenav-->
    </div><!--header_right-->
    <div class="clear"></div>
  </div>
  <!-- container -->
</div><!--.header -->
<?php if ( is_front_page() && ! is_home() ) { ?>
<?php if( get_theme_mod( 'hide_slides' ) == '') { ?>
<!-- Slider Section -->
<?php for($sld=7; $sld<10; $sld++) { ?>
	<?php if( get_theme_mod('page-setting'.$sld)) { ?>
     <?php $slidequery = new WP_query('page_id='.get_theme_mod('page-setting'.$sld,true)); ?>
		<?php while( $slidequery->have_posts() ) : $slidequery->the_post();
        $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
        $img_arr[] = $image;
        $id_arr[] = $post->ID;
        endwhile;
  	  }
    }
?>
<?php if(!empty($id_arr)){ ?>
<section id="home_slider">
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
      <?php 
	$i=1;
	foreach($img_arr as $url){ ?>
      <img src="<?php echo $url; ?>" title="#slidecaption<?php echo $i; ?>" />
      <?php $i++; }  ?>
    </div>
		<?php 
        $i=1;
        foreach($id_arr as $id){ 
        $title = get_the_title( $id ); 
        $post = get_post($id); 
        $content = apply_filters('the_content', substr(strip_tags($post->post_content), 0, 200)); 
        ?>
    <div id="slidecaption<?php echo $i; ?>" class="nivo-html-caption">
      <div class="slide_info">
        <h2><?php echo $title; ?></h2>
        <p><?php echo $content; ?></p>
        <div class="clear"></div>
        <a class="slide_more" href="<?php the_permalink(); ?>">
          <?php esc_html_e('Read More', 'clean-lite');?>
          </a>
      </div>
    </div>
    <?php $i++; } ?>
  </div>
  <div class="clear"></div>
</section>
<?php } else { ?>
<?php if ( current_user_can( 'edit_theme_options' ) ) { ?>
<section id="home_slider">
   <div class="nullslide"><img src="<?php echo esc_url(get_template_directory_uri());?>/images/slide-info.jpg" /></div>
  <div class="clear"></div>
</section>
<?php } ?>
<!-- Slider Section -->
<?php } } } ?>