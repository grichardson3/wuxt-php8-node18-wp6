<?php
    // example post type

    function create_post_type() {
        register_post_type( 'Movies',
            array(
                'labels' => array(
                    'name' => __( 'Movies' ),
                    'singular_name' => __( 'Movie' )
                ),
                'public' => true,
                'show_in_rest' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'movies'),
                'supports' => array( 'title', 'slug', 'editor', 'author', 'thumbnail', 'content', 'excerpt', 'comments' )
            )
        );
    }

    function add_excerpts_to_pages() {
        add_post_type_support( 'movies', 'content' );
        add_post_type_support( 'movies', 'excerpt' );
    }

    add_action( 'init', 'create_post_type' );

    add_action( 'init', 'add_excerpts_to_pages' );
    
    