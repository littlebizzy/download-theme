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

		// Check current user capabilities
		if (!is_user_logged_in() || !current_user_can('edit_theme_options'))
			return;

		// Check nonce argument
		$theme_dir = $_GET['dwnthm_theme'];
		if (!wp_verify_nonce($_GET['dwnthm_nonce'], DWNTHM_FILE.$theme_dir))
			return;

		// Dependencies
		if (!class_exists('PclZip'))
			include ABSPATH.'wp-admin/includes/class-pclzip.php';

		// Themes directory
		$themes_root = get_theme_root();

		// Plugin directory path
		$path_copy = trailingslashit($themes_root).$theme_dir;

		// Prepare destination
		$upload_dir = wp_upload_dir();
		$path_temp  = trailingslashit($upload_dir['basedir']).md5(DWNTHM_FILE.microtime().rand(0, 999999));

		// Create the ZIP file
		$archive = new PclZip($path_temp);
		$archive->add($path_copy, PCLZIP_OPT_REMOVE_PATH, $themes_root);

		// User download filename
		$download_file = sanitize_file_name($theme_dir).'.zip';

		// Set headers for the zip archive
		@header('Content-type: application/zip');
		@header('Content-Length: '.@filesize($path_temp));
		@header('Content-Disposition: attachment; filename="'.$download_file.'"');

		// Read file content directly
		@readfile($path_temp);

		// Remove zip file
		@unlink($path_temp);

		// End
		die;
	}



}