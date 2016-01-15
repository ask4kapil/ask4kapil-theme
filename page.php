<?php

get_header(); ?>

<div class="container">
<?php
if(have_posts()) :
	while (have_posts()) : the_post(); ?>
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
else:
	echo 'No content found';
endif;
?>
</div>
<?php
get_footer();

?>