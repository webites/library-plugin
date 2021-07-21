<?php
/**
 * Plugin Name:       Virtual Library
 * Plugin URI:        https://webites.pl/virtual-library
 * Description:       Plugin develop Wordpress and making from your site virtual library.
 * Version:           1.1.3
 * Requires at least: 5.3.4
 * Requires PHP:      7.2
 * Author:            weBites
 * Author URI:        https://webites.pl
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       virtual-library
 * Domain Path:       /languages
 */


//add premium message

function lpfw_check_premium_message(){
    
    ?>
    <div id='setting-error-tgmpa' class='notice notice-warning settings-error is-dismissible'> 

    <p><strong>
        <span>
        <h3><?php _e('Virtual Library - To little options?', 'virtual-library'); ?></h3>
            </span>
            <p>
                <?php _e('We will develop this plugin for your needs. Your customers will can be explore your site easier.', 'library-plugin'); ?>
            </p>

            <span>
            <a href="https://webites.pl"><?php _e('Write us!', 'library-plugin'); ?></a> 
        </a></span>

        </strong></p>
    </div> 
    <?php
}

add_action( 'admin_notices', 'lpfw_check_premium_message');
 

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
        'name'                  => _x( 'Books', 'Post type general name', 'virtual-library' ),
        'singular_name'         => _x( 'Book', 'Post type singular name', 'virtual-library' ),
        'menu_name'             => _x( 'Books', 'Admin Menu text', 'virtual-library' ),
        'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'virtual-library' ),
        'add_new'               => __( 'Add New', 'virtual-library' ),
        'add_new_item'          => __( 'Add New Book', 'virtual-library' ),
        'new_item'              => __( 'New Book', 'virtual-library' ),
        'edit_item'             => __( 'Edit Book', 'virtual-library' ),
        'view_item'             => __( 'View Book', 'virtual-library' ),
        'all_items'             => __( 'All Books', 'virtual-library' ),
        'search_items'          => __( 'Search Books', 'virtual-library' ),
        'parent_item_colon'     => __( 'Parent Books:', 'virtual-library' ),
        'not_found'             => __( 'No books found.', 'virtual-library' ),
        'not_found_in_trash'    => __( 'No books found in Trash.', 'virtual-library' ),
        'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'virtual-library' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'virtual-library' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'virtual-library' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'virtual-library' ),
        'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'virtual-library' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'virtual-library' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'virtual-library' ),
        'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'virtual-library' ),
        'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'virtual-library' ),
        'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'virtual-library' ),
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

// end register post type


// register category taxonomy

function lpfw_register_taxonomy_of_books() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Books categories', 'taxonomy general name', 'virtual-library' ),
        'singular_name'     => _x( 'Books category', 'taxonomy singular name', 'virtual-library' ),
        'search_items'      => __( 'Search books Categories', 'virtual-library' ),
        'all_items'         => __( 'All books Categories', 'virtual-library' ),
        'parent_item'       => __( 'Parent books category', 'virtual-library' ),
        'parent_item_colon' => __( 'Parent books Category:', 'virtual-library' ),
        'edit_item'         => __( 'Edit books category', 'virtual-library' ),
        'update_item'       => __( 'Update books category', 'virtual-library' ),
        'add_new_item'      => __( 'Add New Books category', 'virtual-library' ),
        'new_item_name'     => __( 'New Books Category Name', 'virtual-library' ),
        'menu_name'         => __( 'Books Category', 'virtual-library' ),
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
        'name'                       => _x( 'Hashtags', 'taxonomy general name', 'virtual-library' ),
        'singular_name'              => _x( 'Hashtag', 'taxonomy singular name', 'virtual-library' ),
        'search_items'               => __( 'Search Hashtags', 'virtual-library' ),
        'popular_items'              => __( 'Popular Hashtags', 'virtual-library' ),
        'all_items'                  => __( 'All Hashtags', 'virtual-library' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Hashtag', 'virtual-library' ),
        'update_item'                => __( 'Update Hashtag', 'virtual-library' ),
        'add_new_item'               => __( 'Add New Hashtag', 'virtual-library' ),
        'new_item_name'              => __( 'New Hashtag Name', 'virtual-library' ),
        'separate_items_with_commas' => __( 'Separate Hashtag with commas', 'virtual-library' ),
        'add_or_remove_items'        => __( 'Add or remove Hashtag', 'virtual-library' ),
        'choose_from_most_used'      => __( 'Choose from the most used Hashtag', 'virtual-library' ),
        'not_found'                  => __( 'No Hashtag found.', 'virtual-library' ),
        'menu_name'                  => __( 'Hashtag', 'virtual-library' ),
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


// end register category and hashtag tax



// PLUGIN TEMPLATES

// single post - book - template



add_filter( 'single_template', 'lpfw_single_book_page_template' );

function lpfw_single_book_page_template( $page_template )
{
    if ( is_singular( 'book') ) {
        $page_template = dirname( __FILE__ ) . '/templates/single-book-template.php';
    }
    return $page_template;
}

// end single post templates

// category template

add_filter( "taxonomy_template", 'lpfw_category_book_page_template');
function lpfw_category_book_page_template ($tax_template) {
  if (is_tax('book-category')) {
    $tax_template = dirname(  __FILE__  ) . '/templates/category-book-template.php';
  }
  return $tax_template;
}

//end category templates

// hashtags template

add_filter( "taxonomy_template", 'lpfw_hashtags_book_page_template');
function lpfw_hashtags_book_page_template ($tax_template) {
  if (is_tax('book-hashtags')) {
    $tax_template = dirname(  __FILE__  ) . '/templates/hashtags-book-template.php';
  }
  return $tax_template;
}

//end hashtags templates


// END TEMPLATES

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

    

    $isbn = get_post_meta( $post->ID, 'lpfw_book_isbn', true );
    $author = get_post_meta( $post->ID, 'lpfw_book_author', true );
    $publishing_house = get_post_meta( $post->ID, 'lpfw_book_publishing_house', true );
    $series = get_post_meta( $post->ID, 'lpfw_book_series', true );
    $type = get_post_meta( $post->ID, 'lpfw_book_type', true );
    $publication_date = get_post_meta( $post->ID, 'lpfw_book_publication_date', true );
    $pages = get_post_meta( $post->ID, 'lpfw_book_pages', true );
    $format = get_post_meta( $post->ID, 'lpfw_book_format', true );
    $available = get_post_meta( $post->ID, 'lpfw_book_available', true );
    // Display code/markup goes here. Don't forget to include nonces!
    ?>
    <p>
    <div class="wrap">
    <form action="/" method="post">

        <label for="lpfw_book_isbn"><?php _e( 'ISBN', 'virtual-library'); ?></label><BR>
        <input type="text" id="lpfw_book_isbn" name="lpfw_book_isbn" value="<?php echo esc_html($isbn); ?>"><BR><BR>

        <label for="lpfw_book_author"><?php _e( 'Author', 'virtual-library'); ?></label><BR>
        <input type="text" id="lpfw_book_author" name="lpfw_book_author" value="<?php echo esc_html($author); ?>"><BR><BR>
        
        <label for="lpfw_book_publishing_house"><?php _e( 'Publishing house', 'virtual-library'); ?></label><BR>
        <input type="text" id="lpfw_book_publishing_house" name="lpfw_book_publishing_house" value="<?php echo esc_html($publishing_house); ?>"><BR><BR>

        <label for="lpfw_book_series"><?php _e( 'Series', 'virtual-library'); ?></label><BR>
        <input type="text" id="lpfw_book_series" name="lpfw_book_series" value="<?php echo esc_html($series); ?>"><BR><BR>

        <label for="lpfw_book_type"><?php _e( 'Type', 'virtual-library'); ?></label><BR>
        <input type="text" id="lpfw_book_type" name="lpfw_book_type" value="<?php echo esc_html($type); ?>"><BR><BR>
        
        <label for="lpfw_book_publication_date"><?php _e( 'Publication date', 'virtual-library'); ?></label><BR>
        <input type="text" id="lpfw_book_publication_date" name="lpfw_book_publication_date" value="<?php echo esc_html($publication_date); ?>"><BR><BR>
        
        <label for="lpfw_book_pages"><?php _e( 'Pages', 'virtual-library'); ?></label><BR>
        <input type="text" id="lpfw_book_pages" name="lpfw_book_pages" value="<?php echo esc_html($pages); ?>"><BR><BR>
        
        <label for="lpfw_book_format"><?php _e( 'Format', 'virtual-library'); ?></label><BR>
        <input type="text" id="lpfw_book_format" name="lpfw_book_format" value="<?php echo esc_html($format); ?>"><BR><BR>

        <label for="lpfw_book_available"><?php _e( 'Available', 'virtual-library'); ?></label>
        <input type="checkbox" id="lpfw_book_available" name="lpfw_book_available" <?php if($available) { echo 'CHECKED'; } ?>><BR><BR>


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
        $isbn = sanitize_text_field( $_POST['lpfw_book_isbn'] );
        $author = sanitize_text_field( $_POST['lpfw_book_author'] );
        $publishing_house = sanitize_text_field( $_POST['lpfw_book_publishing_house'] );
        $series = sanitize_text_field( $_POST['lpfw_book_series'] );
        $type = sanitize_text_field( $_POST['lpfw_book_type'] );
        $publication_date = sanitize_text_field( $_POST['lpfw_book_publication_date'] );
        $pages = sanitize_text_field( $_POST['lpfw_book_pages'] );
        $format = sanitize_text_field( $_POST['lpfw_book_format'] );
        $available = sanitize_text_field( $_POST['lpfw_book_available'] );


        update_post_meta( $post_id, 'lpfw_book_isbn', $isbn );
        update_post_meta( $post_id, 'lpfw_book_author', $author );
        update_post_meta( $post_id, 'lpfw_book_publishing_house', $publishing_house );
        update_post_meta( $post_id, 'lpfw_book_series', $series );
        update_post_meta( $post_id, 'lpfw_book_type', $type );
        update_post_meta( $post_id, 'lpfw_book_publication_date', $publication_date );
        update_post_meta( $post_id, 'lpfw_book_pages', $pages );
        update_post_meta( $post_id, 'lpfw_book_format', $format );
        update_post_meta( $post_id, 'lpfw_book_available', $available );
}
}
add_action( 'save_post', 'lpfw_save_meta_after_click_save_button' );


// end custom fields

?>