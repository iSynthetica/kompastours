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
ittour_show_template('single-tour/hotel-calendar.php', array(
    'country_id' => $country_id,
    'region_id' => $region_id,
    'hotel_id' => $hotel_id,
    'hotel_rating' => $hotel_rating,
)); ?>