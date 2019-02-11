<?php
/**
 * panch functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package panch
 */

if ( ! function_exists( 'panch_setup' ) ) :
	function panch_setup() {
		load_theme_textdomain( 'panch', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'panch' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		// add_theme_support( 'custom-background', apply_filters( 'panch_custom_background_args', array(
		// 	'default-color' => 'ffffff',
		// 	'default-image' => '',
		// ) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		// add_theme_support( 'custom-logo', array(
		// 	'height'      => 250,
		// 	'width'       => 250,
		// 	'flex-width'  => true,
		// 	'flex-height' => true,
		// ) );
	}
endif;
add_action( 'after_setup_theme', 'panch_setup' );


add_filter( 'embed_oembed_html', 'wrap_oembed_html', 99, 4 );

function wrap_oembed_html( $cached_html, $url, $attr, $post_id ) {
    return '<div class="responsive-video">' . $cached_html . '</div>';
}
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function panch_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'panch_content_width', 640 );
}
add_action( 'after_setup_theme', 'panch_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function panch_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'panch' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'panch' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'Footer',
		'id' => 'footer-1',
		'description' => 'Footer Area'
	) );
}
add_action( 'widgets_init', 'panch_widgets_init' );

add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

		$title = single_cat_title( '', false );

	} elseif ( is_tag() ) {

		$title = single_tag_title( '', false );

	} elseif ( is_author() ) {

		$title = '<span class="vcard">' . get_the_author() . '</span>' ;

	}

    return $title;

});
// add_filter('caldera_forms_render_grid_settings', 'setup_foundation_grid', 10, 2);
function setup_foundation_grid($grid, $form){
	$grid_sizes = array(
		'xs'	=>	'small',
		'sm'	=>	'small',
		'md'	=>	'medium',
		'lg'	=>	'large',
	);
	$grid_size = $grid_sizes[ $form['settings']['responsive']['break_point'] ];
	$grid['column_before'] = '<div %1$s data-justToSee="" class="' . $grid_size . '-%2$d form-column cell %3$s" style="min-height: 1px;">';
	$grid['before'] = '<div %1$s class="grid-x grid-padding-x %2$s">';

	return $grid;
}
/**
 * Enqueue scripts and styles.
 */
function panch_scripts() {
	wp_enqueue_style( 'panch-style', get_stylesheet_uri() );
	wp_enqueue_style( 'panch-master-styles', get_template_directory_uri() . '/assets/css/styles.css?v=3' );

	wp_enqueue_script( 'jquery3.3.1', get_template_directory_uri() . '/assets/js/vendor/jquery-3.3.1.min.js', array(), '3.3.1', false );
	wp_enqueue_script( 'parallax', get_template_directory_uri() . '/assets/js/vendor/parallax-1.5.0.min.js', array('jquery3.3.1'), '1.5.0', false );
	wp_enqueue_script( 'particle', get_template_directory_uri() . '/assets/js/vendor/particles-2.0.0.min.js', array('jquery3.3.1'), '2.2.2', false );
	wp_enqueue_script( 'master', get_template_directory_uri() . '/assets/js/master.js', array('jquery3.3.1'), '1', false );
}
add_action( 'wp_enqueue_scripts', 'panch_scripts' );
add_post_type_support( 'page', 'excerpt' );

// function panch_home_add_meta_box() {
//     global $post;
//     if ( 'page-home.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
//         add_meta_box( $args );
//     }
// }
// add_action( 'add_meta_boxes_page', 'panch_home_add_meta_box' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';


// Register and load the widget
function wpb_load_widget() {
    register_widget( 'footer_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the widget
class Footer_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'footer_widget',
			__('Footer Contact', 'footer_widget_domain'),
			array( 'description' => __( 'Enter the contact info', 'footer_widget_domain' ), )
		);
	}

	// Creating widget front-end

	public function widget( $args, $instance ) {
		?>
		<div class="cell">
			<h3><?php echo $instance['title']; ?></h3>
		</div>
		<div class="cell clearfix">
			<div class="info float-left clearfix">
				<div class="address">
					<?php echo $instance['address-ln1']; ?><br/>
					<?php echo $instance['address-ln2']; ?><br/>
					<?php echo $instance['address-city']; ?>
				</div>
				<div class="contact">
					<ul class="menu">
						<li class="phone">
							<b>Phone</b><br/>
							<a href="tel:<?php echo $instance['phone']; ?>"><?php echo $instance['phone']; ?></a>
						</li>
						<!-- <li class="fax">
							<b>Fax</b><br/>
							<a href="tel:<?php //echo $instance['fax']; ?>"><?php //echo $instance['fax']; ?></a>
						</li> -->
						<li class="email">
							<b>Email</b><br/>
							<a href="mailTo:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="contact-btn float-right">
				<a href="/contact-us/" class="hollow button">Contact Us &raquo;</a>
			</div>
		</div>
		<?php
	}

	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = '';
		}
		if ( isset( $instance[ 'address-ln1' ] ) ) {
			$address_ln1 = $instance[ 'address-ln1' ];
		} else {
			$address_ln1 = '';
		}
		if ( isset( $instance[ 'address-ln2' ] ) ) {
			$address_ln2 = $instance[ 'address-ln2' ];
		} else {
			$address_ln2 = '';
		}
		if ( isset( $instance[ 'address-city' ] ) ) {
			$address_city = $instance[ 'address-city' ];
		} else {
			$address_city = '';
		}
		if ( isset( $instance[ 'phone' ] ) ) {
			$phone = $instance[ 'phone' ];
		} else {
			$phone = '';
		}
		// if ( isset( $instance[ 'fax' ] ) ) {
		// 	$fax = $instance[ 'fax' ];
		// } else {
		// 	$fax = '';
		// }
		if ( isset( $instance[ 'email' ] ) ) {
			$email = $instance[ 'email' ];
		} else {
			$email = '';
		}
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" placeholder="Footer Title" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'address-ln1' ); ?>"><?php _e( 'Address Line 1:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'address-ln1' ); ?>" name="<?php echo $this->get_field_name( 'address-ln1' ); ?>" type="text" placeholder="123 W South St" value="<?php echo esc_attr( $address_ln1 ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'address-ln2' ); ?>"><?php _e( 'Address Line 2:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'address-ln2' ); ?>" name="<?php echo $this->get_field_name( 'address-ln2' ); ?>" type="text" placeholder="PO BOX 123" value="<?php echo esc_attr( $address_ln2 ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'address-city' ); ?>"><?php _e( 'City, State, Zip:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'address-city' ); ?>" name="<?php echo $this->get_field_name( 'address-city' ); ?>" type="text" placeholder="City, ST 88888" value="<?php echo esc_attr( $address_city ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="tel" placeholder="(111) 111-1111" value="<?php echo esc_attr( $phone ); ?>" />
		</p>
		<!-- <p>
			<label for="<?php //echo $this->get_field_id( 'fax' ); ?>"><?php //_e( 'Fax:' ); ?></label>
			<input class="widefat" id="<?php// echo $this->get_field_id( 'fax' ); ?>" name="<?php //echo $this->get_field_name( 'fax' ); ?>" type="tel" placeholder="(111) 111-1111" value="<?php //echo esc_attr( $fax ); ?>" />
		</p> -->
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="email" placeholder="email@example.com" value="<?php echo esc_attr( $email ); ?>" />
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['address-ln1'] = ( ! empty( $new_instance['address-ln1'] ) ) ? strip_tags( $new_instance['address-ln1'] ) : '';
		$instance['address-ln2'] = ( ! empty( $new_instance['address-ln2'] ) ) ? strip_tags( $new_instance['address-ln2'] ) : '';
		$instance['address-city'] = ( ! empty( $new_instance['address-city'] ) ) ? strip_tags( $new_instance['address-city'] ) : '';
		$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
		// $instance['fax'] = ( ! empty( $new_instance['fax'] ) ) ? strip_tags( $new_instance['fax'] ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
		return $instance;
	}
} // Class wpb_widget ends here

add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function enqueue_load_fa() {
 
    wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
}
function panch_breadcrumbs() {
    $show_on_homepage = 0;
    $show_current = 1;
    $delimiter = '&raquo;';
    $home_url = 'Home';
    $before_wrap = '<span clas="current">';
    $after_wrap = '</span>';
    
    /* Don't change values below */
    global $post;
    $home_url = get_bloginfo( 'url' );
    /* Check for homepage first! */
    if ( is_home() || is_front_page() ) {
        $on_homepage = 1;
    }
    if ( 0 === $show_on_homepage && 1 === $on_homepage ) return;
    
    /* Proceed with showing the breadcrumbs */
    $breadcrumbs = '<ol id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList">';
    
    $breadcrumbs .= '<li itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a target="_blank" href="' . $home_url . '">' . $home_url . '</a></li>';
    
    /* Build breadcrumbs here */
    
    $breadcrumbs .= '</ol>';
    
    echo $breadcrumbs;
}
