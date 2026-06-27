<?php
/**
 * TRM_Portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TRM_Portfolio
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function trm_portfolio_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on TRM_Portfolio, use a find and replace
		* to change 'trm_portfolio' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'trm_portfolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'trm_portfolio' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'trm_portfolio_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'trm_portfolio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function trm_portfolio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'trm_portfolio_content_width', 640 );
}
add_action( 'after_setup_theme', 'trm_portfolio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function trm_portfolio_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'trm_portfolio' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'trm_portfolio' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'trm_portfolio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function trm_portfolio_scripts() {
	wp_enqueue_style( 'trm_portfolio-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'trm_portfolio-style', 'rtl', 'replace' );

	wp_enqueue_script( 'trm_portfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'trm_portfolio_scripts' );

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
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function year_shortcode () {
	$year = date_i18n ('Y');
	return $year;
	}
	add_shortcode ('year', 'year_shortcode');



/* == Custom Post type start*/
function cw_post_type_project() {

	$supports = array(
	'title', // post title
	'editor', // post content
	'author', // post author
	'thumbnail', // featured images
	'excerpt', // post excerpt
	'custom-fields', // custom fields
	'revisions', // post revisions
	'post-formats', // post formats
	);

	$labels = array(
	'name' => _x('Projects', 'plural'),
	'singular_name' => _x('Project', 'singular'),
	'menu_name' => _x('Projects', 'admin menu'),
	'name_admin_bar' => _x('Projects', 'admin bar'),
	'add_new' => _x('Add New', 'add new'),
	'add_new_item' => __('Add New Project'),
	'new_item' => __('New project'),
	'edit_item' => __('Edit project'),
	'view_item' => __('View project'),
	'all_items' => __('All projects'),
	'search_items' => __('Search project'),
	'not_found' => __('No project found.'),
	);

	$args = array(
	'supports' => $supports,
	'labels' => $labels,
	'public' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'projects'),
	'has_archive' => true,
	'hierarchical' => false,
	'publicly_queryable' => true,
	'show_in_rest' => true,
    'taxonomies' => array( 'category' ),
	);

	register_post_type('project', $args);
}

add_action('init', 'cw_post_type_project');
/*Custom Post type end*/

add_filter( 'acf_photo_gallery_caption_from_attachment', '__return_true' );

add_action( 'pre_get_posts', function ($query) {
    if ( ! is_admin() && is_archive('project') && $query->is_main_query() ) {
        $query->set( 'posts_per_page', 100 );
    }
});

add_shortcode( 'home_portfolio', 'portfolio_query' );
function portfolio_query(){
ob_start();

if( !is_admin() ){

// return "hi";

$args2 = array(
	'post_type' => 'project', 
	'posts_per_page' => '9');

$port_query = new WP_Query($args2);

?>
<div class="hp projects">
<?php

	/* Start the Loop */

while ( $port_query->have_posts() ) : $port_query->the_post();?>

	<section class="project archive-project" style="background-image:url(<?php the_post_thumbnail_url(); ?>)"><h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h2></section>

	<?php endwhile; ?>

</div>

<?php } 
return ob_get_clean(); }

function new_footer_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar', 'textdomain' ),
		'id'            => 'footer-sidebar-1',
		'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'new_footer_sidebar' );

function my_scripts_method() {
wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'my_scripts_method');

