<?php
/**
 * Single widget
 *
 * Full-width widget
 *
 * @package knife-theme
 * @since 1.1
 * @version 1.15
 */


class Knife_Widget_Single extends WP_Widget {

    public function __construct() {
        $widget_ops = [
            'classname' => 'single',
            'description' => __('Выводит пост в виде широкого модуля', 'knife-theme'),
            'customize_selective_refresh' => true
        ];

        parent::__construct('knife_widget_single', __('[НОЖ] На всю ширину', 'knife-theme'), $widget_ops);
    }


     /**
     * Outputs the content of the widget.
     */
    public function widget($args, $instance) {
        $defaults = [
            'title' => '',
            'cover' => 0,
            'link' => '',
            'picture' => ''
        ];

        $instance = wp_parse_args((array) $instance, $defaults);

        $exclude = get_query_var('widget_exclude', []);
        $post_id = $this->find_postid($instance['link']);

        $query = new WP_Query([
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'post_type' => 'any',
            'ignore_sticky_posts' => 1,
            'post__in' => [$post_id]
        ]);

        if($query->have_posts()) {
            echo $args['before_widget'];

            $query->the_post();

            if(empty($instance['title'])) {
                $instance['title'] = get_the_title();
            }

            $instance['link'] = get_permalink();

            // Include single widget template
            include(get_template_directory() . '/templates/widget-single.php');

            set_query_var('widget_exclude', array_merge($exclude, wp_list_pluck($query->posts, 'ID')));
            wp_reset_query();

            echo $args['after_widget'];
        }
    }


    /**
     * Sanitize widget form values as they are saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['link'] = sanitize_text_field($new_instance['link']);
        $instance['cover'] = absint($new_instance['cover']);

        return $instance;
    }

    /**
     * Back-end widget form.
     */
    public function form($instance) {
        $defaults = [
            'title' => '',
            'teaser' => '',
            'link' => '',
            'cover' => 0,
            'picture' => ''
        ];

        $instance = wp_parse_args((array) $instance, $defaults);

        printf(
            '<p><label for="%1$s">%3$s</label><input class="widefat" id="%1$s" name="%2$s" type="text" value="%4$s"><small>%5$s</small></p>',
            esc_attr($this->get_field_id('link')),
            esc_attr($this->get_field_name('link')),
            __('Ссылка:', 'knife-theme'),
            esc_attr($instance['link']),
            __('На запись c этого сайта или тизер', 'knife-theme')
        );

        $post_id = $this->find_postid($instance['link']);

        if(empty($post_id)) {
            printf(
                '<p><span class="dashicons dashicons-warning"></span> <strong>%s</strong></p>',
                __('Запись не найдена', 'knife-theme')
            );
        }

        if($cover = wp_get_attachment_url($instance['cover'])) {
            $instance['picture'] = sprintf('<img src="%s" alt="" style="max-width: 100%%;">', esc_url($cover));
        }

        printf(
            '<p>%5$s<input id="%1$s" name="%2$s" type="hidden" value="%3$s"><button type="button" class="button knife-widget-image">%4$s</button></p>',
            esc_attr($this->get_field_id('cover')),
            esc_attr($this->get_field_name('cover')),
            esc_attr($instance['cover']),
            __('Выбрать обложку', 'knife-theme'),
            $instance['picture']
        );

        printf(
            '<p><label for="%1$s">%3$s</label><input class="widefat" id="%1$s" name="%2$s" type="text" value="%4$s"><small>%5$s</small></p>',
            esc_attr($this->get_field_id('title')),
            esc_attr($this->get_field_name('title')),
            __('Заголовок:', 'knife-theme'),
            esc_attr($instance['title']),
            __('Заполните, чтобы изменить заголовок записи', 'knife-theme')
        );
    }

    /**
     * Try to find post ID by teaser link.
     */
    private function find_postid($link) {
        $post_id = url_to_postid($link);

        if($post_id > 0) {
            return $post_id;
        }

        if(method_exists('Knife_Promo_Manager', 'find_postid')) {
            $post_id = Knife_Promo_Manager::find_postid($link);
        }

        return $post_id;
    }
}


/**
 * It is time to register widget
 */
add_action('widgets_init', function() {
    register_widget('Knife_Widget_Single');
});
