<?php


    /**
     * Theme setup.
     */
    add_action('after_setup_theme', 'wuxt_setup');
    function wuxt_setup() {

        add_theme_support('post-thumbnails');

    }


    add_action('init', 'wuxt_register_menu');
    function wuxt_register_menu() {
        register_nav_menu('main', __('Main menu'));
    }

	/*// create custom function to return nav menu
	function custom_wp_menu() {
		// Replace your menu name, slug or ID carefully
		return wp_get_nav_menu_items('Main Navigation');
	}

	// create new endpoint route
	add_action( 'rest_api_init', function () {
		register_rest_route( 'wp/v2', 'menu', array(
			'methods' => 'GET',
			'callback' => 'custom_wp_menu',
		) );
	} );*/


    /**
    *  Include Custom post types
    */
    if ( is_dir(  dirname(__FILE__) . '/cpts/' ) ) {
      foreach ( scandir( dirname(__FILE__) . '/cpts/' ) as $filename ) {
          $path = dirname(__FILE__) . '/cpts/' . $filename;
          if ( is_file( $path ) ) {
              require_once( $path );
          }
      }
    }

    /**
    *  Include Taxonomies
    */
    if ( is_dir(  dirname(__FILE__) . '/taxonomies/' ) ) {
      foreach ( scandir( dirname(__FILE__) . '/taxonomies/' ) as $filename ) {
          $path = dirname(__FILE__) . '/taxonomies/' . $filename;
          if ( is_file( $path ) ) {
              require_once( $path );
          }
      }
    }


    /**
     * Customize the preview button in the WordPress admin to point to the headless client.
     *
     * @param  str $link The WordPress preview link.
     * @return str The headless WordPress preview link.
     */
    function set_headless_preview_link( $link ) {
    	if (WP_DEBUG === true) {
    		return 'http://localhost:3000/'
    			. '_preview/'
    			. get_the_ID() . '/'
    			. wp_create_nonce( 'wp_rest' );
    	} else {
    		return 'https://localhost:3000/'
    			. '_preview/'
    			. get_the_ID() . '/'
    			. wp_create_nonce( 'wp_rest' );
    	}
    }

    add_filter( 'preview_post_link', 'set_headless_preview_link' );

	// wordpress api for logo extension
	add_action( 'rest_api_init', 'add_logo_to_JSON' );
	function add_logo_to_JSON() {
	register_rest_field( 'post', 'page_logo_src', array( // post for where to register - page_logo_src is the name for api
			'get_callback'    => 'get_logo_src',
			'update_callback' => null,
			'schema'          => null,
			 )
		);
	}

	function get_logo_src( $object, $field_name, $request ) {
		$size = 'full';
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$feat_img_array = wp_get_attachment_image_src($custom_logo_id, $size, true);
		return $feat_img_array[0];
	}
