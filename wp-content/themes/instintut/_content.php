<?php
global $post;
setup_postdata($post); 

?>

<?php if( have_rows('content') ): ?>

    <?php $key = 1; while( have_rows('content') ): the_row(); ?>

        <?php get_template_part('/content-parts/' . get_row_layout(), null, ['key' => $key]) ?>

    <?php $key++; endwhile; ?>

<?php endif ?>