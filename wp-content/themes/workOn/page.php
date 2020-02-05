<?php if (get_post()->post_title === 'Burger Maker') : ?>
    <?php acf_form_head(); ?>
<?php endif; ?>
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

<!-- DISPLAY CONTACT -->
<?php if (get_post()->post_title === 'Napisz do nas') : ?>
    <?php echo do_shortcode('[wpforms id="192"]'); ?>
<?php endif; ?>
<!-- END DISPLAY CONTACT -->

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

<!-- DISPLAY BURGER MAKER -->
<?php if (get_post()->post_title === 'Burger Maker') : ?>
<?php
$query = new WC_Product_Query( array(
    'limit' => 1,
    'category' => array( 'burger-maker' )
) );
$burger_maker = $query->get_products()[0];
$field = get_field_object('field_5e2ffcf74cb91');
$fields_checked = get_field_objects($burger_maker->get_id())['skladniki']['value'];
$first_three_items = array_slice($field['choices'], 0, 3);
$last_three_items = array_slice($field['choices'], 3, );
?>
    <div class="burger_maker--container">

        <!-- BURGER MAKER VISUALIZATION -->

        <div class="burger_maker_visualization--container">
            <img id="burger_top_graphic" src="<?php echo MEDIA . '/svg/burger_top.svg'; ?>" alt="burger_top">
            <img id="green_graphic" src="<?php echo MEDIA . '/svg/green.svg'; ?>" alt="green" style="display: none;">
            <img id="cucumbers_graphic" src="<?php echo MEDIA . '/svg/cucumbers.svg'; ?>" alt="cucumbers" style="display: none;">
            <img id="tomatoes_graphic" src="<?php echo MEDIA . '/svg/tomatoes.svg'; ?>" alt="tomatoes" style="display: none;">
            <img id="onion_rings_graphic" src="<?php echo MEDIA . '/svg/onion_rings.svg'; ?>" alt="onion_rings" style="display: none;">
            <img id="cheese_graphic" src="<?php echo MEDIA . '/svg/cheese.svg'; ?>" alt="cheese">
            <img id="meat_graphic" src="<?php echo MEDIA . '/svg/meat.svg'; ?>" alt="meat">
            <img id="burger_bottom_graphic" src="<?php echo MEDIA . '/svg/burger_bottom.svg'; ?>" alt="burger_bottom">
        </div>

        <!-- END BURGER MAKER VISUALIZATION -->

        <!-- BURGER MAKER FORM -->

        <p id='current_ingredients'>Wybrane składniki: 

            <?php foreach($fields_checked as $key => $ingredient) : ?>
                <span>
                    <?php
                        if ($key === 0) {
                            echo '-- ' . $ingredient['value'];
                        } else {
                            echo '-- ' . $ingredient['value'] . ' --';
                        }
                    ?>
                </span>
            <?php endforeach; ?>
        </p>

        <ul>
            <li>Składniki</li>
            <li>
                <ul>
                    <li>
                        <ul>
                            <?php foreach($first_three_items as $key => $ingredient) : ?>
                                <li>
                                    <label for="<?php echo $key; ?>">
                                        <input
                                        name="<?php echo $key; ?>"
                                        id="<?php echo $key; ?>"
                                        type="checkbox"
                                        <?php foreach($fields_checked as $arr) {
                                            if (in_array($key, $arr)) {
                                                echo 'checked';
                                            };
                                        } ?> >
                                        <?php echo $ingredient; ?>
                                    </label>
                                    <div id="<?php echo 'thumbnail_' . $key; ?>"></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <?php foreach($last_three_items as $key => $ingredient) : ?>
                                <li>
                                    <label for="<?php echo $key; ?>">
                                        <input
                                        name="<?php echo $key; ?>"
                                        id="<?php echo $key; ?>"
                                        type="checkbox"
                                        <?php foreach($fields_checked as $arr) {
                                            if (in_array($key, $arr)) {
                                                echo 'checked';
                                            };
                                        } ?> >
                                        <?php echo $ingredient; ?>
                                    </label>
                                    <div id="<?php echo 'thumbnail_' . $key; ?>"></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- END BURGER MAKER FORM -->

        <?php $id = $burger_maker-> get_id(); 
        echo do_shortcode(
            '[enh_ajax_add_to_cart_button product="'. $id .'" button_text="Zamów Burger" title="none" quantity="1"]'
        ); ?>
    </div>
<?php endif; ?>
<!-- END DISPLAY BURGER MAKER -->

<?php get_footer(); ?>