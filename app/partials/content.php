<?php
/**
 * Standart post format content template with sidebar
 *
 * @package knife-theme
 * @since 1.1
 * @version 1.4
 */
?>

<article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
    <header class="post__header">
        <?php
            the_info(
                '<div class="post__header-meta meta">', '</div>',
                ['author', 'date', 'category', 'type']
            );

            the_title(
                '<h1 class="post__header-title">',
                '</h1>'
            );

            the_lead(
                '<div class="post__header-excerpt custom">',
                '</div>'
            );

            the_share(
                '<div class="post__header-share share">', '</div>',
                __('Share post — top', 'knife-theme')
            );
        ?>
    </header>

    <div class="post__content custom">
        <?php the_content(); ?>
    </div>

    <footer class="post__footer">
        <?php
            wp_link_pages([
                'before' => '<div class="post__footer-nav refers">',
                'after' => '</div>',
                'next_or_number' => 'next',
                'nextpagelink' => __('Следующая страница', 'knife-theme'),
                'previouspagelink' => __('Назад', 'knife-theme')
            ]);

            the_share(
                '<div class="post__footer-share share">', '</div>',
                __('Share post — bottom', 'knife-theme'), true
            );

            the_tags(
                '<div class="post__footer-tags refers">',
                null, '</div>'
            );

            the_sidebar(
                'knife-inside',
                '<div class="post__footer-widgets">',
                '</div>'
            );
        ?>
    </footer>
</article>

<?php get_sidebar(); ?>
