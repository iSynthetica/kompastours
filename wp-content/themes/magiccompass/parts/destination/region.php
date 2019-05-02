<?php
/**
 * Country Content Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.9
 * @since 0.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$template_args = array(
    'type' => 1,
    'country' => $country_id,
    'region' => $region_id,
    'items_per_page' => 12,
);

ittour_show_template('general/tours-list-ajax.php', $template_args);
?>
