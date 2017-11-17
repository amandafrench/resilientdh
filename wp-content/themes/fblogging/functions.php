<?php
/**
 * fBlogging functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @subpackage fBlogging
 * @author tishonator
 * @since fBlogging 1.0.0
 *
 */

require_once( trailingslashit( get_template_directory() ) . 'customize-pro/class-customize.php' );

if ( ! function_exists( 'fblogging_setup' ) ) :
/**
 * fBlogging setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
function fblogging_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'fblogging', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 0, true );

	// This theme uses wp_nav_menu() in header menu
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'fblogging' ),
		'footer'   => __( 'Footer Menu', 'fblogging' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	

	// add the visual editor to resemble the theme style
	add_editor_style( array( 'css/editor-style.css', get_template_directory_uri() . '/css/font-awesome.min.css' ) );

	// add custom background				 
	add_theme_support( 'custom-background', 
				   array ('default-color'  => '#FFFFFF')
				 );

	// add content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 900;
	}

	// add custom header
    add_theme_support( 'custom-header', array (
                       'default-image'          => '',
                       'random-default'         => '',
                       'flex-height'            => true,
                       'flex-width'             => true,
                       'uploads'                => true,
                       'width'                  => 900,
                       'height'                 => 100,
                       'default-text-color'     => '#000000',
                       'wp-head-callback'       => 'fblogging_header_style',
                    ) );

    // add custom logo
    add_theme_support( 'custom-logo', array (
                       'width'                  => 145,
                       'height'                 => 36,
                       'flex-height'            => true,
                       'flex-width'             => true,
                    ) );
}
endif; // fblogging_setup
add_action( 'after_setup_theme', 'fblogging_setup' );

/**
 * Register theme settings in the customizer
 */
function fblogging_customize_register( $wp_customize ) {

	/**
	 * Add Social Sites Section
	 */
	$wp_customize->add_section(
		'fblogging_social_section',
		array(
			'title'       => __( 'Social Sites', 'fblogging' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add facebook url
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_facebook',
		__( 'Facebook Page URL', 'fblogging' ), '#');

	// Add google+ url
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_google',
		__( 'Google+ Page URL', 'fblogging' ), '#');

	// Add twitter url
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_twitter',
		__( 'Twitter URL', 'fblogging' ), '#');

	// Add LinkedIn
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_linkedin',
		__( 'LinkedIn', 'fblogging' ), '#');

	// Add Instagram
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_instagram',
		__( 'Instagram', 'fblogging' ), '#');

	// Add RSS Feeds url
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_rss',
		__( 'RSS Feeds URL', 'fblogging' ), get_bloginfo( 'rss2_url' ));

	// Add Tumblr Text Control
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_tumblr',
		__( 'Tumblr', 'fblogging' ), '#');

	// Add YouTube channel url
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_youtube',
		__( 'YouTube channel URL', 'fblogging' ), '#');

	// Add Pinterest Text Control
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_pinterest',
		__( 'Pinterest', 'fblogging' ), '#');

	// Add VK Text Control
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_vk',
		__( 'VK', 'fblogging' ), '#');

	// Add Flickr Text Control
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_flickr',
		__( 'Flickr', 'fblogging' ), '#');

	// Add Vine Text Control
	fblogging_customize_add_social_site($wp_customize, 'fblogging_social_vine',
		__( 'Vine', 'fblogging' ), '#');

	/**
	 * Add Slider Section
	 */
	$wp_customize->add_section(
		'fblogging_slider_section',
		array(
			'title'       => __( 'Slider', 'fblogging' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add display slider option
	$wp_customize->add_setting(
			'fblogging_slider_display',
			array(
					'default'           => 1,
					'sanitize_callback' => 'esc_attr',
			)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fblogging_slider_display',
							array(
								'label'          => __( 'Display Slider', 'fblogging' ),
								'section'        => 'fblogging_slider_section',
								'settings'       => 'fblogging_slider_display',
								'type'           => 'checkbox',
							)
						)
	);
	
	// Add slide 1 background image
	$wp_customize->add_setting( 'fblogging_slide1_image',
		array(
			'default' => get_template_directory_uri().'/images/slider/' . '1.jpg',
    		'sanitize_callback' => 'esc_url_raw'
		)
	);

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fblogging_slide1_image',
			array(
				'label'   	 => __( 'Slide 1 Image', 'fblogging' ),
				'section' 	 => 'fblogging_slider_section',
				'settings'   => 'fblogging_slide1_image',
			) 
		)
	);
	
	// Add slide 2 background image
	$wp_customize->add_setting( 'fblogging_slide2_image',
		array(
			'default' => get_template_directory_uri().'/images/slider/' . '2.jpg',
    		'sanitize_callback' => 'esc_url_raw'
		)
	);

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fblogging_slide2_image',
			array(
				'label'   	 => __( 'Slide 2 Image', 'fblogging' ),
				'section' 	 => 'fblogging_slider_section',
				'settings'   => 'fblogging_slide2_image',
			) 
		)
	);
	
	// Add slide 3 background image
	$wp_customize->add_setting( 'fblogging_slide3_image',
		array(
			'default' => get_template_directory_uri().'/images/slider/' . '3.jpg',
    		'sanitize_callback' => 'esc_url_raw'
		)
	);

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fblogging_slide3_image',
			array(
				'label'   	 => __( 'Slide 3 Image', 'fblogging' ),
				'section' 	 => 'fblogging_slider_section',
				'settings'   => 'fblogging_slide3_image',
			) 
		)
	);

	/**
	 * Add Footer Section
	 */
	$wp_customize->add_section(
		'fblogging_footer_section',
		array(
			'title'       => __( 'Footer', 'fblogging' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add footer copyright text
	$wp_customize->add_setting(
		'fblogging_footer_copyright',
		array(
		    'default'           => '',
		    'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fblogging_footer_copyright',
        array(
            'label'          => __( 'Copyright Text', 'fblogging' ),
            'section'        => 'fblogging_footer_section',
            'settings'       => 'fblogging_footer_copyright',
            'type'           => 'text',
            )
        )
	);
}

/**
 * Add Social Site control into Customizer
 */
function fblogging_customize_add_social_site($wp_customize, $controlId, $label, $defaultValue) {

	$wp_customize->add_setting(
		$controlId,
		array(
		    'default'           => $defaultValue,
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $controlId,
        array(
            'label'          => $label,
            'section'        => 'fblogging_social_section',
            'settings'       => $controlId,
            'type'           => 'text',
            )
        )
	);
}

add_action('customize_register', 'fblogging_customize_register');

/**
 * the main function to load scripts in the fBlogging theme
 * if you add a new load of script, style, etc. you can use that function
 * instead of adding a new wp_enqueue_scripts action for it.
 */
function fblogging_load_scripts() {

	// load main stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array( ) );
	wp_enqueue_style( 'fblogging-style', get_stylesheet_uri(), array() );
	
	wp_enqueue_style( 'fblogging-fonts', fblogging_fonts_url(), array(), null );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// Load Utilities JS Script
	wp_enqueue_script( 'fblogging-js', get_template_directory_uri() . '/js/utilities.js', array( 'jquery' ) );

	wp_enqueue_script( 'modernizr.custom.46884', get_template_directory_uri() . '/js/modernizr.custom.46884.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery.slicebox', get_template_directory_uri() . '/js/jquery.slicebox.js', array( 'jquery' ) );
}

add_action( 'wp_enqueue_scripts', 'fblogging_load_scripts' );

/**
 *	Load google font url used in the fBlogging theme
 */
function fblogging_fonts_url() {

    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by PT Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $cantarell = _x( 'on', 'PT Sans font: on or off', 'fblogging' );

    if ( 'off' !== $cantarell ) {
        $font_families = array();
 
        $font_families[] = 'PT Sans';
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,cyrillic-ext,cyrillic,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

/**
 * Display website's logo image
 */
function fblogging_show_website_logo_image_and_title() {

	if ( has_custom_logo() ) {

        the_custom_logo();
    }

    $header_text_color = get_header_textcolor();

    if ( 'blank' !== $header_text_color ) {
    
        echo '<div id="site-identity">';
        echo '<a href="' . esc_url( home_url('/') ) . '" title="' . esc_attr( get_bloginfo('name') ) . '">';
        echo '<h1 class="entry-title">' . esc_html( get_bloginfo('name') ) . '</h1>';
        echo '</a>';
        echo '<strong>' . esc_html( get_bloginfo('description') ) . '</strong>';
        echo '</div>';
    }
}

/**
 *	Displays the copyright text.
 */
function fblogging_show_copyright_text() {

	$footerText = get_theme_mod('fblogging_footer_copyright', null);

	if ( !empty( $footerText ) ) {

		echo esc_html( $footerText ) . ' | ';		
	}
}

/**
 *	widgets-init action handler. Used to register widgets and register widget areas
 */
function fblogging_widgets_init() {
	
	// Register Sidebar Widget.
	register_sidebar( array (
						'name'	 		 =>	 __( 'Sidebar Widget Area', 'fblogging'),
						'id'		 	 =>	 'sidebar-widget-area',
						'description'	 =>  __( 'The sidebar widget area', 'fblogging'),
						'before_widget'	 =>  '',
						'after_widget'	 =>  '',
						'before_title'	 =>  '<div class="sidebar-before-title"></div><h3 class="sidebar-title">',
						'after_title'	 =>  '</h3><div class="sidebar-after-title"></div>',
					) );

	// Register Footer Column #1
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #1', 'fblogging' ),
							'id' 			 =>  'footer-column-1-widget-area',
							'description'	 =>  __( 'The Footer Column #1 widget area', 'fblogging' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #2
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #2', 'fblogging' ),
							'id' 			 =>  'footer-column-2-widget-area',
							'description'	 =>  __( 'The Footer Column #2 widget area', 'fblogging' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #3
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #3', 'fblogging' ),
							'id' 			 =>  'footer-column-3-widget-area',
							'description'	 =>  __( 'The Footer Column #3 widget area', 'fblogging' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
}

add_action( 'widgets_init', 'fblogging_widgets_init' );

/**
 * Displays the slider
 */
function fblogging_display_slider() { ?>
	 
	<div class="slider-wrapper">
	 <ul id="sb-slider" class="sb-slider">
		<?php
			// display slides
			$numberOfSlides = 0;
			for ( $i = 1; $i <= 3; ++$i ) {

				$defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';
				$slideImage = get_theme_mod( 'fblogging_slide'.$i.'_image', $defaultSlideImage );

				if ( $slideImage != '' ) :

					++$numberOfSlides;
		?>
					<li>
						<img src="<?php echo esc_url( $slideImage ); ?>" alt="<?php echo esc_attr( $i ); ?>" />
					</li>
		<?php
				endif;
			} ?>
	 </ul><!-- #sb-slider -->

	 <div id="shadow" class="shadow"></div>

	 <?php if ( $numberOfSlides > 1 ) : ?>

	 		<div id="nav-arrows" class="nav-arrows">
				<a href="#"><?php esc_html_e('Next', 'fblogging'); ?></a>
				<a href="#"><?php esc_html_e('Previous', 'fblogging'); ?></a>
			</div>

	 <?php endif; ?>

	 <div id="nav-dots" class="nav-dots">
		 <?php for ($i = 0; $i < $numberOfSlides; ++$i) { ?>
		 			<?php if ( $i == 0 ) { ?>

		 					<span class="nav-dot-current"></span>

		 			<?php } else { ?>

		 					<span></span>

		 			<?php } ?>
		 <?php } ?>
	 </div>
	</div><!-- .slider-wrapper -->
<?php  
}

/**
 * Checks if slider has at least one image
 */
function fblogging_slider_has_images() {

	$result = false;

	for ( $i = 1; $i <= 3; ++$i ) {

		$defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';
		$slideImage = get_theme_mod( 'fblogging_slide'.$i.'_image', $defaultSlideImage );

		if ( $slideImage != '' ) {

			$result = true;
			break;
		}
	}

	return $result;
}

function fblogging_display_single_social_site($socialSiteID, $defaultValue, $title, $cssClass) {

	$socialURL = get_theme_mod( $socialSiteID, $defaultValue );
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_attr( $title )
							. '" class="' . esc_attr( $cssClass ) . '"></a></li>';
	}
}

/**
 * Display Social Websites
 */
function fblogging_display_social_sites() {

	fblogging_display_single_social_site('fblogging_social_facebook', '#', __('Follow us on Facebook', 'fblogging'), 'facebook16' );

	fblogging_display_single_social_site('fblogging_social_google', '#', __('Follow us on Google+', 'fblogging'), 'google16' );

	fblogging_display_single_social_site('fblogging_social_twitter', '#', __('Follow us on Twitter', 'fblogging'), 'twitter16' );

	fblogging_display_single_social_site('fblogging_social_linkedin', '#', __('Follow us on LinkedIn', 'fblogging'), 'linkedin16' );

	fblogging_display_single_social_site('fblogging_social_instagram', '#', __('Follow us on Instagram', 'fblogging'), 'instagram16' );

	fblogging_display_single_social_site('fblogging_social_rss', get_bloginfo( 'rss2_url' ), __('Follow our RSS Feeds', 'fblogging'), 'rss16' );

	fblogging_display_single_social_site('fblogging_social_tumblr', '#', __('Follow us on Tumblr', 'fblogging'), 'tumblr16' );

	fblogging_display_single_social_site('fblogging_social_youtube', '#', __('Follow us on Youtube', 'fblogging'), 'youtube16' );

	fblogging_display_single_social_site('fblogging_social_pinterest', '#', __('Follow us on Pinterest', 'fblogging'), 'pinterest16' );

	fblogging_display_single_social_site('fblogging_social_vk', '#', __('Follow us on VK', 'fblogging'), 'vk16' );

	fblogging_display_single_social_site('fblogging_social_flickr', '#', __('Follow us on Flickr', 'fblogging'), 'flickr16' );

	fblogging_display_single_social_site('fblogging_social_vine', '#', __('Follow us on Vine', 'fblogging'), 'vine16' );
}

function fblogging_header_style() {

    $header_text_color = get_header_textcolor();

    if ( ! has_header_image()
        && ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color
             || 'blank' === $header_text_color ) ) {

        return;
    }

    $headerImage = get_header_image();
?>
    <style type="text/css">
        <?php if ( has_header_image() ) : ?>

                #header-main {background-image: url("<?php echo esc_url( $headerImage ); ?>");}

        <?php endif; ?>

        <?php if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color
                    && 'blank' !== $header_text_color ) : ?>

                #header-main, #header-main h1.entry-title {color: #<?php echo esc_attr( $header_text_color ); ?>;}

        <?php endif; ?>
    </style>
<?php
}

?>
