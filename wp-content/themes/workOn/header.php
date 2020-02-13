<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); wp_title('|'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class('test'); ?>>

<!-- HEADER BACKGROUND -->

<img id="header_background" src="<?php echo MEDIA . '/jpg/header_background.jpg'; ?>" alt="header_background">

<!-- END HEADER BACKGROUND -->

<!-- HEADER -->

<header>
    <section>
        <nav class='d-flex justify-content-between align-items-center'>
            <a href="<?php echo get_home_url();?>">
                <img id="logo_icon" class='img-fluid' src="<?php echo MEDIA . '/svg/logo_icon.svg'; ?>" alt="logo">
                <img id="logo_icon_mobile" class='img-fluid' src="<?php echo MEDIA . '/svg/logo_icon_mobile.svg'; ?>" alt="logo_mobile">
            </a>
            <div class="d-flex align-items-center">
                <a href="<?php echo get_permalink( get_page_by_title( 'Twój Koszyk' ) );?>" data-counter="0">
                    <span class='cart_counter'><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span>
                    <img id="cart_icon" src="<?php echo MEDIA . '/svg/cart_icon.svg'; ?>" alt="cart_icon">
                </a>
                <img id="hamburger_icon" class='img-fluid' src="<?php echo MEDIA . '/svg/menu_icon.svg'; ?>" alt="menu_icon">
            </div>
        </nav>
        <?php if (is_product() || is_shop()) : ?>
        <div class='hero_image--container' style="<?php echo 'background: url('. MEDIA . '/jpg/menu_hero_image.jpg' . ') no-repeat center center / cover;'; ?>">
            <h1><?php if (is_product()) {
                echo get_the_title();
            } else { echo 'Lista Burgerów'; }; ?></h1>
            <img id="arrow_down_icon" class='arrow_down--button img-fluid' src="<?php echo MEDIA . '/svg/arrow_down_icon.svg'; ?>" alt="arrow_down" />
        </div>
        <?php else: ?>
        <div class='hero_image--container' style="<?php echo 'background: url('. get_the_post_thumbnail_url() . ') no-repeat center center / cover;'; ?>">
            <h1><?php echo get_the_title(); ?></h1>
            <img id="arrow_down_icon" class='arrow_down--button img-fluid' src="<?php echo MEDIA . '/svg/arrow_down_icon.svg'; ?>" alt="arrow_down" />
        </div>
        <?php endif; ?>
    </section>
</header>

<!-- END HEADER -->

<!-- MAIN -->
<?php if (is_front_page()) : ?>
    <main class="front_page--container" data-title='Wybierz swój ulubiony burger'>
<?php else: ?>
    <main class="page--container">
    <section class="page_overlay--container d-flex flex-column align-items-center">
        <div class="main_border main_border--top"></div>
        <div class="main_border main_border--left"></div>
        <div class="main_border main_border--right"></div>
<?php endif; ?>