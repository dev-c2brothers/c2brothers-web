<?php

function c2brothers_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );

    register_nav_menus( array(
        'primary' => __( 'Menú principal', 'c2brothers' ),
    ) );
}
add_action( 'after_setup_theme', 'c2brothers_setup' );

function c2brothers_enqueue_assets() {
    // Inter (Google Fonts)
    wp_enqueue_style(
        'c2brothers-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );

    // CSS principal
    wp_enqueue_style(
        'c2brothers-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array( 'c2brothers-fonts' ),
        '1.0.0'
    );

    // JS principal (footer)
    wp_enqueue_script(
        'c2brothers-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'c2brothers_enqueue_assets' );
