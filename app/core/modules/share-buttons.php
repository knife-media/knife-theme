<?php
/**
 * Share buttons
 *
 * Share buttons manager class
 *
 * @package knife-theme
 * @since 1.3
 * @version 1.11
*/

if (!defined('WPINC')) {
    die;
}

class Knife_Share_Buttons {
    /**
     * Print social share buttons template
     */
    public static function get_buttons($output = '') {
        $settings = self::get_settings();

        foreach($settings as $network => $data) {
            $text = sprintf(
                '<span class="icon icon--%2$s"></span><span class="share__text">%1$s</span>',
                esc_html($data['text']), $network
            );

            $link = sprintf($data['link'],
                esc_url(get_permalink()),
                urlencode(strip_tags(get_the_title()))
            );

            $item = sprintf('<a class="share__link share__link--%3$s" href="%2$s" data-label="%3$s" target="_blank">%1$s</a>',
                $text, esc_url($link), esc_attr($network)
            );

            $output = $output . $item;
        }

        return $output;
    }


    /**
     * Return pre-defined buttons settings
     *
     * @since 1.6
     */
    public static function get_settings() {
        $settings = [
            'vkontakte' => [
                'link' => 'https://vk.com/share.php?url=%1$s&title=%2$s',
                'text' => __('Поделиться', 'knife-theme')
            ],

            'facebook' => [
                'link' => 'https://www.facebook.com/sharer/sharer.php?u=%1$s',
                'text' => __('Пошерить', 'knife-theme')
            ],

            'telegram' => [
                'link' => 'https://tgram.link/share/url?url=%1$s&text=%2$s',
                'text' => __('Репостнуть', 'knife-theme')
            ],

            'twitter' => [
                'link' => 'https://twitter.com/intent/tweet?url=%1$s&text=%2$s',
                'text' => __('Твитнуть', 'knife-theme')
            ]
        ];

        return $settings;
    }
}
