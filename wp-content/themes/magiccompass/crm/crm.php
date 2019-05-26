<?php
/**
 * CRM Main File.
 *
 * @package WordPress
 * @subpackage Magiccompass/CRM
 * @version 0.0.1
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define('CRM_VERSION', '0.0.1');
define('CRM_ABSPATH', dirname(__FILE__));

define('CRM_USER_NAME', __('User', 'snthwp'));
define('CRM_USERS_NAME', __('Users', 'snthwp'));

define('CRM_URL', get_template_directory_uri() . '/crm');
define('CRM_ASSETS_URL', CRM_URL . '/assets');
define('CRM_ASSETS_CSS', CRM_ASSETS_URL . '/css');
define('CRM_ASSETS_JS', CRM_ASSETS_URL . '/js');

spl_autoload_register('crm_autoload');

/**
 * Framework class autoloader
 *
 * @param $class
 */
function crm_autoload($class_name)
{
    if (class_exists($class_name)) {
        return;
    }

    $class_path = CRM_ABSPATH . '/includes' . DIRECTORY_SEPARATOR . 'class'  . DIRECTORY_SEPARATOR . strtolower(str_replace( '_', '-', $class_name )) . '.php';

    if ( file_exists( $class_path ) ) {
        include $class_path;
    }
}

include_once(CRM_ABSPATH . '/includes/template-functions.php');
include_once(CRM_ABSPATH . '/includes/admin.php');
include_once(CRM_ABSPATH . '/includes/ajax.php');

$path = CRM_ABSPATH;
$true_path = '';