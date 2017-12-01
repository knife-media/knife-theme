<?php
/**
 * Mindmap widget template
 *
 * Mindmap is a recent posts template using bright colors
 *
 * @package knife-theme
 * @since 1.1
 */
?>

<article class="widget__item">
	<?php
		printf(
			'<a class="widget__link" href="%1$s">%2$s</a>',
			get_permalink(),
			get_the_title()
		)
	?>
</article>
