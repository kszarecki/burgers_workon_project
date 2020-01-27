<?php 

/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>

<!-- 404 INFO -->

<div class="not_found_info--container d-flex flex-column" style="width: 90%; max-width: 960px; margin: 0 auto; padding: 0 1.25rem;">
    <h1>Coś poszło nie tak...</h1>
    <p>Strona, którą szukasz nie istnieje. Przejdź do strony głównej.</p>
    <a href="<?php echo get_home_url();?>">Strona główna</a>
</div>

<!-- END 404 INFO -->

<?php get_footer(); ?>