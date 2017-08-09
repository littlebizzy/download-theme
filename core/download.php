<?php

/**
 * Download Theme - Download class
 *
 * @package Download Theme
 * @subpackage Download Theme Core
 */
final class DWNTHM_Core_Download {



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

		// Wait to the user initialization
		add_action('admin_init', array(&$this, 'download'));
	}



	// WP Hooks
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Check available download
	 */
	public function download() {

		/* // Check current user capabilities
		if (!is_user_logged_in() || !current_user_can('activate_plugins'))
			return;

		// Check nonce argument
		$plugin_file = $_GET['dwnplg_plugin'];
		if (!wp_verify_nonce($_GET['dwnplg_nonce'], DWNPLG_FILE.$plugin_file))
			return;

		// Dependencies
		if (!class_exists('PclZip'))
			include ABSPATH.'wp-admin/includes/class-pclzip.php';

		// Plugin directory path
		$plugin_file = explode('/', trim($plugin_file, '/'));
		$path_copy = trailingslashit(WP_PLUGIN_DIR).$plugin_file[0];

		// Prepare destination
		$upload_dir = wp_upload_dir();
		$path_temp  = trailingslashit($upload_dir['basedir']).md5(DWNPLG_FILE.microtime().rand(0, 999999));

		// Create the ZIP file
		$archive = new PclZip($path_temp);
		$archive->add($path_copy, PCLZIP_OPT_REMOVE_PATH, WP_PLUGIN_DIR);

		// User download filename
		$download_file = sanitize_file_name($plugin_file[0]).'.zip';

		// Set headers for the zip archive
		@header('Content-type: application/zip');
		@header('Content-Length: '.@filesize($path_temp));
		@header('Content-Disposition: attachment; filename="'.$download_file.'"');

		// Read file content directly
		@readfile($path_temp);

		// Remove zip file
		@unlink($path_temp);

		// End
		die; */
	}



}