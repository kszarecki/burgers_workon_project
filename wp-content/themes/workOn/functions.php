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

// ADD WOOCOMMERCE
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// ADD LINK ACTIVE CLASS
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
        $classes[] = 'active';
    }
    return $classes;
}

// ADD CUSTOM TAXONOMY
function add_custom_taxonomy() {
    $reviews_cats_args = array(
        'hierarchical' => true,
        'label' => 'Kategorie opinii',
        'labels' => array('name' => 'Kategorie opinii', 'menu_name' => 'Kategorie opinii')
    );

    register_taxonomy('taxonomy_reviews', array('reviews'), $reviews_cats_args);
}
add_action('init', 'add_custom_taxonomy', 0);

// ADD CUSTOM POST TYPE
function add_custom_post_types() {
    $reviews_args = array(
        'label' => '',
        'labels' => array('name' => 'Opinie', 'menu_name' => 'Opinie'),
        'supports' => array('title', 'thumbnail', 'editor', 'custom-fields'),
        'public' => true,
        'exclude_from_search' => false,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-admin-post',
        'taxonomies' => array('taxonomy_reviews')
    );

    register_post_type('reviews', $reviews_args);
}
add_action('init', 'add_custom_post_types', 0);

// REMOVE SHIPPING METHOD TITLE
function remove_title_from_shipping_label($full_label, $method){
    return str_replace('Płaska Stawka: ', "", $full_label);
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'remove_title_from_shipping_label', 10, 2 );

// OVERRIDE INPUTS
// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_first_name']['placeholder'] = 'Imię';
     $fields['billing']['billing_last_name']['placeholder'] = 'Nazwisko';
     $fields['billing']['billing_company']['placeholder'] = 'Nazwa firmy (opcjonalnie)';
     unset($fields['billing']['billing_country']);
     $fields['billing']['billing_postcode']['placeholder'] = 'Kod pocztowy';
     unset($fields['billing']['billing_city']);
     $fields['billing']['billing_phone']['placeholder'] = 'Numer kontaktowy';
     $fields['billing']['billing_email']['placeholder'] = 'E-mail';

     $fields['shipping']['shipping_first_name']['placeholder'] = 'Imię';
     $fields['shipping']['shipping_last_name']['placeholder'] = 'Nazwisko';
     $fields['shipping']['shipping_company']['placeholder'] = 'Nazwa firmy (opcjonalnie)';
     unset($fields['shipping']['shipping_country']);
     $fields['shipping']['shipping_postcode']['placeholder'] = 'Kod pocztowy';
     unset($fields['shipping']['shipping_city']);
     $fields['shipping']['shipping_phone']['placeholder'] = 'Numer kontaktowy';
     $fields['shipping']['shipping_email']['placeholder'] = 'E-mail';

     return $fields;
}

// CUSTOM SHIPPING MESSAGE
add_filter( 'woocommerce_no_shipping_available_html', 'my_custom_no_shipping_message' );
add_filter( 'woocommerce_cart_no_shipping_available_html', 'my_custom_no_shipping_message' );
function my_custom_no_shipping_message( $message ) {
    return __( 'Wysyłamy tylko do Bydgoszczy.' );
}

// CUSTOM POSTCODE VALIDATION
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    global $woocommerce;

    // Check if set, if its not set add an error. This one is only requite for companies
    if ( ! (preg_match('/^([0-9]{2})(-[0-9]{3})?$/i', $_POST['billing_postcode'] ))){
        wc_add_notice( "Nieprawidłowy kod pocztowy."  ,'error' );
    }
}