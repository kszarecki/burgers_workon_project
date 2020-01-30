<?php get_header(); ?>

<!-- BURGER LIST DISPLAY -->

<?php 
$product = get_product(get_the_ID());
$reviews = array('posts_per_page' => -1, 'post_type' => 'reviews', 'orderby' => 'title', 'order' => 'ASC');
$products = array('posts_per_page' => -1, 'post_type' => 'product', 'orderby' => 'title');
$wc_query_products = new WP_Query($products);
$wc_query_reviews = new WP_Query($reviews);
?>

<section class="home_burger_list_display--container d-flex flex-column">
    <div class="home_burger_list_items--container d-flex">

        <!-- WHILE LOOP -->

        <?php if ($wc_query_products->have_posts()) : ?>
        <?php while ($wc_query_products->have_posts()) :
                    $wc_query_products->the_post(); ?>

        <!-- BURGER LIST ITEM -->

        <div class="home_burger_list_item--container d-flex">
            <div class="burger_list_item_pic--container">
                <div class="burger_list_item--pic">
                    <div class="burger_list_item_border--bottom"></div>
                    <div class="burger_list_item_border--left"></div>
                    <div class="burger_list_item_border--right"></div>
                    <img src="<?php echo get_the_post_thumbnail_url($loop->post->ID); ?>" alt="burger_item_pic">
                </div>
                <div class="burger_list_item--ranking d-flex justify-content-center align-items-center">
                    <?php
                    $product_ranking = get_post_meta($post->ID, 'ranking', true);
                    $rest = 5 - $product_ranking;

                    $full_stars_arr = range(1, $product_ranking);
                    if ($rest > 0) {
                        $empty_stars_arr = range(1, $rest);
                    } else {
                        $empty_stars_arr = 0;
                    };
                    ?>

                    <!-- FULL STARS LOOP -->
                    <?php foreach($full_stars_arr as $value): ?>
                        <div class="star--full"></div>
                    <?php endforeach; ?>
                    <!-- END FULL STARS LOOP -->

                    <?php if ($empty_stars_arr === 0) :?>
                    <?php else : ?>
                        <!-- EMPTY STARS LOOP -->
                        <?php foreach($empty_stars_arr as $value): ?>
                            <div class="star--empty"></div>
                        <?php endforeach; ?>
                        <!-- EMPTY STARS LOOP -->
                    <?php endif; ?>
                </div>
                <h2><?php echo $product->get_title(); ?></h2>
            </div>
        </div>

        <!-- END BURGER LIST ITEM -->

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        <?php else:  ?>
        <h1>
            <?php _e( '...Brak produktów...' ); ?>
        </h1>
        <?php endif; ?>

        <!-- END WHILE LOOP -->

    </div>
    <a href='<?php echo get_permalink( get_page_by_title( 'Lista Burgerów' ) );?>'><button class="main_button">Sprawdź menu</button></a>
</section>

<!-- END BURGER LIST DISPLAY -->

<!-- REVIEW SLIDER -->

<section class="review_slider--container d-flex flex-column justify-content-between">
    <h2>Poznaj opinie naszych klientów</h2>
    <div class="review_quote--container d-flex justify-content-center align-items-center">
        <div class="review_border--left"></div>
        <div class="review_border--right"></div>
        <div class="review_quote">
            <img id="quote_up" src="<?php echo MEDIA . '/svg/quote_icon.svg'; ?>" alt="quote_icon_up">
            <img id="quote_down" src="<?php echo MEDIA . '/svg/quote_icon.svg'; ?>" alt="quote_icon_down">

            <!-- WHILE LOOP -->

            <?php if ($wc_query_reviews->have_posts()) : ?>
            <?php while ($wc_query_reviews->have_posts()) :
                        $wc_query_reviews->the_post(); ?>
            <?php if ($post->post_title !== 'Opinia 1') : ?>
                <p class="home_quote_paragraph" style="display: none;">
            <?php else : ?>
                <p class="home_quote_paragraph">
            <?php endif; ?>
                <?php 
                $content = $post->post_content;
                $trim_content = substr($content, 0, 200);
                echo $trim_content . '..';
                ?>
            </p>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php else:  ?>
            <p>
                <?php _e( '...Brak opinii...' ); ?>
            </p>
            <?php endif; ?>

            <!-- END WHILE LOOP -->
        </div>
    </div>
    <div class="review_slider_control_panel--container d-flex justify-content-between align-items-center">
        <button class="review_slider--prev"></button>
        <div class="review_slider--more">
            <a href='<?php echo get_permalink( get_page_by_title( 'Opinie Klientów' ) );?>'></a>
        </div>
        <button class="review_slider--next"></button>
    </div>
</section>

<!-- REVIEW SLIDER -->

<?php get_footer(); ?>