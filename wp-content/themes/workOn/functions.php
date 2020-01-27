<?php

// CONSTANTS
define('ROOT', get_template_directory_uri());
define('MEDIA', ROOT . '/media');
define('STYLES', ROOT . '/styles/css');
define('SCRIPTS', ROOT . '/scripts');

// ADD STYLES
function theme_styles(){
    wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css?family=Pacifico|Roboto:400,900&display=swap&subset=latin-ext');
    wp_enqueue_style('global_styles', ROOT . '/style.css');
    wp_enqueue_style('styles', STYLES . '/global.min.css');
}

add_action('wp_enqueue_scripts', 'theme_styles');

// ADD SCRIPTS
function theme_scripts(){
    wp_enqueue_script('scripts', SCRIPTS . '/app.js', array(), '1.0', true);
}

add_action('wp_enqueue_scripts', 'theme_scripts');

// ADD MENU
function register_menu() {
    register_nav_menu('main-menu', 'Main Menu');
}

add_action('init', 'register_menu');

// ENABLE POST THUMBNAILS
add_theme_support('post-thumbnails');

// ADD LINK ACTIVE CLASS
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
        $classes[] = 'active';
    }
    return $classes;
}