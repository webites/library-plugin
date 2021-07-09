<?php

get_header();


the_post($post);

$title = get_the_title();
$excerpt = get_the_excerpt();
$excerpt = substr($excerpt, 0, 100);
$excerpt .= '...';

?>

<h1 class="lpfw_header1"><?php echo $title; ?></h1>

<div class="lpfw_books_categories_block">
    <h3>
        <?php _e( 'Books Categories', 'library-plugin') ?>
    </h3>
    <div class="lpfw_books_categories">
    <?php
    $categories = get_the_terms( $post->ID, 'book-category' ); 
    if(!empty($categories)){
        foreach($categories as $term){
            $link = get_term_link($term->term_id);
            echo '
            <div>
            <a href="' . $link . '" class="button lpfw_single_button" title="' . $term->name .'">
            ' . $term->name . '
            </a>
            </div>';
        }
    } else {
        _e ('Book have no category', 'library-plugin');
    }
    ?>
    </div>
</div>


<div class="lpfw_books_hashtags_block">
    <h3>
        <?php _e( 'Hashtags', 'library-plugin') ?>
    </h3>
    <div class="lpfw_books_hashtags">
    <?php
    $hashtags = get_the_terms( $post->ID, 'book-hashtags' ); 
    if(!empty($hashtags)){
        foreach($hashtags as $hashtag){
            $link = get_term_link($hashtag->term_id);
            echo '
            <div>
            <a href="' . $link . '" class="button lpfw_single_button" title="' . $hashtag->name .'">
            ' . $hashtag->name . '
            </a>
            </div>';
        }
    } else {
        _e ('Book have no hashtags', 'library-plugin');
    }
    ?>
    </div>
</div>


    <?php 
    if($excerpt){
        ?>
        <div class="lpfw_single_excerpt">

        <p>
        <?php echo $excerpt; ?>
        </p>

        </div>
        <?php
    }
    ?>

        <div class="lpfw_table_of_parameters">

        <?php 
        $id = get_the_ID();

        $isbn = get_post_meta( $id, 'lpfw_book_isbn', true );
        $author = get_post_meta( $post->ID, 'lpfw_book_author', true );
        $publishing_house = get_post_meta( $post->ID, 'lpfw_book_publishing_house', true );
        $series = get_post_meta( $post->ID, 'lpfw_book_series', true );
        $type = get_post_meta( $post->ID, 'lpfw_book_type', true );
        $publication_date = get_post_meta( $post->ID, 'lpfw_book_publication_date', true );
        $pages = get_post_meta( $post->ID, 'lpfw_book_pages', true );
        $format = get_post_meta( $post->ID, 'lpfw_book_format', true );
        $available = get_post_meta( $post->ID, 'lpfw_book_available', true );

        if(!empty($available)) {
            $available = __('Available', 'library-plugin');
        } else {
            $available = __('Not available', 'library-plugin');
        }

        $e_isbn = __('ISBN', 'library-plugin');
        $e_author = __('Author', 'library-plugin');
        $e_publishing_house = __('Publishing house', 'library-plugin');
        $e_series = __('Series', 'library-plugin');
        $e_type = __('Type', 'library-plugin');
        $e_publication_date = __('Publication date', 'library-plugin');
        $e_pages = __('Number of pages', 'library-plugin');
        $e_format = __('Format', 'library-plugin');
        $e_available = __('Available', 'library-plugin');

        ?>

        <div class="lpfw_table_of_parameters_single">
        <?php echo $e_isbn . ': <BR><span class="lpfw_table_of_parameters_single_bigger">'; echo esc_html( $isbn ); echo '</span>'; ?>
        </div>

        <div class="lpfw_table_of_parameters_single">
        <?php echo $e_author . ': <BR><span class="lpfw_table_of_parameters_single_bigger">'; echo esc_html( $author ); echo '</span>'; ?>
        </div>

        <div class="lpfw_table_of_parameters_single">
        <?php echo $e_publishing_house . ': <BR><span class="lpfw_table_of_parameters_single_bigger">'; echo esc_html( $publishing_house ); echo '</span>'; ?>
        </div>

        <div class="lpfw_table_of_parameters_single">
        <?php echo $e_series . ': <BR><span class="lpfw_table_of_parameters_single_bigger">'; echo esc_html( $series ); echo '</span>'; ?>
        </div>

        <div class="lpfw_table_of_parameters_single">
        <?php echo $e_type . ': <BR><span class="lpfw_table_of_parameters_single_bigger">'; echo esc_html( $type ); echo '</span>'; ?>
        </div>

        <div class="lpfw_table_of_parameters_single">
        <?php echo $e_publication_date . ': <BR><span class="lpfw_table_of_parameters_single_bigger">'; echo esc_html( $publication_date ); echo '</span>'; ?>
        </div>

        <div class="lpfw_table_of_parameters_single">
        <?php echo $e_pages . ': <BR><span class="lpfw_table_of_parameters_single_bigger">'; echo esc_html( $pages ); echo '</span>'; ?>
        </div>

        <div class="lpfw_table_of_parameters_single">
        <?php echo $e_format . ': <BR><span class="lpfw_table_of_parameters_single_bigger">'; echo esc_html( $format ); echo '</span>'; ?>
        </div>



        </div>

        <div class="lpfw_block_available">

            <div class="lpfw_block_available_left">
                <?php if($available == __('Available', 'library-plugin')) { ?>

                <svg class="lpfw_block_available_left_icon lpfw_block_available_left_icon_available">
                    <use xlink:href='<?php echo plugin_dir_url( __FILE__ ) ?>public/image/sprite.svg#icon-checkmark'></use>
                </svg>
                <?php
                } else {
                    ?>
                    <svg class="lpfw_block_available_left_icon lpfw_block_available_left_icon_not_available">
                    <use xlink:href='<?php echo plugin_dir_url( __FILE__ ) ?>public/image/sprite.svg#icon-cross'></use>
                    </svg>
                    <?php } ?>
            </div>

            <div class="lpfw_block_available_right">
            <?php echo esc_html( $available ); ?>

            </div>

        </div>

        <div class="lpfw_block_description">

        <div class="lpfw_block_description_image">
            <?php $thumbnail = get_the_post_thumbnail_url(); ?>
            <img src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>">
        </div>

        <div class="lpfw_block_description_text">
        <?php echo get_the_content('', '', $post->ID); ?> 
        </div>
        

        </div>


        <?php
    






get_footer();