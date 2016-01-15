<?php
ask_set_post_view( get_the_ID() );
get_header(); ?>
    <main id="main" class="site-main" role="main">
        <section id="blog-archives" class="default-section first-section">
        <?php
        get_template_part('content', get_post_format());
        ?>

        </section>
    </main>
<?php
get_footer();

?>