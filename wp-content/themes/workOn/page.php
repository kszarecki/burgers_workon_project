<?php get_header(); ?>

<!-- DISPLAY CART -->
<?php if (is_cart()) : ?>
    <?php echo do_shortcode("[woocommerce_cart]"); ?>
<?php endif; ?>
<!-- END DISPLAY CART -->

<!-- DISPLAY CHECKOUT -->
<?php if (is_checkout()) : ?>
    <?php echo do_shortcode("[woocommerce_checkout]"); ?>
<?php endif; ?>
<!-- END DISPLAY CHECKOUT -->

<!-- DISPLAY REVIEWS -->
<?php if (get_post()->post_title === 'Opinie Klientów') : ?>

    <?php
    $reviews = array('posts_per_page' => -1, 'post_type' => 'reviews', 'orderby' => 'title', 'order' => 'ASC');
    $wc_query_reviews = new WP_Query($reviews);
    ?>

    <!-- WHILE LOOP -->

    <?php if ($wc_query_reviews->have_posts()) : ?>
    <?php while ($wc_query_reviews->have_posts()) :
                $wc_query_reviews->the_post(); ?>

    <!-- REVIEW LIST ITEM -->

    <div class="review_list_item--container d-flex">
        <div class="review_list_avatar--container d-flex flex-column justify-content-center align-items-center">
            <img src="<?php echo MEDIA . '/svg/comment_icon.svg'; ?>" alt="comment_icon">
            <h2><?php echo get_post_meta($post->ID, 'username', true) ?></h2>
            <div class="review_list_item--ranking d-flex justify-content-center align-items-center">
                <?php
                $review_ranking = get_post_meta($post->ID, 'ranking', true);
                $rest = 5 - $review_ranking;

                $full_stars_arr = range(1, $review_ranking);
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
        </div>
        <div class="review_list_quote--container d-flex justify-content-center align-items-center">
            <img src="<?php echo MEDIA . '/svg/quote_icon.svg'; ?>" alt="quote_icon">
            <img src="<?php echo MEDIA . '/svg/quote_icon.svg'; ?>" alt="quote_icon">
            <p><?php echo $post->post_content; ?></p>
        </div>
    </div>

    <!-- END REVIEW LIST ITEM -->

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
    <?php else:  ?>
    <h1>
        <?php _e( '...Brak opinii...' ); ?>
    </h1>
    <?php endif; ?>

    <!-- END WHILE LOOP -->

<?php endif; ?>
<!-- END DISPLAY REVIEWS -->

<?php get_footer(); ?>