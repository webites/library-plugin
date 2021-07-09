<?php

get_header();

$title = __('Book category', 'library-plugin');
$categoryName = get_queried_object()->name; 

?>

<h1 class="lpfw_header1"><?php echo $title . ': ' . $categoryName; ?></h1>



<?php
get_footer();