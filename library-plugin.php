<?php
/**
 * Plugin Name:       Library Plugin for WordPress
 * Plugin URI:        https://webites.pl/library-plugin
 * Description:       Plugin develop Wordpress and making from your site virtual library.
 * Version:           1.1.1
 * Requires at least: 5.7.2
 * Requires PHP:      7.4
 * Author:            weBites
 * Author URI:        https://webites.pl
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       library-plugin
 * Domain Path:       /languages
 */

// add plugin styles
 
function lpfw_plugin_add_style()
{
    $dir = plugin_dir_url(__FILE__);
    wp_enqueue_style('lpfw-style', $dir . 'public/css/lpfw-style.css', array());
}

add_action('wp_enqueue_scripts', 'lpfw_plugin_add_style', PHP_INT_MAX);

 // Register post type -book

 function lpfw_register_custom_post_type_book() {
    $labels = array(
        'name'                  => _x( 'Books', 'Post type general name', 'library-plug' ),
        'singular_name'         => _x( 'Book', 'Post type singular name', 'library-plugin' ),
        'menu_name'             => _x( 'Books', 'Admin Menu text', 'library-plugin' ),
        'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'library-plugin' ),
        'add_new'               => __( 'Add New', 'library-plugin' ),
        'add_new_item'          => __( 'Add New Book', 'library-plugin' ),
        'new_item'              => __( 'New Book', 'library-plugin' ),
        'edit_item'             => __( 'Edit Book', 'library-plugin' ),
        'view_item'             => __( 'View Book', 'library-plugin' ),
        'all_items'             => __( 'All Books', 'library-plugin' ),
        'search_items'          => __( 'Search Books', 'library-plugin' ),
        'parent_item_colon'     => __( 'Parent Books:', 'library-plugin' ),
        'not_found'             => __( 'No books found.', 'library-plugin' ),
        'not_found_in_trash'    => __( 'No books found in Trash.', 'library-plugin' ),
        'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'library-plugin' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'library-plugin' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'library-plugin' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'library-plugin' ),
        'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'library-plugin' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'library-plugin' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'library-plugin' ),
        'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'library-plugin' ),
        'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'library-plugin' ),
        'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'library-plugin' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-book',
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
 
    register_post_type( 'book', $args );
}
 
add_action( 'init', 'lpfw_register_custom_post_type_book' );

// register category taxonomy

function lpfw_register_taxonomy_of_books() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Books categories', 'taxonomy general name', 'library-plugin' ),
        'singular_name'     => _x( 'Books category', 'taxonomy singular name', 'library-plugin' ),
        'search_items'      => __( 'Search books Categories', 'library-plugin' ),
        'all_items'         => __( 'All books Categories', 'library-plugin' ),
        'parent_item'       => __( 'Parent books category', 'library-plugin' ),
        'parent_item_colon' => __( 'Parent books Category:', 'library-plugin' ),
        'edit_item'         => __( 'Edit books category', 'library-plugin' ),
        'update_item'       => __( 'Update books category', 'library-plugin' ),
        'add_new_item'      => __( 'Add New Books category', 'library-plugin' ),
        'new_item_name'     => __( 'New Books Category Name', 'library-plugin' ),
        'menu_name'         => __( 'Books Category', 'library-plugin' ),
    );
 
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'book-category' ),
    );
 
    register_taxonomy( 'book-category', array( 'book' ), $args );
 
    unset( $args );
    unset( $labels );

     // Add new taxonomy, NOT hierarchical (like tags)
     $labels = array(
        'name'                       => _x( 'Hashtags', 'taxonomy general name', 'library-plugin' ),
        'singular_name'              => _x( 'Hashtag', 'taxonomy singular name', 'library-plugin' ),
        'search_items'               => __( 'Search Hashtags', 'library-plugin' ),
        'popular_items'              => __( 'Popular Hashtags', 'library-plugin' ),
        'all_items'                  => __( 'All Hashtags', 'library-plugin' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Hashtag', 'library-plugin' ),
        'update_item'                => __( 'Update Hashtag', 'textvirtual-visit-in-librarydomain' ),
        'add_new_item'               => __( 'Add New Hashtag', 'library-plugin' ),
        'new_item_name'              => __( 'New Hashtag Name', 'library-plugin' ),
        'separate_items_with_commas' => __( 'Separate Hashtag with commas', 'library-plugin' ),
        'add_or_remove_items'        => __( 'Add or remove Hashtag', 'library-plugin' ),
        'choose_from_most_used'      => __( 'Choose from the most used Hashtag', 'library-plugin' ),
        'not_found'                  => __( 'No Hashtag found.', 'library-plugin' ),
        'menu_name'                  => __( 'Hashtag', 'library-plugin' ),
    );
 
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'book-hashtag' ),
    );
 
    register_taxonomy( 'book-hashtags', 'book', $args );

}
add_action( 'init', 'lpfw_register_taxonomy_of_books', 0 );


// single post - book - template


add_filter( 'single_template', 'lpfw_single_book_page_template' );

function lpfw_single_book_page_template( $page_template )
{
    if ( is_singular( 'book') ) {
        $page_template = dirname( __FILE__ ) . '/single-book-template.php';
    }
    return $page_template;
}


// custom fields


/**
 * Register meta box(es).
 */
function lpfw_register_book_meta_boxes() {
    add_meta_box( 'meta-box-id',
     __( 'Book parameters', 'textdomain' ), 
     'lpfw_display_table_with_options', 
     'book', 
     'side', 
     'high');
}
add_action( 'add_meta_boxes', 'lpfw_register_book_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function lpfw_display_table_with_options( $post ) {

    

    $isbn = get_post_meta( $post->ID, 'isbn', true );
    $author = get_post_meta( $post->ID, 'author', true );
    $publishing_house = get_post_meta( $post->ID, 'publishing_house', true );
    $series = get_post_meta( $post->ID, 'series', true );
    $type = get_post_meta( $post->ID, 'type', true );
    $publication_date = get_post_meta( $post->ID, 'publication_date', true );
    $pages = get_post_meta( $post->ID, 'pages', true );
    $format = get_post_meta( $post->ID, 'format', true );
    $available = get_post_meta( $post->ID, 'available', true );
    // Display code/markup goes here. Don't forget to include nonces!
    ?>
    <p>
    <div class="wrap">
    <form action="/" method="post">

        <label for="isbn"><?php _e( 'ISBN', 'library-plugin'); ?></label><BR>
        <input type="text" id="isbn" name="isbn" value="<?php echo $isbn; ?>"><BR><BR>

        <label for="author"><?php _e( 'Author', 'library-plugin'); ?></label><BR>
        <input type="text" id="author" name="author" value="<?php echo $author; ?>"><BR><BR>
        
        <label for="publishing_house"><?php _e( 'Publishing house', 'library-plugin'); ?></label><BR>
        <input type="text" id="publishing_house" name="publishing_house" value="<?php echo $publishing_house; ?>"><BR><BR>

        <label for="series"><?php _e( 'Series', 'library-plugin'); ?></label><BR>
        <input type="text" id="series" name="series" value="<?php echo $series; ?>"><BR><BR>

        <label for="type"><?php _e( 'Type', 'library-plugin'); ?></label><BR>
        <input type="text" id="type" name="type" value="<?php echo $type; ?>"><BR><BR>
        
        <label for="publication_date"><?php _e( 'Publication date', 'library-plugin'); ?></label><BR>
        <input type="text" id="publication_date" name="publication_date" value="<?php echo $publication_date; ?>"><BR><BR>
        
        <label for="pages"><?php _e( 'Pages', 'library-plugin'); ?></label><BR>
        <input type="text" id="pages" name="pages" value="<?php echo $pages; ?>"><BR><BR>
        
        <label for="format"><?php _e( 'Format', 'library-plugin'); ?></label><BR>
        <input type="text" id="format" name="format" value="<?php echo $format; ?>"><BR><BR>

        <label for="available"><?php _e( 'Available', 'library-plugin'); ?></label>
        <input type="checkbox" id="available" name="available" <?php if($available) { echo 'CHECKED'; } ?>><BR><BR>


        <?php submit_button(); ?>

    </form>
    </div>
    <?php
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function lpfw_save_meta_after_click_save_button( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $isbn = sanitize_text_field( $_POST['isbn'] );
        $author = sanitize_text_field( $_POST['author'] );
        $publishing_house = sanitize_text_field( $_POST['publishing_house'] );
        $series = sanitize_text_field( $_POST['series'] );
        $type = sanitize_text_field( $_POST['type'] );
        $publication_date = sanitize_text_field( $_POST['publication_date'] );
        $pages = sanitize_text_field( $_POST['pages'] );
        $format = sanitize_text_field( $_POST['format'] );
        $available = sanitize_text_field( $_POST['available'] );


        update_post_meta( $post_id, 'isbn', $isbn );
        update_post_meta( $post_id, 'author', $author );
        update_post_meta( $post_id, 'publishing_house', $publishing_house );
        update_post_meta( $post_id, 'series', $series );
        update_post_meta( $post_id, 'type', $type );
        update_post_meta( $post_id, 'publication_date', $publication_date );
        update_post_meta( $post_id, 'pages', $pages );
        update_post_meta( $post_id, 'format', $format );
        update_post_meta( $post_id, 'available', $available );
}
}
add_action( 'save_post', 'lpfw_save_meta_after_click_save_button' );




?>