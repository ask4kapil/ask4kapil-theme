<?php

get_header(); ?>
    <main id="main" class="site-main" role="main">
        <section class="content-area">
            <div class="section-heading">
                <h2 class="section-title"><?php
                    ?>
                    Search results for: <?php the_search_query();?>
                </h2>
            </div>
            <?php
            if(have_posts()) :
                get_template_part('content', get_post_format());
            else:
                echo 'No content found';
            endif;?>
        </section>
    </main>
<?php
get_footer();

?>