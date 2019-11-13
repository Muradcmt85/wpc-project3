<?php
if ( ! file_exists( get_template_directory() . '/lib/class-wp-bootstrap-navwalker.php' ) ) {
    // File does not exist... return an error.
    return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
    // File exists... require it.
    require_once get_template_directory() . '/lib/class-wp-bootstrap-navwalker.php';
}



function wp_project(){


    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
    wp_enqueue_style( 'style', get_stylesheet_uri());
    
}
add_action('wp_enqueue_scripts',  'wp_project');




if ( ! function_exists( 'wpcamel_theme_setup' ) ) :

    function wpcamel_theme_setup() {


        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-logo' );
        load_theme_textdomain( 'wpcamel_lang', get_template_directory() . '/languages' );

        register_nav_menus( array(
            'primary' => __( 'Header Menu', 'wpcamel_lang' ),
        ) );

   

        function wpb_tag_cloud() { 
            $tags = get_tags();
            $args = array(
                'smallest'                  => 10, 
                'largest'                   => 22,
                'unit'                      => 'px', 
                'number'                    => 10,  
                'separator'                 => " ",
                'orderby'                   => 'count', 
                'order'                     => 'DESC',
                'show_count'                => 1,
            ); 
             
            $tag_string = wp_generate_tag_cloud( $tags, $args );
             
            return $tag_string; 
             
            } 



        
    }endif;

    add_action( 'after_setup_theme', 'wpcamel_theme_setup' );



/**
 * Register a custom post type called "book".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_book_init() {
    $labels = array(
        'name'                  => _x( 'Expense', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Expense', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Expense', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Expense', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Expense', 'textdomain' ),
        'new_item'              => __( 'New Expense', 'textdomain' ),
        'edit_item'             => __( 'Edit Expense', 'textdomain' ),
        'view_item'             => __( 'View Expense', 'textdomain' ),
        'all_items'             => __( 'All Expense', 'textdomain' ),
        'search_items'          => __( 'Search Expense', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Expense:', 'textdomain' ),
        'not_found'             => __( 'No Expense found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No Expense found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Expense Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Expense archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Expense', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter Expense list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Expense list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Expense list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'expense', 'with_front'=>false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
 
    register_post_type( 'expense', $args );

    $labels = array(
		'name'              => _x( 'Category', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Category', 'textdomain' ),
		'all_items'         => __( 'All Category', 'textdomain' ),
		'parent_item'       => __( 'Parent Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Category', 'textdomain' ),
		'update_item'       => __( 'Update Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Category', 'textdomain' ),
		'new_item_name'     => __( 'New Category Name', 'textdomain' ),
		'menu_name'         => __( 'Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'category' ),
	);

	register_taxonomy( 'category', array( 'expense','post' ), $args );
}
 
add_action( 'init', 'wpdocs_codex_book_init' );

?>