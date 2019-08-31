<?php
/**
 * CRM Templates Functions.
 *
 * @package WordPress
 * @subpackage Magiccompass/CRM/Includes
 * @version 0.0.1
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Show templates passing attributes and including the file.
 *
 * @param string $template_name
 * @param array $args
 * @param string $template_path
 */
function crm_show_template($template_name, $args = array(), $template_path = 'crm/parts')
{
    if (!empty($args) && is_array($args)) {
        extract($args);
    }

    $located = crm_locate_template($template_name, $template_path);

    if (!file_exists($located)) {
        return;
    }

    include($located);
}

/**
 * Like show, but returns the HTML instead of outputting.
 *
 * @param $template_name
 * @param array $args
 * @param string $template_path
 * @param string $default_path
 *
 * @return string
 */
function crm_get_template($template_name, $args = array(), $template_path = 'crm/parts')
{
    ob_start();
    crm_show_template($template_name, $args, $template_path);
    return ob_get_clean();
}

/**
 * Locate a template and return the path for inclusion.
 *
 * @param $template_name
 * @param string $template_path
 * @return string
 */
function crm_locate_template($template_name, $template_path = 'crm/parts')
{
    if (!$template_path) {
        $template_path = 'crm/parts';
    }

    $template = locate_template(
        array(
            trailingslashit($template_path) . $template_name,
            $template_name
        )
    );

    return $template;
}