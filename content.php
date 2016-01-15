<div class="container">
    <div class="row">
        <div class="blog-container col-md-8">
            <div class="blog-posts <?php if(is_single()) { echo "single-page";} ?>" >
                <?php
                if(have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <article id="post-<?php echo $post->ID?>" class="post-item post-count-<?php echo ask_get_post_view($post->ID)?> post-<?php echo $post->ID?> post type-post status-publish format-standard hentry category-<?php echo $post->post_category?>" data-scroll-reveal="">
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
                                    <?php echo the_content();?>
                                <?php }
                            }
                            ?>
                        </div>
                    </article>
                    <?php
                    if(is_single()) {
                    ?>
                    <footer class="entry-footer">
                        <?php
                        $categories = get_the_category();
                        $seperator = ", ";
                        $output = '';
                        if($categories) {
                            foreach($categories as $category) {
                                $output .= '<span class="cat-links">Posted in <a rel="category tag" href="'. get_category_link($category->term_id).'"  title="View all posts in '. $category->cat_name . '">'. $category->cat_name . '</a>'  . $seperator;
                            }
                            echo trim($output, $seperator);
                        }
                        ?>
                    </footer>
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    }
                endwhile;
                else:
                    echo 'No content found';
                endif;
                ?>
            </div>
        </div>
        <?php get_sidebar(); ?>

    </div>
</div>