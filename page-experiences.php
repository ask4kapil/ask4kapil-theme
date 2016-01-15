<?php
get_header();
?>
<?php
$allPages = new WP_Query(array( 'pagename' => 'experiences'));
if ($allPages->have_posts()) :
    while ($allPages->have_posts()) : $allPages->the_post(); ?>
        <section id="<?php echo $post->post_name?>" class="default-section " data-scroll-reveal="enter from the bottom over .5s">
            <div class="section-heading ">
                <h2 class="section-title"><?php the_title()?></h2>
            </div>
            <div class="<?php echo $post->post_name?>-container">
                <div class="container">
                    <div class="experience-items">
                        <?php
                        $args = array( 'orderby' => 'date',
                            'order'   => 'DESC',
                            'post_type' => 'experience');
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                            ?>
                            <div class="experience-item" data-scroll-reveal="enter from the bottom over .5s">
                                <div class="name-designation" data-scroll-reveal="enter from the left after .5s">
                                    <h3 class="designation"><?php echo get_post_meta($post->ID, 'experience_position', true);?></h3>
                                    <p class="name-of-org"><?php echo get_post_meta($post->ID, 'experience_company', true);?></p>

                                </div>
                                <div class="stay-time <?php echo get_post_meta($post->ID, 'experience_css', true);?>">
                                    <?php echo get_post_meta($post->ID, 'experience_fromYear', true);?><br>
                                    -<br>
                                    <?php echo get_post_meta($post->ID, 'experience_toYear', true);?>
                                </div>
                                <div class="comments" data-scroll-reveal="enter from the right after .5s">

                                    <?php the_excerpt()
                                    ?>
                                    <i class="fa fa-external-link"></i>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile;

else :
    // fallback no content message here
endif;
wp_reset_postdata();?>

<?php
get_footer();
?>