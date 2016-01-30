<?php
	function firsttheme_resources() {
		wp_enqueue_style('normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css');
		wp_enqueue_style('bootstrap', get_template_directory_uri() .'/lib/bootstrap/css/bootstrap.min.css');
		wp_enqueue_style('font-awesome', get_template_directory_uri() .'/lib/font-awesome-4.5.0/css/font-awesome.min.css');
		wp_enqueue_style('style', get_stylesheet_uri());
		wp_enqueue_style('app-style', get_template_directory_uri().'/css/app-style.css');
		wp_enqueue_style('responsive', get_template_directory_uri().'/css/responsive.css');

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
			'name' => 'SideBar Area',
			'id' => 'sidebar'
		));
	}
	add_action('widgets_init', 'ourWidgetsInit');

	//Customize Appearance Options
	function firsttheme_customize_register($wp_customize) {

	}
	add_action('customize_register', 'firsttheme_customize_register');

   //Register new post type for testimonials
	function custom_testimonials() {
		$labels = array(
			'name'               => _x( 'Testimonials', 'post type general name' ),
			'singular_name'      => _x( 'Testimonial', 'post type singular name' ),
			'add_new'            => _x( 'Add New', 'testimonials' ),
			'add_new_item'       => __( 'Add New Testimonial' ),
			'edit_item'          => __( 'Edit Testimonial' ),
			'new_item'           => __( 'New Testimonial' ),
			'all_items'          => __( 'All Testimonials' ),
			'view_item'          => __( 'View Testimonial' ),
			'search_items'       => __( 'Search Testimonial' ),
			'not_found'          => __( 'No testimonial found' ),
			'not_found_in_trash' => __( 'No testimonial found in the Trash' ),
			'parent_item_colon'  => '',
			'menu_name'          => 'Testimonial'
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Holds our testimonial specific data',
			'public'        => true,
			'exclude_from_search' => true,
            'show_ui' => true,
			'menu_position' => 5,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive'   => true
		);
		register_post_type( 'testimonial', $args );
	}
	add_action( 'init', 'custom_testimonials' );
    add_action( 'add_meta_boxes', 'testimonials_box' );
    function testimonials_box() {
        add_meta_box(
            'testimonials_box',
            __( 'Testimonials', 'myplugin_textdomain' ),
            'testimonials_box_content',
            'testimonial',
            'normal',
            'default'
        );
    }
    function testimonials_box_content( $post ) {
        wp_nonce_field( plugin_basename( __FILE__ ), 'testimonials_box_content_nonce' );
        // get value of this field if it exists for this post
        $testimonials_position = get_post_meta($post->ID, 'testimonials_position', true);
        $testimonials_company = get_post_meta($post->ID, 'testimonials_company', true);

        echo '<label for="testimonials_position">Position</label>';
        echo '<input type="text" id="testimonials_position" name="testimonials_position" style="width: 100%;" placeholder="Enter Position" value="'.$testimonials_position.'"/>';

        echo '<label for="testimonials_company">Company</label>';
        echo '<input type="text" id="testimonials_company" name="testimonials_company" style="width: 100%;" placeholder="Enter Company" value="'.$testimonials_company.'"/>';
    }

    add_action( 'save_post', 'testimonials_position_box_save', 10, 2 );
    function testimonials_position_box_save( $post_id, $post  ) {

        if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return $post_id;
        if ( !!wp_verify_nonce( $_POST['testimonials_box_content_nonce'], basename( __FILE__ ) ) )
            return $post_id;

        /* Get the post type object. */
        $post_type = get_post_type_object( $post->post_type );

        /* Check if the current user has permission to edit the post. */
        if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
            return $post_id;

        /* Get the posted data and sanitize it for use as an HTML class. */
        $new_meta_value = ( isset( $_POST['testimonials_position'] ) ? esc_attr( $_POST['testimonials_position'] ) : '' );

        /* Get the meta key. */
        $meta_key = 'testimonials_position';

        /* Get the meta value of the custom field key. */
        $meta_value = get_post_meta( $post_id, $meta_key, true );

        /* If a new meta value was added and there was no previous value, add it. */
        if ( $new_meta_value && '' == $meta_value )
            add_post_meta( $post_id, $meta_key, $new_meta_value, true );

        /* If the new meta value does not match the old value, update it. */
        elseif ( $new_meta_value && $new_meta_value != $meta_value )
            update_post_meta( $post_id, $meta_key, $new_meta_value );

        /* If there is no new meta value but an old value exists, delete it. */
        elseif ( '' == $new_meta_value && $meta_value )
            delete_post_meta( $post_id, $meta_key, $meta_value );

        /* Get the posted data and sanitize it for use as an HTML class. */
        $new_meta_value = ( isset( $_POST['testimonials_company'] ) ? esc_attr( $_POST['testimonials_company'] ) : '' );

        /* Get the meta key. */
        $meta_key = 'testimonials_company';

        /* Get the meta value of the custom field key. */
        $meta_value = get_post_meta( $post_id, $meta_key, true );

        /* If a new meta value was added and there was no previous value, add it. */
        if ( $new_meta_value && '' == $meta_value )
            add_post_meta( $post_id, $meta_key, $new_meta_value, true );

        /* If the new meta value does not match the old value, update it. */
        elseif ( $new_meta_value && $new_meta_value != $meta_value )
            update_post_meta( $post_id, $meta_key, $new_meta_value );

        /* If there is no new meta value but an old value exists, delete it. */
        elseif ( '' == $new_meta_value && $meta_value )
            delete_post_meta( $post_id, $meta_key, $meta_value );

        return $post_id;

    }

	//Register new post type for experience
	function custom_experience() {
		$labels = array(
			'name'               => _x( 'Experiences', 'post type general name' ),
			'singular_name'      => _x( 'Experience', 'post type singular name' ),
			'add_new'            => _x( 'Add New', 'Experiences' ),
			'add_new_item'       => __( 'Add New Experience' ),
			'edit_item'          => __( 'Edit Experience' ),
			'new_item'           => __( 'New Experience' ),
			'all_items'          => __( 'All Experience' ),
			'view_item'          => __( 'View Experience' ),
			'search_items'       => __( 'Search Experience' ),
			'not_found'          => __( 'No experience found' ),
			'not_found_in_trash' => __( 'No experience found in the Trash' ),
			'parent_item_colon'  => '',
			'menu_name'          => 'Experience'
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Holds our experience specific data',
			'public'        => true,
			'menu_position' => 5,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive'   => true
		);
		register_post_type( 'experience', $args );
	}
	add_action( 'init', 'custom_experience' );
	add_action( 'add_meta_boxes', 'custom_experience_box' );
	function custom_experience_box() {
		add_meta_box(
			'custom_experience_box',
			__( 'Experience', 'myplugin_textdomain' ),
			'experience_box_content',
			'experience',
			'normal',
			'default'
		);
	}
	function experience_box_content( $post ) {
		wp_nonce_field( plugin_basename( __FILE__ ), 'experience_box_content_nonce' );
		// get value of this field if it exists for this post
		$experience_position = get_post_meta($post->ID, 'experience_position', true);
		$experience_company = get_post_meta($post->ID, 'experience_company', true);

		$experience_fromYear = get_post_meta($post->ID, 'experience_fromYear', true);
		$experience_toYear = get_post_meta($post->ID, 'experience_toYear', true);
		$experience_css = get_post_meta($post->ID, 'experience_css', true);

		echo '<label for="experience_fromYear">From Year</label>';
		echo '<input type="text" id="experience_fromYear" name="experience_fromYear" style="width: 100%;" placeholder="Enter stating year" value="'.$experience_fromYear.'"/>';

		echo '<label for="experience_toYear">To Year</label>';
		echo '<input type="text" id="experience_toYear" name="experience_toYear" style="width: 100%;" placeholder="Enter end year" value="'.$experience_toYear.'"/>';

		echo '<label for="experience_position">Position</label>';
		echo '<input type="text" id="experience_position" name="experience_position" style="width: 100%;" placeholder="Enter Position" value="'.$experience_position.'"/>';

		echo '<label for="experience_company">Company</label>';
		echo '<input type="text" id="experience_company" name="experience_company" style="width: 100%;" placeholder="Enter Company" value="'.$experience_company.'"/>';

		echo '<label for="experience_css">From Year</label>';
		echo '<input type="text" id="experience_css" name="experience_css" style="width: 100%;" placeholder="Enter style name" value="'.$experience_css.'"/>';
	}

	add_action( 'save_post', 'experience_box_content_save', 10, 2 );
	function experience_box_content_save( $post_id, $post  ) {

		if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		if ( !!wp_verify_nonce( $_POST['experience_box_content_nonce'], basename( __FILE__ ) ) )
			return $post_id;

		/* Get the post type object. */
		$post_type = get_post_type_object( $post->post_type );

		/* Check if the current user has permission to edit the post. */
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;

		/* Get the posted data and sanitize it for use as an HTML class. */
		$new_meta_value = ( isset( $_POST['experience_position'] ) ? esc_attr( $_POST['experience_position'] ) : '' );

		/* Get the meta key. */
		$meta_key = 'experience_position';

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If a new meta value was added and there was no previous value, add it. */
		if ( $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );

		/* If there is no new meta value but an old value exists, delete it. */
		elseif ( '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		/* Get the posted data and sanitize it for use as an HTML class. */
		$new_meta_value = ( isset( $_POST['experience_company'] ) ? esc_attr( $_POST['experience_company'] ) : '' );

		/* Get the meta key. */
		$meta_key = 'experience_company';

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If a new meta value was added and there was no previous value, add it. */
		if ( $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );

		/* If there is no new meta value but an old value exists, delete it. */
		elseif ( '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		/* Get the posted data and sanitize it for use as an HTML class. */
		$new_meta_value = ( isset( $_POST['experience_toYear'] ) ? esc_attr( $_POST['experience_toYear'] ) : '' );

		/* Get the meta key. */
		$meta_key = 'experience_toYear';

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If a new meta value was added and there was no previous value, add it. */
		if ( $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );

		/* If there is no new meta value but an old value exists, delete it. */
		elseif ( '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		/* Get the posted data and sanitize it for use as an HTML class. */
		$new_meta_value = ( isset( $_POST['experience_fromYear'] ) ? esc_attr( $_POST['experience_fromYear'] ) : '' );

		/* Get the meta key. */
		$meta_key = 'experience_fromYear';

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If a new meta value was added and there was no previous value, add it. */
		if ( $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );

		/* If there is no new meta value but an old value exists, delete it. */
		elseif ( '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		/* Get the posted data and sanitize it for use as an HTML class. */
		$new_meta_value = ( isset( $_POST['experience_css'] ) ? esc_attr( $_POST['experience_css'] ) : '' );

		/* Get the meta key. */
		$meta_key = 'experience_css';

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If a new meta value was added and there was no previous value, add it. */
		if ( $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );

		/* If there is no new meta value but an old value exists, delete it. */
		elseif ( '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );
        return $post_id;
	}


	/**
	 * To display number of posts.
	 *
	 * @param $postID current post/page id
	 *
	 * @return string
	 */
	function ask_get_post_view( $postID ) {
		$count_key = 'post_views_count';
		$count     = get_post_meta( $postID, $count_key, true );
		if ( $count == '' ) {
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );

			return '0 View';
		}

		return $count . ' Views';
	}


    // Remove issues with prefetching adding extra views
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	/**
	 * To count number of views and store in database.
	 *
	 * @param $postID currently viewed post/page
	 */
	function ask_set_post_view( $postID ) {
		$count_key = 'post_views_count';
		$count     = (int) get_post_meta( $postID, $count_key, true );
		if ( $count < 0 ) {
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );
		} else {
			$count++;
			update_post_meta( $postID, $count_key, (string) $count );
		}
	}

	/**
	 * Add a new column in the wp-admin posts list
	 *
	 * @param $defaults
	 *
	 * @return mixed
	 */
	function ask_posts_column_views( $defaults ) {
		$defaults['post_views'] = __( 'Views' );

		return $defaults;
	}

	/**
	 * Display the number of views for each posts
	 *
	 * @param $column_name
	 * @param $id
	 *
	 * @return void simply echo out the number of views
	 */
	function ask_posts_custom_column_views( $column_name, $id ) {
		if ( $column_name === 'post_views' ) {
			echo ask_get_post_view( get_the_ID() );
		}
	}

	add_filter( 'manage_posts_columns', 'ask_posts_column_views' );
	add_action( 'manage_posts_custom_column', 'ask_posts_custom_column_views', 5, 2 );
    //Move Comment Text Field to Bottom in WordPress 4.4
	function wpb_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}

	add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );
	// Numbered Pagination
	if ( !function_exists( 'wpex_pagination' ) ) {

		function wpex_pagination() {

			$prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
			$next_arrow = is_rtl() ? '&larr;' : '&rarr;';

			global $wp_query;
			$total = $wp_query->max_num_pages;
			$big = 999999999; // need an unlikely integer
			if( $total > 1 )  {
				if( !$current_page = get_query_var('paged') )
					$current_page = 1;
				if( get_option('permalink_structure') ) {
					$format = 'page/%#%/';
				} else {
					$format = '&paged=%#%';
				}
				echo paginate_links(array(
					'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'		=> $format,
					'current'		=> max( 1, get_query_var('paged') ),
					'total' 		=> $total,
					'mid_size'		=> 3,
					'type' 			=> 'list',
					'prev_text'		=> $prev_arrow,
					'next_text'		=> $next_arrow,
				) );
			}
		}

	}
?>