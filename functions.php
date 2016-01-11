<?php
	function firsttheme_resources() {
		wp_enqueue_style('normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css');
		wp_enqueue_style('bootstrap', get_template_directory_uri() .'/lib/bootstrap/css/bootstrap.min.css');
		wp_enqueue_style('font-awesome', get_template_directory_uri() .'/lib/font-awesome-4.5.0/css/font-awesome.min.css');
		wp_enqueue_style('style', get_stylesheet_uri());
		wp_enqueue_style('app-style', get_template_directory_uri().'/css/app-style.css');

		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri().'/lib/jquery-2.1.4.min.js', false, null);
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap', get_template_directory_uri() .'/lib/bootstrap/js/bootstrap.min.js');
		wp_enqueue_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js');
	}

	add_action('wp_enqueue_scripts', 'firsttheme_resources');

	require_once('wp_bootstrap_navwalker.php');

	//Get top ancestor
	function get_top_ancestor_id () {
		global $post;
		if($post->post_parent) {
			$ancestor = array_reverse(get_post_ancestors($post->ID));
			return $ancestor[0];
		}

		return $post->ID;
	}
	//Does page has children
	function has_children() {
		global $post;
		$pages = get_pages('child_of='.$post->ID);
		return count($pages);
	}

	//Customise excerpt word cound length
	function custome_excerpt_length() {
		return 30;
	}
	add_filter('excerpt_length', 'custome_excerpt_length');


	function firstthemeWordPress_setup() {
		//Navigation Menus
		register_nav_menus(array(
			'primary' => ('Primary Menu'),
			'footer' => ('Footer Menus')
		));
		// Add support for post format
		add_theme_support('post-formats', array('aside', 'gallery', 'link'));

		//Add featured image support
		add_theme_support('post-thumbnails');
        add_image_size('small-thumbnail', 180, 120, true);
        add_image_size('banner-image', 1280, 420, array('left', 'top'));
	}
	add_action('after_setup_theme', 'firstthemeWordPress_setup');

	//Add our widget location
	function ourWidgetsInit() {
		register_sidebar(array(
			'name' => 'Footer Area',
			'id' => 'footerarea'
		));
	}
	add_action('widgets_init', 'ourWidgetsInit');

	//Customize Appearance Options
	function firsttheme_customize_register($wp_customize) {

	}
	add_action('customize_register', 'firsttheme_customize_register');
?>