(function ($) {
  'use strict';

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
  jQuery(document).ready(function ($) {
    // Upload button click action
    $('#cfp_upload_favicon_button').click(function (e) {
      e.preventDefault();
      var custom_uploader = wp.media({
        title: cfpData.chooseUploadTitle,
        button: {
          text: cfpData.useFaviconText,
        },
        multiple: false,
      });

      // When a file is selected, grab the URL and set it as the value of the input field
      custom_uploader.on('select', function () {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        $('#custom-favicon').val(attachment.url);
        $('#cfp_custom_favicon_preview').attr('src', attachment.url).show();
        $('#cfp_remove_favicon_button').show();
      });

      custom_uploader.open();
    });

    // Remove button click action
    $('#cfp_remove_favicon_button').click(function (e) {
      e.preventDefault();
      $('#custom-favicon').val('');
      $('#cfp_custom_favicon_preview').attr('src', '').hide();
      $('#cfp_remove_favicon_button').hide();
    });
  });
})(jQuery);
