<?php
/**
 * The template for displaying archive pages
 *
 * @package knife-theme
 * @since 1.1
 */

get_header(); ?>

<main class="wrap">

	<?php if(have_posts()) : ?>

		<div class="caption block">
			<?php the_archive_title('<h1 class="caption__title">', '</h1>'); ?>
		</div>

	<?php endif; ?>

	<div class="content block">

	<?php
		if(have_posts()) :

			while (have_posts()) : the_post();

				if($wp_query->current_post % 5 === 3 || $wp_query->current_post % 5 === 4)
					get_template_part('template-parts/units/double');
				else
					get_template_part('template-parts/units/triple');

			endwhile;

		else:

			// Include "no posts found" template
			get_template_part('template-parts/content/post', 'none');

		endif;
	?>

	</div>

</main>


<?php

get_footer();
