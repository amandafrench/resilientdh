<?php   
/**
 * Clean Lite functions and definitions
 *
 * @package Clean Lite
*/

function clean_lite_trim_all_excerpt($text) {
$excerpt_length = apply_filters('excerpt_length', 20);
$excerpt_more = apply_filters('excerpt_more', ' ' . '...');
$text = wp_trim_words( $text, $excerpt_length, $excerpt_more ); //since wp3.3
return apply_filters('clean_lite_trim_excerpt', $text); //since wp3.3
}
remove_filter('get_the_excerpt', 'clean_lite_trim_excerpt');
add_filter('get_the_excerpt', 'clean_lite_trim_all_excerpt');
 

/**
 * Set the content width based on the theme's design and stylesheet.
*/

if ( ! function_exists( 'clean_lite_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function clean_lite_setup() {
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'clean-lite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
		add_theme_support( 'custom-logo', array(
		'height'      => 25,
		'width'       => 150,
		'flex-height' => true,
	) );	
	add_theme_support( 'custom-header', array( 'header-text' => false ) );
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'clean-lite' ),
		'footer' => esc_html__( 'Footer Menu', 'clean-lite' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // clean_lite_setup
add_action( 'after_setup_theme', 'clean_lite_setup' );


function clean_lite_widgets_init() { 	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'clean-lite' ),
		'description'   => esc_html__( 'Appears on blog page sidebar', 'clean-lite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '',		
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );	
	
}
add_action( 'widgets_init', 'clean_lite_widgets_init' );


function clean_lite_font_url(){
		$font_url = '';		
		
		/* Translators: If there are any character that are not
		* supported by Roboto Condensed, trsnalate this to off, do not
		* translate into your own language.
		*/
		$roboto_condensed = _x('on','roboto_condensed:on or off','clean-lite');		
		
		
		/* Translators: If there has any character that are not supported 
		*  by Scada, translate this to off, do not translate
		*  into your own language.
		*/
		$scada = _x('on','Scada:on or off','clean-lite');	
		
		if('off' !== $roboto_condensed ){
			$font_family = array();
			
			if('off' !== $roboto_condensed){
				$font_family[] = 'Roboto Condensed:300,400,600,700,800,900';
			}
					
						
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}


function clean_lite_scripts() {
	wp_enqueue_style('clean-lite-font', clean_lite_font_url(), array());
	wp_enqueue_style( 'clean-lite-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'clean-lite-editor-style', get_template_directory_uri()."/editor-style.css" );
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri()."/css/nivo-slider.css" );
	wp_enqueue_style( 'clean-lite-main-style', get_template_directory_uri()."/css/responsive.css" );		
	wp_enqueue_style( 'clean-lite-base-style', get_template_directory_uri()."/css/style_base.css" );
	wp_enqueue_script( 'jquery-nivo', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'clean-lite-custom-js', get_template_directory_uri() . '/js/custom.js' );	
		

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clean_lite_scripts' );

define('SKT_URL','https://www.sktthemes.net','clean-lite');
define('SKT_PRO_THEME_URL','https://www.sktthemes.net/shop/clean-multipurpose-wordpress-theme/','clean-lite');
define('SKT_FREE_THEME_URL','https://www.sktthemes.net/shop/free-clean-wordpress-theme/','clean-lite');
define('SKT_THEME_DOC','http://sktthemesdemo.net/documentation/clean-doc/','clean-lite');
define('SKT_LIVE_DEMO','http://sktthemesdemo.net/clean/','clean-lite');
define('SKT_THEMES','https://www.sktthemes.net/themes/','clean-lite');

/**
 * Custom template for about theme.
 */
require get_template_directory() . '/inc/about-themes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require_once get_template_directory() . '/customize-pro/example-1/class-customize.php';

// get slug by id
function clean_lite_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}

if ( ! function_exists( 'clean_lite_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function clean_lite_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;