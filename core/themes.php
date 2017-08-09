<?php

/**
 * Download Theme - Themes class
 *
 * @package Download Theme
 * @subpackage Download Theme Core
 */
final class DWNPLG_Core_Themes {



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
		add_action('admin_footer', array(&$this, 'admin_footer'));
	}



	// WP Filters
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Link actions hook handler
	 */
	public function admin_footer() {

		/* // Download URL
		$download_url = add_query_arg(array(
			'dwnplg_plugin' => urlencode($plugin_file),
			'dwnplg_nonce'  => wp_create_nonce(DWNPLG_FILE.$plugin_file),
		), admin_url());

		// Add the download link
		$plugin_meta[] = '<a href="'.esc_url($download_url).'">Download</a>';

		// Done
		return $plugin_meta; */
	}



}