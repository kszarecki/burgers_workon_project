<?php

function load_stylesheets(){
    wp_register_style('styles', get_template_directory_uri() . '/css/global.min.css', array(), 1, 'all');
}

add_action('wp_enqueue_scripts', 'load_stylesheets');