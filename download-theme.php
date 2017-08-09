<?php
/*
Plugin Name: Download Theme LittleBizzy
Plugin URI: https://www.littlebizzy.com
Description: Quickly and easily download a ZIP file of any theme currently installed on your WordPress website without requiring SFTP info or fancy dependencies.
Version: 1.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Avoid script calls via plugin URL
if (!function_exists('add_action'))
	die;

// This plugin constants
define('DWNTHM_FILE', __FILE__);
define('DWNTHM_PATH', dirname(DWNTHM_FILE));
define('DWNTHM_VERSION', '1.0.0');

// Quick context check
if (!is_admin() || (defined('DOING_AJAX') && DOING_AJAX))
	return;

// Check download request
if (!empty($_GET['dwnthm_plugin']) && !empty($_GET['dwnthm_nonce'])) {
	require_once(DWNTHM_PATH.'/core/download.php');
	DWNTHM_Core_Download::instance();

// Themes page
} elseif (false !== strpos($_SERVER['REQUEST_URI'], '/wp-admin/themes.php')) {
	require_once(DWNTHM_PATH.'/core/themes.php');
	DWNTHM_Core_Themes::instance();
}