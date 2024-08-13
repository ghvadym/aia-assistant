<?php

/**
 * Plugin Name: AI Assistant
 * Description: Use AI assistant to create content on the website
 * Version: 1.0
 * Author: Spalah
 * Author Uri: https://spalah.tech/
 * Text Domain: spalah
 *
 * @package WordPress
 */

if (!defined('ABSPATH')) {
    exit;
}

const AIA_DOMAIN = 'aia';
const AIA_SETTING_PAGE = AIA_DOMAIN.'-assistant';
const AIA_SETTINGS_FIELDS = AIA_DOMAIN.'_general_settings';

define('AIA_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('AIA_PLUGIN_URL', plugin_dir_url(__FILE__));
define('AIA_PLUGIN_SLUG', plugin_basename(__FILE__));

require_once('autoloader.php');