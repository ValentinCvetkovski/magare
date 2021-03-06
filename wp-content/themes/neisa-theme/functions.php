<?php
/**
 * neisa-theme functions and definitions
 *
 * @package neisa-theme
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'neisa_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function neisa_theme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on neisa-theme, use a find and replace
	 * to change 'neisa-theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'neisa-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	include_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'neisa-theme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'neisa_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // neisa_theme_setup
add_action( 'after_setup_theme', 'neisa_theme_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function neisa_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'neisa-theme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'neisa_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function neisa_theme_scripts() {
	wp_enqueue_style( 'neisa-theme-style', get_template_directory_uri() . '/css/main.css' );

	wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '3.0.1', true );
    wp_enqueue_script( 'bootstrap-js' );

    wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'neisa-main-js', get_template_directory_uri() . '/js/all.js', array( 'jquery' ), '20120206', true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }

}
add_action( 'wp_enqueue_scripts', 'neisa_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
// require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// require get_template_directory() . '/inc/jetpack.php';













/* put this in a PLUGIN */
/** Custom post types for neisa theme */
function neisa_custom_posttypes() {

	$statement = array(
		'description'         => __( 'Statement', 'neisa-theme' ),
		'labels'            => array(
			'name'                => __( 'Statement', 'neisa-theme' ),
			'singular_name'       => __( 'Statement', 'neisa-theme' ),
			'all_items'           => __( 'Statement', 'neisa-theme' ),
			'new_item'            => __( 'New Statement', 'neisa-theme' ),
			'add_new'             => __( 'Add New', 'neisa-theme' ),
			'add_new_item'        => __( 'Add New Statement', 'neisa-theme' ),
			'edit_item'           => __( 'Edit Statement', 'neisa-theme' ),
			'view_item'           => __( 'View Statement', 'neisa-theme' ),
			'search_items'        => __( 'Search Statement', 'neisa-theme' ),
			'not_found'           => __( 'No Statement found', 'neisa-theme' ),
			'not_found_in_trash'  => __( 'No Statement found in trash', 'neisa-theme' ),
			'parent_item_colon'   => __( 'Parent Statement', 'neisa-theme' ),
			'menu_name'           => __( 'Statement', 'neisa-theme' ),
		),
		'menu_position'     => 4,
		'menu_icon'			=> 'dashicons-slides',
		'capability_type' 	=> 'post',
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title' /*, 'editor', 'thumbnail', 'excerpt'*/ ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
	);

	$employees = array(
			'description'         => __( 'employees', 'neisa-theme' ),
			'labels'            => array(
				'name'                => __( 'employees', 'neisa-theme' ),
				'singular_name'       => __( 'employees', 'neisa-theme' ),
				'all_items'           => __( 'employees', 'neisa-theme' ),
				'new_item'            => __( 'New employees', 'neisa-theme' ),
				'add_new'             => __( 'Add New', 'neisa-theme' ),
				'add_new_item'        => __( 'Add New employees', 'neisa-theme' ),
				'edit_item'           => __( 'Edit employees', 'neisa-theme' ),
				'view_item'           => __( 'View employees', 'neisa-theme' ),
				'search_items'        => __( 'Search employees', 'neisa-theme' ),
				'not_found'           => __( 'No employees found', 'neisa-theme' ),
				'not_found_in_trash'  => __( 'No employees found in trash', 'neisa-theme' ),
				'parent_item_colon'   => __( 'Parent employees', 'neisa-theme' ),
				'menu_name'           => __( 'employees', 'neisa-theme' ),
			),
			'menu_position'     => 5,
			'menu_icon'			=> 'dashicons-groups',
			'capability_type' 	=> 'post',
			'public'            => true,
			'hierarchical'      => false,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive'       => true,
			'rewrite'           => true,
			'query_var'         => true,
		);


	register_post_type( 'statement', $statement );
	register_post_type( 'employees', $employees );

}
add_action( 'init', 'neisa_custom_posttypes' );




/** Add Thumbnails in Manage Posts/Pages List */
if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {

    // for post and page
    add_theme_support('post-thumbnails', array( 'post', 'page' ) );

    function AddThumbColumn($cols) {

        $cols['thumbnail'] = __('Thumbnail');

        return $cols;
    }

    function AddThumbValue($column_name, $post_id) {

            $width = (int) 60;
            $height = (int) 60;

            if ( 'thumbnail' == $column_name ) {
                // thumbnail of WP 2.9
                $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
                // image from gallery
                $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
                if ($thumbnail_id)
                    $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
                elseif ($attachments) {
                    foreach ( $attachments as $attachment_id => $attachment ) {
                        $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
                    }
                }
                    if ( isset($thumb) && $thumb ) {
                        echo $thumb;
                    } else {
                        echo __('None');
                    }
            }
    }

    // for posts
    add_filter( 'manage_posts_columns', 'AddThumbColumn' );
    add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );

    // for pages
    add_filter( 'manage_pages_columns', 'AddThumbColumn' );
    add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
}

