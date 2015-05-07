<?php
/**
 * Define Constants
 */
define('WPLOGVIEWER_BASE', str_replace('api', '', dirname(__FILE__)));

// Register autoloader
require_once WPLOGVIEWER_BASE . 'autoload.php';


/**
 * Dependencies
 */
use Allbitsnbytes\WPLogViewer\Router;


/**
 * Get Router instance and process requests
 */
$router = Router::getInstance();

if (!is_object($router)) {
	header('HTTP/1.0 403 Forbidden');
	die;
}


/**
 * Register routes
 */

// Get log file details
$router->get('get-log', ['\Allbitsnbytes\WPLogViewer\Api', 'get_log_details']);

// Check if log file has been modified
$router->get('log-changed', ['\Allbitsnbytes\WPLogViewer\Api', 'check_if_log_modified']);

// Check if log file exists
$router->get('log-exists', ['\Allbitsnbytes\WPLogViewer\Api', 'check_if_log_exists']);

// Check if debugging is enabled
$router->get('debug-enabled', ['\Allbitsnbytes\WPLogViewer\Api', 'check_if_debug_enabled']);

// Get log entries
$router->get('get-entries', ['\Allbitsnbytes\WPLogViewer\Api', 'get_log_entries']);

// Get log entries if log file was modified
$router->get('get-entries-if-modified', ['\Allbitsnbytes\WPLogViewer\Api', 'get_log_entries_if_modified']);

// Clear log file
$router->get('clear-log', ['\Allbitsnbytes\WPLogViewer\Api', 'clear_log']);

// Login user
$router->get('login', ['\Allbitsnbytes\WPLogViewer\Api', 'login_user'], false);

// Logout user
$router->get('logout', ['\Allbitsnbytes\WPLogViewer\Api', 'logout_user']);

// Run Router
$router->run();

