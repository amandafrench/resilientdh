<?php
/**
 * Clean Lite Theme Customizer
 *
 * @package Clean Lite
 */
 
function clean_lite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'clean_lite_custom_header_args', array(
		'default-text-color'     => 'fff',
		'width'                  => 1600,
		'height'                 => 200,
		'wp-head-callback'       => 'clean_lite_header_style',
 		'default-text-color' => false,
 		'header-text' => false,
	) ) );
}
add_action( 'after_setup_theme', 'clean_lite_custom_header_setup' );

if ( ! function_exists( 'clean_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see clean_lite_custom_header_setup().
 */
function clean_lite_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() ) :
	?>
		.header {
			background: url(<?php echo get_header_image(); ?>) no-repeat;
			background-position: center top;
		}
	<?php endif; ?>	
	</style>
	<?php
}
endif; // clean_lite_header_style 

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_lite_customize_register( $wp_customize ) {
	
	//Add a class for titles
    class clean_lite_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#31cafd',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => esc_html__('Color Scheme','clean-lite'),			
			 'description'	=> esc_html__('More color options in PRO Version','clean-lite'),	
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	// Slider Section		
	$wp_customize->add_section( 'slider_section', array(
            'title' => esc_html__('Slider Settings', 'clean-lite'),
            'priority' => null,
            'description'	=> esc_html__('Featured Image Size Should be ( 1400x530 ) More slider settings available in PRO Version [ This only work when static front page is selected. ]','clean-lite'),		
        )
    );
	
	
	$wp_customize->add_setting('page-setting7',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'clean_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide one:','clean-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'clean_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide two:','clean-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'clean_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide three:','clean-lite'),
			'section'	=> 'slider_section'
	));	// Slider Section
	
	//Slider hide
	$wp_customize->add_setting('hide_slides',array(
			'sanitize_callback' => 'sanitize_text_field',
	));	 

	$wp_customize->add_control( 'hide_slides', array(
    	   'section'   => 'slider_section',    	 
		   'label'	=> esc_html__('Hide Slider','clean-lite'),
    	   'type'      => 'checkbox'
     )); // Slider Section	
	
	
	// Home Three Boxes Section 	
	$wp_customize->add_section('section_second', array(
		'title'	=> esc_html__('Homepage Four Boxes Section','clean-lite'),
		'description'	=> esc_html__('Select Pages from the dropdown for homepage four boxes section [ This only work
when static front page is selected. ]','clean-lite'),
		'priority'	=> null
	));	
	
	
	$wp_customize->add_setting('page-column1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'clean_lite_sanitize_integer',
		));
 
	$wp_customize->add_control(	'page-column1',array('type' => 'dropdown-pages',
			'section' => 'section_second',
	));	
	
	
	$wp_customize->add_setting('page-column2',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',		
			'sanitize_callback' => 'clean_lite_sanitize_integer',
		));
 
	$wp_customize->add_control(	'page-column2',array('type' => 'dropdown-pages',
			'section' => 'section_second',
	));
	
	$wp_customize->add_setting('page-column3',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',		
			'sanitize_callback' => 'clean_lite_sanitize_integer',
		));
 
	$wp_customize->add_control(	'page-column3',array('type' => 'dropdown-pages',
			'section' => 'section_second',
	));
	
	$wp_customize->add_setting('page-column4',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',		
			'sanitize_callback' => 'clean_lite_sanitize_integer',
		));
 
	$wp_customize->add_control(	'page-column4',array('type' => 'dropdown-pages',
			'section' => 'section_second',
	));	//end three column part
	
	//Hide Page Boxes Column Section
	$wp_customize->add_setting('hide_pagefourboxes',array(
			'sanitize_callback' => 'sanitize_text_field',
	));	 

	$wp_customize->add_control( 'hide_pagefourboxes', array(
    	   'section'   => 'section_second',    	 
		   'label'	=> esc_html__('Hide four column page boxes','clean-lite'),
    	   'type'      => 'checkbox'
     )); // Hide Page Boxes Column Section	
	
	// Home Welcome Section 	
	$wp_customize->add_section('section_first',array(
		'title'	=> esc_html__('Homepage Welcome Section','clean-lite'),
		'description'	=> esc_html__('Select Page from the dropdown for first section [ This only work
when static front page is selected. ]','clean-lite'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting('page-setting1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',		
			'sanitize_callback' => 'clean_lite_sanitize_integer',
		));
 
	$wp_customize->add_control(	'page-setting1',array('type' => 'dropdown-pages',
			'section' => 'section_first',
	));
	
	//Hide Welcome Section
	$wp_customize->add_setting('hide_welcome',array(
			'sanitize_callback' => 'sanitize_text_field',
	));	 

	$wp_customize->add_control( 'hide_welcome', array(
    	   'section'   => 'section_first',    	 
		   'label'	=> esc_html__('Hide Home Welcome Section','clean-lite'),
    	   'type'      => 'checkbox'
     )); // Hide Welcome Section	
	
	$wp_customize->add_section('social_sec',array(
			'title'	=> esc_html__('Social Settings','clean-lite'),				
			'description'	=> esc_html__('More social icon available in PRO Version','clean-lite'),		
			'priority'		=> null
	));
	
	
	$wp_customize->add_setting('fb_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('fb_link',array(
			'label'	=> esc_html__('Add facebook link here','clean-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'fb_link'
	));	
	$wp_customize->add_setting('twitt_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('twitt_link',array(
			'label'	=> esc_html__('Add twitter link here','clean-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'twitt_link'
	));
	$wp_customize->add_setting('gplus_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('gplus_link',array(
			'label'	=> esc_html__('Add google plus link here','clean-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'gplus_link'
	));
	$wp_customize->add_setting('linked_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('linked_link',array(
			'label'	=> esc_html__('Add linkedin link here','clean-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'linked_link'
	));
	
	$wp_customize->add_section('footer_area',array(
			'title'	=> esc_html__('Footer Area','clean-lite'),
			'priority'	=> null
	));
	$wp_customize->add_setting('clean_lite_options[credit-info]', array(
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
        )
    );
	
    $wp_customize->add_control( new clean_lite_Info( $wp_customize, 'cred_section', array(
        'section' => 'footer_area',
        'settings' => 'clean_lite_options[credit-info]'
        ) )
    );
	
	$wp_customize->add_setting('menu_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('menu_title',array(
			'label'	=> esc_html__('Add title for menu','clean-lite'),
			'section'	=> 'footer_area',
			'setting'	=> 'menu_title'
	));	
	
	$wp_customize->add_setting('newsfeed_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('newsfeed_title',array(
			'label'	=> esc_html__('Add title for latest news feed','clean-lite'),
			'section'	=> 'footer_area',
			'setting'	=> 'newsfeed_title'
	));	
	
	$wp_customize->add_setting('about_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('about_title',array(
			'label'	=> esc_html__('Add title for about us','clean-lite'),
			'section'	=> 'footer_area',
			'setting'	=> 'about_title'
	));	
		
	$wp_customize->add_setting( 'about_description', array(
			'default'	=> null,				
			'sanitize_callback' => 'esc_textarea',
	) );

	$wp_customize->add_control( 'about_description', array(
			'type' => 'textarea',
			'label' => esc_html__( 'About Description', 'clean-lite' ),   
			'section' => 'footer_area',   
			'setting'	=> 'about_description',
	) );
	
	$wp_customize->add_setting('contact_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('contact_title',array(
			'label'	=> esc_html__('Add title for footer contact info','clean-lite'),
			'section'	=> 'footer_area',
			'setting'	=> 'contact_title'
	));
	
	$wp_customize->add_section('contact_sec',array(
			'title'	=> esc_html__('Contact Details','clean-lite'),
			'description'	=> esc_html__('Add you contact details here','clean-lite'),
			'priority'	=> null
	));	
	
	
	$wp_customize->add_setting('contact_add',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_textarea',
	));
	
	$wp_customize->add_control(	'contact_add', array(
				'type' => 'textarea',
				'label'	=> esc_html__('Add contact address here','clean-lite'),
				'section'	=> 'contact_sec',
				'setting'	=> 'contact_add'
	));
	$wp_customize->add_setting('contact_no',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('contact_no',array(
			'label'	=> esc_html__('Add contact number here.','clean-lite'),
			'section'	=> 'contact_sec',
			'setting'	=> 'contact_no'
	));
	$wp_customize->add_setting('contact_mail',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_email'
	));
	
	$wp_customize->add_control('contact_mail',array(
			'label'	=> esc_html__('Add you email here','clean-lite'),
			'section'	=> 'contact_sec',
			'setting'	=> 'contact_mail'
	));
	 
    $wp_customize->add_setting('clean_lite_options[layout-info]', array(
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new clean_lite_Info( $wp_customize, 'layout_section', array(
        'section' => 'theme_layout_sec',
        'settings' => 'clean_lite_options[layout-info]',
        'priority' => null
        ) )
    );
	  
    $wp_customize->add_setting('clean_lite_options[font-info]', array(
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new clean_lite_Info( $wp_customize, 'font_section', array(
        'section' => 'theme_font_sec',
        'settings' => 'clean_lite_options[font-info]',
        'priority' => null
        ) )
    );	
	  
    $wp_customize->add_setting('clean_lite_options[info]', array(
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new clean_lite_Info( $wp_customize, 'doc_section', array(
        'section' => 'theme_doc_sec',
        'settings' => 'clean_lite_options[info]',
        'priority' => 10
        ) )
    );		
}
add_action( 'customize_register', 'clean_lite_customize_register' );

//Integer
function clean_lite_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function clean_lite_custom_css(){
		?>
        	<style type="text/css"> 
					
					a, .blog_lists h2 a:hover,
					#sidebar ul li a:hover,
					.fourbox:hover h3,
					.cols-4 ul li a:hover, .cols-4 ul li.current_page_item a,					
					.phone-no strong,					
					.left a:hover						
					{ color:<?php echo esc_attr(get_theme_mod('color_scheme','#31cafd')); ?>;}
					 
					
					.pagination .nav-links span.current, .pagination .nav-links a:hover,
					#commentform input#submit:hover,
					.slide_info .slide_more,
					.fourbox:hover .thumbbx,					
					.nivo-controlNav a.active,				
					h3.widget-title,				
					.wpcf7 input[type='submit'],					
					.services-wrap .one_third:hover,
					.sitenav ul li a:hover, .sitenav ul li.current_page_item a,
					.headertop .social-icons a:hover,
					a.ReadMore
					{ background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#31cafd')); ?>;}
					
						
					.testclass
					{ border-color:<?php echo esc_attr(get_theme_mod('color_scheme','#31cafd')); ?>;}
					
			</style> 
<?php      
}
         
add_action('wp_head','clean_lite_custom_css');	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function clean_lite_customize_preview_js() {
	wp_enqueue_script( 'clean_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'clean_lite_customize_preview_js' );