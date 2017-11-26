<?php
/**
* Custom theme post settings
*
* Using for providing post cover on loops functionality
*
* @package knife-theme
* @since 1.1
*/

new Knife_Post_Settings;

class Knife_Post_Settings {
	private $cover = '_knife-theme-cover';

	public function __construct() {
		add_filter('admin_post_thumbnail_html', [$this, 'cover_checkbox'], 10, 3);
		add_action('save_post', [$this, 'cover_save']);
	}

	/**
	 * Prints checkbox in post thumbnail editor metabox
	 */
	public function cover_checkbox($content, $post_id, $thumbnail_id = '')  {
		if (get_post_type($post_id) !== 'post' || empty($thumbnail_id))
			return $content;

		$cover = get_post_meta($post_id, $this->cover, true);

		$check = sprintf(
			'<p><input type="checkbox" id="knife-theme-cover" name="%1$s" class="checkbox"%3$s><label for="knife-theme-cover"> %2$s</label></p>',
			esc_attr($this->cover),
			__('Использовать подложку в списках', 'knife-theme'),
			checked($cover, 1, false)
		);

		return $check . $content;
	}

	/**
	 * Save post options
	 */
	public function cover_save($post_id, $post) {
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return;

		if(!current_user_can('edit_post', $post_id))
			return;

		$cover = $_REQUEST[$this->cover] ? 1 : 0;

		return update_post_meta($post_id, $this->cover, $cover);
	}
}
