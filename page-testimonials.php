<?php
get_header();
?>
    <div>
        <?php
        if(have_posts()) :
            while (have_posts()) : the_post(); ?>
                <section id="<?php echo $post->post_name?>" class="default-section " data-scroll-reveal="enter from the bottom over .5s">
                    <div class="section-heading ">
                        <h2 class="section-title"><?php the_title()?></h2>
                    </div>
                    <div class="container <?php echo $post->post_name?>-container">
                            <div class="col-md-6" data-scroll-reveal="enter from the left after .5s">
                                <div class="client-testimonials section-box">
                                    <div class="testimonial-slider">
                                        <div id="client-testimonial-slider" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php
                                                $args = array( 'orderby' => 'date',
                                                    'order'   => 'ASC',
                                                    'post_type' => 'testimonial');
                                                $loop = new WP_Query( $args );
                                                $first = true;
                                                while ( $loop->have_posts() ) : $loop->the_post();
                                                    $thumb_id = get_post_thumbnail_id();
                                                    $thumb_url = wp_get_attachment_image_src($thumb_id,'small-thumbnail', true);
                                                    ?>
                                                    <div class="item <?php if($first == true) {
                                                        echo "active";
                                                        $first = false;
                                                    }?>">
                                                        <img style="width: 150px;" src="<?php echo $thumb_url[0]?>" alt="<?php the_title()?>" class="client-img">
                                                        <h3 class="client-name"><?php the_title()?></h3>
                                                        <p class="sub-text"><?php echo get_post_meta($post->ID, 'testimonials_position', true); ?></p>
                                                        <p class="client-comments">
                                                            <?php
                                                            the_content();
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <?php
                                                endwhile;
                                                ?>

                                            </div>

                                            <a class="left testislider-control" href="#client-testimonial-slider" role="button" data-slide="prev">
                                                <i class="fa fa-chevron-left"></i>
                                            </a>
                                            <a class="right testislider-control" href="#client-testimonial-slider" role="button" data-slide="next">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" data-scroll-reveal="enter from the right after .5s">
                                <div class="clients-logos section-box">
                                    <ul class="logo-items">
                                        <li><a href="#"><img src="<?php echo get_template_directory_uri()?>/img/pega.png" alt="#" class="client-logo"></a></li>
                                        <li><a href="#"><img src="<?php echo get_template_directory_uri()?>/img/ca.png" alt="#" class="client-logo"></a></li>
                                        <li><a href="#"><img src="<?php echo get_template_directory_uri()?>/img/Syntel.jpg" alt="#" class="client-logo"></a></li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </section>
            <?php endwhile;
        else:
            echo 'No content found';
        endif;
        ?>
    </div>

<?php
get_footer();
?>