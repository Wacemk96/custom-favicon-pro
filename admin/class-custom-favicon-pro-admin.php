<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://waseemk.com
 * @since      1.0.0
 *
 * @package    Custom_Favicon_Pro
 * @subpackage Custom_Favicon_Pro/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Favicon_Pro
 * @subpackage Custom_Favicon_Pro/admin
 * @author     Muhammad Waseem <vasimlive@gmail.com>
 */
class Custom_Favicon_Pro_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Add Meta Box
		add_action('add_meta_boxes', array($this, 'custom_favicon_pro_add_custom_favicon_meta_box'));

		// Save custom favicon meta data
		add_action('save_post', array($this, 'custom_favicon_pro_save_custom_favicon_meta'));

		// Output custom favicon directly in the head section
		add_action('wp_head', array($this, 'custom_favicon_pro_output_custom_favicon_to_head'), 1);
	}

	/**
	 * Register the custom favicon meta box for the post and page editor.
	 *
	 * @since    1.0.0
	 */
	public function custom_favicon_pro_add_custom_favicon_meta_box()
	{
		add_meta_box(
			'cfp-custom-favicon',
			__('Custom Favicon', 'custom-favicon-pro'),
			array($this, 'custom_favicon_pro_custom_favicon_meta_box_callback'),
			array('post', 'page'),
			'side',
			'default'
		);
	}

	/**
	 * Render the content of the custom favicon meta box.
	 *
	 * @since    1.0.0
	 */


	public function custom_favicon_pro_custom_favicon_meta_box_callback($post)
	{
		wp_nonce_field('cfp_custom_favicon_meta_box', 'cfp_custom_favicon_nonce');
		$favicon = get_post_meta($post->ID, '_custom_favicon', true);
		include(plugin_dir_path(__FILE__) . '/partials/custom-favicon-pro-meta-box-display.php');
	}

	/**
	 * Save custom favicon meta data
	 *
	 * @since 1.0.0
	 */

	public function custom_favicon_pro_save_custom_favicon_meta($post_id)
	{
		if (
			!isset($_POST['cfp_custom_favicon_nonce']) ||
			!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['cfp_custom_favicon_nonce'])), 'cfp_custom_favicon_meta_box')
		) {
			return;
		}

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		if (isset($_POST['custom_favicon'])) {
			update_post_meta($post_id, '_custom_favicon', sanitize_text_field($_POST['custom_favicon']));
		}
	}

	/**
	 * Output custom favicon directly in the head section
	 *
	 * @since 1.0.0
	 */
	public function custom_favicon_pro_output_custom_favicon_to_head()
	{
		if (is_singular()) {
			global $post;
			$favicon = get_post_meta($post->ID, '_custom_favicon', true);

			// If custom favicon is empty, get the site's default favicon
			if (empty($favicon)) {
				$site_favicon_url = get_site_icon_url();
				if ($site_favicon_url) {
					$favicon = $site_favicon_url;
				}
			}

			if (!empty($favicon)) {
				// Remove existing favicon links
				remove_action('wp_head', 'wp_site_icon', 99);
				remove_action('wp_head', array($this, 'custom_favicon_pro_output_custom_favicon_to_head'), 1);

				// Add custom favicon link
				echo '<link rel="icon" href="' . esc_url($favicon) . '" type="image/x-icon" />';
			}
		}
	}





	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Favicon_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Favicon_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style(
			$this->plugin_name,
			plugin_dir_url(__FILE__) . 'css/custom-favicon-pro-admin.css',
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Favicon_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Favicon_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script(
			$this->plugin_name,
			plugin_dir_url(__FILE__) . 'js/custom-favicon-pro-admin.js',
			array('jquery'),
			$this->version,
			false
		);
	}
}
