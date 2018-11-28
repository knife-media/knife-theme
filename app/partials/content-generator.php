<?php
/**
 * Single generator post type content template
 *
 * @package knife-theme
 * @since 1.6
 */
?>

<article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
    <div class="entry-generator" id="generator">
        <?php
            the_title(
                '<h1 class="entry-generator__title">',
                '</h1>'
            );

            the_lead(
                '<div class="entry-generator__content">',
                '</div>'
            );
        ?>
    </div>

    <?php if(comments_open()) : ?>
        <div class="entry-comments">
            <?php
                printf(
                    '<button class="entry-comments__button button" id="load-comments">%s</button>',
                    __('Комментарии', 'knife-media')
                );
            ?>
        </div>
    <?php endif; ?>

    <div class="entry-footer">
        <?php
            the_tags(
                '<div class="entry-footer__tags tags">', null, '</div>'
            );

            the_share(
                '<div class="entry-footer__share share">', '</div>',
                __('Share generator — bottom', 'knife-theme')
            );
        ?>
    </div>
</article>
