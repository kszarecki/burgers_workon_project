<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<!-- BURGER LIST ITEM -->

<li class='burger_list_item--container d-flex'>
	<div class="burger_list_item_pic--container">
		<div class="burger_list_item--pic">
			<div class="burger_list_item_border--bottom"></div>
			<div class="burger_list_item_border--left"></div>
			<div class="burger_list_item_border--right"></div>
			<img src="<?php echo get_the_post_thumbnail_url($loop->post->ID); ?>" alt="burger_item_pic_01">
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
	</div>
	<div class="burger_list_item--info">
		<h2 class="burger_list_item--title"><?php echo $product->get_name(); ?></h2>
		<?php echo $product->get_short_description(); ?>
		<p class="burger_list_item--price"><?php echo 'Cena: ' . $product->get_price() . ' ' . get_woocommerce_currency_symbol(); ?></p>
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
</li>

<!-- END BURGER LIST ITEM -->