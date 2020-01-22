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
if (!empty($hotel_rating)) $args["hotel_rating"] = $hotel_rating;
if (!empty($from_city)) $args["from_city"] = $from_city;
if (!empty($date_from)) $args["date_from"] = $date_from;
if (!empty($date_till)) $args["date_till"] = $date_till;
if (!empty($night_from)) $args["night_from"] = $night_from;
if (!empty($night_till)) $args["night_till"] = $night_till;
if (!empty($adult_amount)) $args["adult_amount"] = $adult_amount;
if (!empty($child_amount)) $args["child_amount"] = $child_amount;
if (!empty($child_age)) $args["child_age"] = $child_age;
if (!empty($tour_type)) $args["tour_type"] = $tour_type;
if (!empty($tour_kind)) $args["tour_kind"] = $tour_kind;
if (!empty($meal_type)) $args["meal_type"] = $meal_type;
if (!empty($price_limit)) $args["price_limit"] = $price_limit;

if (!empty($country_excursion)) $args["country_excursion"] = $country_excursion;
if (!empty($from_city_excursion)) $args["from_city_excursion"] = $from_city_excursion;
if (!empty($city)) $args["city"] = $city;
if (!empty($date_excursion_from)) $args["date_excursion_from"] = $date_excursion_from;
if (!empty($date_excursion_till)) $args["date_excursion_till"] = $date_excursion_till;
if (!empty($date_excursion_till)) $args["date_excursion_till"] = $date_excursion_till;
if (!empty($night_moves)) $args["night_moves"] = $night_moves;
?>


<div class="search-form_static">
    <?php ittour_show_template('form/search-tab.php'); ?>
</div>
