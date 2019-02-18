<?php
    $meta = get_term_meta($term->term_id, self::$term_meta, true);

    $sizes = [
        'auto' => __('Замостить фон', 'knife-theme'),
        'cover' => __('Растянуть изображение', 'knife-theme'),
        'contain' => __('Подогнать по размеру', 'knife-theme')
    ];
?>

<tr class="form-field hide-if-no-js">
    <th scope="row" valign="top">
        <label><?php _e('Цвет фона', 'knife-theme') ?></label>
    </th>

    <td>
        <div class="knife-background-color">
            <?php
                printf('<input type="text" name="%s[color]" value="%s">',
                    esc_attr(self::$term_meta), $meta['color'] ?? ''
                );
            ?>
        </div>
    </td>
</tr>

<tr class="form-field hide-if-no-js">
    <th scope="row" valign="top">
        <label><?php _e('Фоновое изображение', 'knife-theme') ?></label>
    </th>

    <td>
        <div class="knife-background-image" style="max-width: 300px">
            <?php
                printf('<input type="hidden" name="%s[image]" value="%s">',
                    esc_attr(self::$term_meta), $meta['image'] ?? ''
                );
            ?>

            <p>
                <button class="button select"><?php _e('Выбрать изображение', 'knife-theme'); ?></button>
                <button class="button remove right"><?php _e('Удалить', 'knife-theme'); ?></button>
            </p>

            <p style="margin-top: 10px;">
                <select name="<?php echo esc_attr(self::$term_meta); ?>[size]" style="width: 100%;">
                <?php
                    foreach($sizes as $name => $title) {
                        printf('<option value="%1$s"%3$s>%2$s</option>', $name, $title, selected($meta['size'], $name, false));
                    }
                ?>
                </select>
            </p>
        </div>
    </td>
</tr>
