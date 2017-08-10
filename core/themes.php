<?php

/**
 * Download Theme - Themes class
 *
 * @package Download Theme
 * @subpackage Download Theme Core
 */
final class DWNTHM_Core_Themes {



	// Properties
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Single class instance
	 */
	private static $instance;



	// Initialization
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Create or retrieve instance
	 */
	public static function instance() {

		// Check instance
		if (!isset(self::$instance))
			self::$instance = new self;

		// Done
		return self::$instance;
	}



	/**
	 * Constructor
	 */
	private function __construct() {

		// Add footer hook
		add_action('admin_footer', array(&$this, 'admin_footer'), 0);
	}



	// WP Filters
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Link actions hook handler
	 */
	public function admin_footer() {

		// Prepare links
		$themes = array_keys(wp_get_themes());
		if (empty($themes) || !is_array($themes))
			return;

		// Initialize
		$links = array();

		// Array of links
		foreach ($themes as $theme_dir) {
			$links[$theme_dir] = add_query_arg(array(
				'dwnthm_theme' => urlencode($theme_dir),
				'dwnthm_nonce' => wp_create_nonce(DWNTHM_FILE.$theme_dir),
			), admin_url());
		}

		// Display ?>
		<script type="text/javascript">

			jQuery(document).ready(function($) {

				var dwnthm_links = <?php echo @json_encode($links); ?>;
				var n, html = $('#tmpl-theme-single').html();

				var mark = "<# if ( ! data.active && data.actions['delete'] ) { #>";
				if (-1 !== (n = html.indexOf(mark))) {

					html = html.substr(0, n) + '<a href="#" class="dwnthm-download" style="position: absolute; right: 10px; bottom: 10px; text-decoration: none; font-weight: bold;">Download</a>' + "\n" + html.substr(n);
					html = html.replace('class="button delete-theme"', 'class="button delete-theme" style="right: 85px;"');
					$('#tmpl-theme-single').html(html);

					$(document).on('click', '.dwnthm-download', function() {
						var html = $(this).closest('.theme-actions').html();
						html = html.split('?theme=');
						if (html.length > 1) {
							html = html[1].split('&amp;');
							if (html[0] in dwnthm_links)
								window.location.href = dwnthm_links[html[0]];
						}
						return false;
					});
				}
			});

		</script><?php
	}



}