<?php

/*
Template Name: Special template
 */
get_header();
if(have_posts()) :
	while (have_posts()) : the_post(); ?>
		<article class="post page">
			<h2><?php the_title()?></h2>

			<div class="info-box">
				<h4>Disclaimer Title</h4>
				<p>Security restrictions on Windows Vista and Windows 7o get around this restriction, open Notepad or your script editor from the Start menu by right-clicking the program name and selecting "Run as Administrator" from the context menu. Then open the relevant files by using File > Open inside the program you have just launched.</p>
			</div>
			<?php the_content()?>
		</article>
	<?php endwhile;
else:
	echo 'No content found';
endif;

get_footer();
?>