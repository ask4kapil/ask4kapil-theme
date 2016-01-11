<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="se-pre-con"></div>
		<script>
			$(window).load(function() {
				// Animate loader off screen
				setTimeout(function(){$(".se-pre-con").fadeOut("slow")},2000);
			});
		</script>
		<?php if(is_front_page()) {?>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<script src="<?php echo get_template_directory_uri() . '/lib/quovolver/jquery.quovolver.js'?>"></script>
				<script src="<?php echo get_template_directory_uri() . '/lib/mixitup/build/jquery.mixitup.min.js'?>"></script>
				<script src="<?php echo get_template_directory_uri() . '/lib/scrollreveal.min.js'?>"></script>
				<script src="<?php echo get_template_directory_uri() . '/lib/typed.min.js'?>"></script>
				<script src="<?php echo get_template_directory_uri() . '/lib/Chart.min.js'?>"></script>
				<script src="<?php echo get_template_directory_uri() . '/js/front-page.js'?>"></script>
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img class="first-slide">
                        <div class="mask-image"></div>
					</div>
					<div class="item">
						<img class="second-slide">
                        <div class="mask-image"></div>
					</div>
					<div class="item">
						<img class="third-slide">
                        <div class="mask-image"></div>
					</div>
					<div class="item">
						<img class="forth-slide">
                        <div class="mask-image"></div>
					</div>
					<div class="item">
						<img class="fifth-slide">
                        <div class="mask-image"></div>
					</div>
				</div>
                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="tagline">I'm <span id="typed"></span></h1>
                        <h4 class="sub-tagline">UI Expert / Front End Developer / Geek</h4>
                    </div>
                </div>
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
				<div class="container">
					<div class="carousel-caption">

					</div>
				</div>
			</div>
		<?php
		}
		?>
		<div class="navbar navbar-beyond-learning <?php if(!is_front_page()) {echo 'navbar-fixed-top';} ?>" id="menu">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle menu-button" data-toggle="collapse" data-target="#myNavbar">
						<span class="glyphicon glyphicon-align-justify"></span>
					</button>
					<a class="navbar-brand logo" href="<?php echo home_url();?>"><?php bloginfo('name');?></a>
				</div>
				<div>
					<nav class="collapse navbar-collapse" id="myNavbar" role="navigation">
						<!--<ul class="nav navbar-nav navbar-right navstyle">
						</ul>-->
						<?php
						wp_nav_menu( array(
								'menu'              => 'primary',
								'theme_location'    => 'primary',
								'depth'             => 2,
								'container'         => 'div',
								'container_class'   => 'collapse navbar-collapse',
								'container_id'      => 'bs-example-navbar-collapse-1',
								'menu_class'        => 'nav navbar-nav navbar-right navstyle',
								'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								'walker'            => new wp_bootstrap_navwalker())
						); ?>
					</nav>
				</div>
			</div>
		</div>
		<div class="top-header">
		<!--<div class="container">-->
			<!-- site-header-->
			<!--<header class="site-header">
				<div class="hd-search">
					<?php /*get_search_form();*/?>
				</div>
				<h1><a href="<?php /*echo home_url();*/?>"><?php /*bloginfo('name');*/?></a></h1>
				<h5><?php /*bloginfo('description'); */?>	<?php /*if(is_page('portfolio')) { */?>
						Thank You
					<?php /*}*/?></h5>

				<nav class="site-nav">
					<?php
/*					$args = array(
						'theme_location' => 'primary'
					);
					*/?>
					<?php /*wp_nav_menu($args); */?>
				</nav>
			</header>--><!-- /site-header-->
