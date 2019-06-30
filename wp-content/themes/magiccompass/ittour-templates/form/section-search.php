<?php
/**
 * Template part for displaying empty search section for loading via ajax
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/Form
 * @version 0.0.8
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$args = array();

if (!empty($country)) $args["country"] = $country;
if (!empty($region))  $args["region"] = $region;
if (!empty($hotel))  $args["hotel"] = $hotel;
if (!empty($hotel_rating)) $args["hotelRating"] = $hotel_rating;
if (!empty($from_city)) $args["fromCity"] = $from_city;
if (!empty($date_from)) $args["dateFrom"] = $date_from;
if (!empty($date_till)) $args["dateTill"] = $date_till;
if (!empty($night_from)) $args["nightFrom"] = $night_from;
if (!empty($night_till)) $args["nightTill"] = $night_till;
if (!empty($adult_amount)) $args["adultAmount"] = $adult_amount;
if (!empty($child_amount)) $args["childAmount"] = $child_amount;
if (!empty($child_age)) $args["childAge"] = $child_age;
if (!empty($tour_type)) $args["tourType"] = $tour_type;
if (!empty($tour_kind)) $args["tourKind"] = $tour_kind;
if (!empty($meal_type)) $args["mealType"] = $meal_type;
if (!empty($price_limit)) $args["priceLimit"] = $price_limit;
?>


<div class="search-form_static">
    <?php ittour_show_template('form/search-tab.php', array('args' => $args)); ?>
</div>
