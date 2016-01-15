<?php

get_header(); ?>

    <main id="main" class="site-main" role="main">
        <section class="content-area">
            <div class="section-heading">
                    <h2 class="section-title"><?php
                        if(is_category()) {
                            single_cat_title();
                        } elseif( is_tag()) {
                            single_tag_title();
                        } elseif(is_author()) {
                            the_post();
                            echo 'Author Archives: ' .get_the_author();
                            rewind_posts();
                        } elseif (is_day()) {
                            echo 'Daily Archives: '.get_the_date();
                        } elseif (is_month()) {
                            echo 'Monthly Archives: '.get_the_date('F Y');
                        } elseif (is_year()) {
                            echo 'Yearly Archives: '.get_the_date('Y');
                        } else {
                            echo 'Archives';
                        }
                        ?></h2>
            </div>
            <?php
            if(have_posts()) :
                get_template_part('content', get_post_format());
            else:
                echo 'No content found';
            endif;
            ?>
        </section>
    </main>
<?php
get_footer();

?>