<?php
get_header();
?>

    <?php
        $arr = array('about', 'skills');
        foreach ($arr as &$pagename) {
            $allPages = new WP_Query(array( 'pagename' => $pagename));
            if ($allPages->have_posts()) :
                while ($allPages->have_posts()) : $allPages->the_post(); ?>
                    <section id="<?php echo $post->post_name?>" class="default-section " data-scroll-reveal="enter from the bottom over .5s">
                        <div class="section-heading ">
                            <h2 class="section-title"><?php the_title()?></h2>
                        </div>
                        <div class="<?php echo $post->post_name?>-container">
                            <div class="container">
                                <?php the_content()?>
                            </div>
                        </div>
                    </section>
                <?php endwhile;

            else :
                // fallback no content message here
            endif;
            wp_reset_postdata();
        }
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
                                            <a href="<?php the_permalink()?>">Read more <i class="fa fa-external-link"></i></a>
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
        wp_reset_postdata();
    ?>
    <?php
    $arr = array('education');
    foreach ($arr as &$pagename) {
        $allPages = new WP_Query(array( 'pagename' => $pagename));
        if ($allPages->have_posts()) :
            while ($allPages->have_posts()) : $allPages->the_post(); ?>
                <section id="<?php echo $post->post_name?>" class="default-section " data-scroll-reveal="enter from the bottom over .5s">
                    <div class="section-heading ">
                        <h2 class="section-title"><?php the_title()?></h2>
                    </div>
                    <div class="<?php echo $post->post_name?>-container">
                        <div class="container">
                            <?php the_content()?>
                        </div>
                    </div>
                </section>
            <?php endwhile;

        else :
            // fallback no content message here
        endif;
        wp_reset_postdata();
    }
    ?>

    <div>
        <?php
        $allPages = new WP_Query(array( 'pagename' => 'testimonials'));
        if($allPages->have_posts()) :
            while ($allPages->have_posts()) : $allPages->the_post(); ?>
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
                                            wp_reset_postdata();
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
        wp_reset_postdata();
        ?>
    </div>
    <section id="blog" class="default-section " data-scroll-reveal="enter from the bottom over .5s">
        <div class="section-heading ">
            <h2 class="section-title">Blog</h2>
        </div>
        <div class="container">
            <div class="blogs-container">
                <div class="blog-posts two-column">
                    <?php
                    $args = array( 'posts_per_page' => 4,  /* get 4 posts, or set -1 to display all posts */
                        'orderby'     => 'meta_value',  /* this will look at the meta_key you set below */
                        'meta_key'    => 'post_views_count',
                        'order'       => 'DESC',
                        'post_type'   => 'post',
                        'post_status' => 'publish');
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        ?>
                        <article id="post-<?php echo $post->ID?>" class="post-item post-<?php echo $post->ID?> post type-post status-publish format-standard hentry category-<?php echo $post->post_category?>" data-scroll-reveal="">
                            <div class="post-bullet">
                                <i class="fa fa-circle"></i>
                            </div>
                            <figure class="featured-image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-thumbnail');  ?></a>
                            </figure>
                            <header class="entry-header">
                                <h2 class="post-title"><a href="<?php the_permalink()?>" rel="bookmark"><?php the_title()?></a></h2>
                                <div class="entry-meta">
                                    <ul class="post-meta">
                                        <li class="item fa-calendar">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <time class="entry-date published updated" datetime="2014-12-31T06:55:54+00:00"><?php the_time('d M Y')?></time>
                                            </a>
                                        </li>
                                        <li class="item fa-user">
                                                <span class="author vcard">
                                                    <a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author()?></a>
                                                </span>
                                        </li>
                                        <li class="item fa-comments">
                                            <a href="<?php the_permalink(); ?>/#comments">
                                                <?php comments_number( 'No Comments', 'One comment', '% comments' ); ?>
                                            </a>
                                        </li>
                                        <li class="item fa-tags">
                                            <?php
                                            $categories = get_the_category();
                                            $seperator = ", ";
                                            $output = '';
                                            if($categories) {
                                                foreach($categories as $category) {
                                                    $output .= '<a href="'. get_category_link($category->term_id).'"  title="View all posts in '. $category->cat_name . '">'. $category->cat_name . '</a>'  . $seperator;
                                                }
                                                echo trim($output, $seperator);
                                            }
                                            ?>
                                        </li>
                                    </ul>
                                </div><!-- .entry-meta -->
                            </header>
                            <div class="entry-content">

                                <?php if(is_search() OR is_archive()) { ?>
                                    <p>
                                        <?php echo get_the_excerpt();?>
                                        <a href="<?php the_permalink();?>"> Read more&raquo;</a>
                                    </p>
                                    <?php
                                } else {
                                    ?>
                                    <?php if($post->post_excerpt) {?>

                                        <p>
                                            <?php echo get_the_excerpt();?>
                                            <a href="<?php the_permalink();?>"> Read more&raquo;</a>
                                        </p>
                                    <?php } else {?>
                                        <?php echo the_excerpt(); ?>
                                    <?php }
                                } ?>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="view-all">
                    <a href="<?php echo site_url()?>/blog/" class="btn custom-btn">View All Posts</a>
                </div>
            </div>
        </div>
    </section>
    <?php
    $allPages = new WP_Query(array( 'pagename' => 'contact'));
    if ($allPages->have_posts()) :
        while ($allPages->have_posts()) : $allPages->the_post(); ?>
            <section id="<?php echo $post->post_name?>" class="default-section " data-scroll-reveal="enter from the bottom over .5s">
                <div class="section-heading ">
                    <h2 class="section-title"><?php the_title()?></h2>
                </div>
                <div class="<?php echo $post->post_name?>-container">
                    <div class="container">
                        <?php the_content()?>
                    </div>
                </div>
            </section>
        <?php endwhile;

    else :
        // fallback no content message here
    endif;
    wp_reset_postdata();
    ?>
    <?php
        $allPages = new WP_Query(array( 'pagename' => 'footer'));
        if ($allPages->have_posts()) :
            while ($allPages->have_posts()) : $allPages->the_post(); ?>
                <section id="<?php echo $post->post_name?>" class="default-section " data-scroll-reveal="enter from the bottom over .5s">
                    <div class="container">
                        <div class="<?php echo $post->post_name?>-container section-box">
                            <?php the_content()?>
                        </div>
                    </div>
                </section>
            <?php endwhile;

        else :
            // fallback no content message here
        endif;
        wp_reset_postdata();
    ?>

<?php
get_footer();
?>