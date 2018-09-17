<?php
/**
 * Promo filters
 *
 * Filters and actions using for upgrading templates only for promo purpose
 * For example: we can set custom background for certain post here
 *
 * @package knife-theme
 * @since 1.4
 */


/**
 * Skyeng promo
 *
 * Update promo post content with custom button
 */
add_filter('the_content', function($content) {
    if(!is_singular('select') || !in_the_loop()) {
        return $content;
    }

    if(get_post_field('post_name') !== 'study-english') {
        return $content;
    }

    $upload_dir = wp_upload_dir();

    $promo_link = sprintf(
        '<a class="promo promo--skyeng" href="%2$s" target="_blank">%1$s <img src="%3$s" alt=""></a>',
        __('<strong>Хотите выучить английский, <br>но никак не решитесь? </strong>Skyeng дарит бесплатное первое занятие', 'knife-theme'),
        esc_url('https://skyeng.ru/go/knife'),
        esc_url($upload_dir['baseurl'] . '/2018/08/skyeng-logo.png')
    );

    return $content . $promo_link;
});