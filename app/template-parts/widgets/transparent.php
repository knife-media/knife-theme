<?php
/**
 * Transparent widget template
 *
 * Transparent is a transparent stripe with optional sticker
 *
 * @package knife-theme
 * @since 1.1
 */
?>

<article class="widget__item">
	<a class="widget__link" href="<?php the_permalink(); ?>">
		<?php
			knife_theme_post_meta([
				'item' => '<img class="widget__sticker" src="%s">',
				'meta' => 'post-sticker'
			]);
		?>

		<footer class="widget__footer">
			<?php
				knife_theme_meta([
					'items' => ['author', 'date'],
					'before' => '<div class="widget__meta meta">',
					'after' => '</div>',
					'is_link' => false
				]);

				the_title('<p class="widget__title">', '</p>');
			?>
		</footer>
	</a>
</article>
