<?php
/**
 * Country Content Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.8
 * @since 0.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php
$template_args = array(
    'country' => $country_id,
    'region' => $region_id,
    'hotel' => $hotel_id,
    'hotel_rating' => $hotel_rating,
);

ittour_show_template('general/tours-table-ajax.php', $template_args);
?>