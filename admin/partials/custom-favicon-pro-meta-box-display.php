<?php
wp_enqueue_script('custom-favicon-pro-script', 'js/custom-favicon-pro-admin.js', array('jquery'), '1.0', true);

$script_data = array(
    'chooseUploadTitle' => __('Choose or Upload Favicon', 'custom-favicon-pro'),
    'useFaviconText' => __('Use this Favicon', 'custom-favicon-pro')
);
wp_localize_script('custom-favicon-pro-script', 'cfpData', $script_data);
?>
<p>
  <label for="custom-favicon"><?php esc_html_e('Custom Favicon:', 'custom-favicon-pro'); ?></label><br />
  <input type="hidden" id="custom-favicon" name="custom_favicon" value="<?php echo esc_attr($favicon); ?>" />
  <img id="cfp_custom_favicon_preview" src="<?php echo esc_url($favicon); ?>"
    alt="<?php esc_attr_e('Custom Favicon', 'custom-favicon-pro'); ?>"
    style="max-width: 100px; margin-bottom: 10px; display: <?php echo empty($favicon) ? 'none' : 'block'; ?>" /><br />
  <input type="button" id="cfp_upload_favicon_button" class="button"
    value="<?php esc_attr_e('Upload Favicon', 'custom-favicon-pro'); ?>" />
  <input type="button" id="cfp_remove_favicon_button" class="button"
    value="<?php esc_attr_e('Remove Favicon', 'custom-favicon-pro'); ?>"
    style="display: <?php echo empty($favicon) ? 'none' : 'inline-block'; ?>" />
</p>