<?php
/**
 * Template for display single post
 *
 * @package knife-theme
 * @since 1.1
 * @version 1.12
 */

get_header(); ?>

<?php
    if(is_active_sidebar('knife-feature')) :
        dynamic_sidebar('knife-feature');
    endif;
?>

<div class="content">
    <?php
        while(have_posts()) : the_post();

            get_template_part('partials/content');

        endwhile;
    ?>
</div>

<?php get_footer();
