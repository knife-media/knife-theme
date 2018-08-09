<?php
/**
 * Cards no-sidebar post format content template
 *
 * @package knife-theme
 * @since 1.1
 */
?>

<section class="content block">

    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">

            <header class="post__header post__card">
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
                        '<div class="post__header-excerpt">',
                        '</div>'
                    );

                    the_share(
                        '<div class="post__header-share share">',
                        '</div>',
                        __('Share cards — top', 'knife-theme')
                    );
                ?>
            </header>

            <div class="post__content custom js-mediator-article">
                <?php the_content(); ?>
            </div>

            <footer class="post__footer post__card">
                <?php
                    wp_link_pages([
                        'before' => '<div class="post__footer-nav refers">',
                        'after' => '</div>',
                        'next_or_number' => 'next',
                        'nextpagelink' => __('Следующая страница', 'knife-theme'),
                        'previouspagelink' => __('Назад', 'knife-theme')
                    ]);

                    the_share(
                        '<div class="post__footer-share share">',
                        '</div>',
                        __('Share cards — bottom', 'knife-theme'),
                        __('Поделиться в соцсетях:', 'knife-theme')
                    );

                    the_tags(
                        '<div class="post__footer-tags refers">',
                        null, '</div>'
                    );
                ?>
            </footer>

        </article>
    <?php endwhile; ?>

</section>
