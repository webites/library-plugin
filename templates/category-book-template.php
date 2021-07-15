<?php

get_header();

$title = __('Book category', 'virtual-library');
$categoryName = get_queried_object()->name; 

?>
<article>
<h1 class="lpfw_header1"><?php echo esc_html($title . ': ' . $categoryName); ?></h1>


<div class="lpfw_archive_list">

<?php

if ( have_posts() ) :
     while ( have_posts() ) :
         the_post();
?>

            <div class="lpfw_archive_item">

                <div class="lpfw_archive_item_image">
                    <?php the_post_thumbnail(); ?>
                </div>

                <div class="lpfw_archive_item_details">
                <?php $available = get_post_meta( $post->ID, 'lpfw_book_available', true ); 
                      $author = get_post_meta( $post->ID, 'lpfw_book_author', true );
                      $series = get_post_meta( $post->ID, 'lpfw_book_series', true );
                      $pages = get_post_meta( $post->ID, 'lpfw_book_pages', true );

                ?>
                    <div class="lpfw_archive_item_available" 
                    <?php 
                    if($available == 'on') { 
                        echo "style='background-color:#03fc17;'";
                    } else { 
                        echo "style='background-color:#c71d0e;'";
                        } ?>
                        >
                      
                        <?php
                           if($available == 'on'){
                                _e('Available', 'virtual-library');
                            }else{
                                _e('Not available', 'virtual-library');
                            }
                        ?>
                    </div>

                    <h2 class="lpfw_archive_header_item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                    <p>
                    <?php echo get_the_excerpt(); ?>
                    </p>

                    <?php 
                    $pagesWord = __('pages', 'virtual-library');
                    ?>

                    <div class="lpfw_archive_short_details">
                            
                            <?php if( !empty($author)) {
                                 echo '<div>' . (esc_html( $author )) . '</div>';
                                }
                            ?>
                            
                            <?php if( !empty($series)) {
                                 echo '<div>' . (esc_html( $series )) . '</div>';
                                }
                            ?>

                            <?php if( !empty($pages)) {
                                 echo '<div>' . (esc_html( $pages ) . ' ' . $pagesWord) . '</div>';
                                }
                            ?>

                    </div>

                    <a href="<?php the_permalink(); ?>" class="button"><?php _e('Read more', 'virtual-library'); ?></a>

                </div>
            
            </div>

            <?php
            $olderPosts = __('Older books', 'virtual-library');
            $newerPosts = __('Newer books', 'virtual-library');
            ?>
            <div class="lpfw_archive_pagination_left nav-previous alignleft"><?php previous_posts_link( $olderPosts ); ?></div>
            <div class="lpfw_archive_pagination_right nav-next alignright"><?php next_posts_link( $newerPosts ); ?></div>


    <?php
    endwhile;
    endif;
?>
</div>

</article>
<?php
get_footer();