<?php if (is_front_page()) : ?>

<!-- BURGER MAKER BANNER -->

<section class="burger_maker--banner" style="<?php echo 'background: url('. MEDIA . "/png/burger_maker_banner.png" .') no-repeat center center / cover;'; ?>">
    <div class="burger_maker_border--top"></div>
    <div class="burger_maker_banner--container d-flex flex-column justify-content-center align-items-center">
        <img src="<?php echo MEDIA . '/svg/burger_maker_banner_title.svg'; ?>" alt="banner_title">
        <h2>Stwórz smacznego burgera</h2>
        <a href='<?php echo get_permalink( get_page_by_title( 'Burger Maker' ) ); ?>'><button class="main_button">Burger Maker</button></a>
    </div>
</section>

<!-- END BURGER MAKER BANNER -->

</main>
<?php else: ?>
</section>

<!-- BURGER MAKER BANNER -->

<section class="burger_maker--banner" style="<?php echo 'background: url('. MEDIA . "/png/burger_maker_banner.png" .') no-repeat center center / cover;'; ?>">
    <div class="burger_maker_border--top"></div>
    <div class="burger_maker_banner--container d-flex flex-column justify-content-center align-items-center">
        <img src="<?php echo MEDIA . '/svg/burger_maker_banner_title.svg'; ?>" alt="banner_title">
        <h2>Stwórz smacznego burgera</h2>
        <a href='<?php echo get_permalink( get_page_by_title( 'Burger Maker' ) ); ?>'><button class="main_button">Burger Maker</button></a>
    </div>
</section>

<!-- END BURGER MAKER BANNER -->

</main>
<?php endif; ?>

<!-- MENU MODAL -->

<section class="menu_modal--container">
    <div class="menu_modal_icon--container">
        <img id="close_icon" src="<?php echo MEDIA . '/svg/close_icon.svg'; ?>" alt="close_icon">
    </div>
    <div class="menu_modal_links--container">
        <?php $main_menu = array(
            'theme_location' => 'main-menu',
            'menu' => 'Main Menu',
            'container' => false,
            'before' => '<span style="
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 5px;
            margin-right: 1.5rem;
            background: #F49521;
            "></span>',
        ); ?>
        <?php
            wp_nav_menu($main_menu)
        ?>
        <!-- <ul>
            <span></span>
            <li><a href='/' class="menu_link--active">Home</a></li>
            <span></span>
            <li><a href='/menu'>Menu</a></li>
            <span></span>
            <li><a href='/opinie'>Opinie</a></li>
            <span></span>
            <li><a href='/burger-maker'>Burger Maker</a></li>
            <span></span>
            <li><a href='/kontakt'>Kontakt</a></li>
            <span></span>
        </ul> -->
    </div>
</section>

<!-- END MENU MODAL -->

<!-- FOOTER -->

<footer>
    <div class="yellow_border"></div>
    <section class="d-flex flex-column">
        <h2>Chcesz nas o coś zapytać ?</h2>
        <p>Napisz do nas za pomocą naszego formularza kontaktowego</p>
        <div class="footer_contact--link d-flex justify-content-between align-items-center">
            <img src="<?php echo MEDIA . '/svg/arrow_left_icon.svg'; ?>" alt="left arrow">
            <a href='<?php echo get_permalink( get_page_by_title( 'Napisz do nas' ) ); ?>'>Zakładka Kontakt</a>
        </div>
        <div class="footer_social_media--container d-flex justify-content-between align-items-center">
            <a href="https://www.facebook.com" target="_blank" rel="noopener">
                <img class="img-fluid" src="<?php echo MEDIA . '/svg/facebook_icon.svg'; ?>" alt="facebook_icon">
            </a>
            <a href="https://www.instagram.com" target="_blank" rel="noopener">
                <img class="img-fluid" src="<?php echo MEDIA . '/svg/instagram_icon.svg'; ?>" alt="instagram_icon">
            </a>
            <a href="https://www.twitter.com" target="_blank" rel="noopener">
                <img class="img-fluid" src="<?php echo MEDIA . '/svg/twitter_icon.svg'; ?>" alt="instagram_icon">
            </a>
        </div>
        <p class='footer_credentials'>WorkOn Project | Designed by freepik.com</p>
    </section>
</footer>

<!-- END FOOTER -->

<?php wp_footer(); ?>
</body>
</html>