			<!--<footer class="site-footer">
				<?php
/*				$args = array(
					'theme_location' => 'footer'
				);
				*/?>
				<div class="footer-widgets">
					<?php /*dynamic_sidebar('footerarea1');*/?>
				</div>

				<nav class="site-nav">
					<?php /*wp_nav_menu($args); */?>
				</nav>
				<p><?php /*bloginfo('name'); */?> - &copy; <?php /*echo date('Y'); */?></p>
			</footer>-->
		</div>
		<footer class="foot">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<h4 class="foot-logo"><?php bloginfo('name'); ?></h4>
					</div>
					<div class="col-md-12 col-xs-12 col-sm-12 text-center">
						<p class="foot-text">Copyrights &copy; <?php echo date('Y'); ?> | Ask4Kapil Designed By : <a href="<?php bloginfo('wpurl'); ?>">Kapil Kumawat</a>.</p>
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer();?>
	</body>
</html>