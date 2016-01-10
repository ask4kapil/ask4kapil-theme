<?php

get_header(); ?>

    <div class="container">
        <?php
if(have_posts()) : ?>
    <h2>Search results for: <?php the_search_query();?></h2>

    <?php
    while (have_posts()) : the_post();
        get_template_part('content', get_post_format());
    endwhile;
else:
    echo 'No content found';
endif;

?>
</div>
<?php
get_footer();

?>