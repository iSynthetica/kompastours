<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/General
 * @version 0.1.0
 * @since 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @var array $tour_info
 */

if (!empty($tour_info["tour_id"])) {
    ?><input type="hidden" name="tour_id" value="<?php echo $tour_info["tour_id"] ?>"><?php
}

if (!empty($tour_info["name"])) {
    ?><input type="hidden" name="tour_name" value="<?php echo $tour_info["name"] ?>"><?php
}

if (!empty($tour_info["from_city"])) {
    ?><input type="hidden" name="from_city_name" value="<?php echo $tour_info["from_city"] ?>"><?php
}

if (!empty($tour_info["country_id"])) {
    ?><input type="hidden" name="country" value="<?php echo $tour_info["country_id"] ?>"><?php
}

if (!empty($tour_info["country"])) {
    ?><input type="hidden" name="country_name" value="<?php echo $tour_info["country"] ?>"><?php
}

if (!empty($tour_info["region_id"])) {
    ?><input type="hidden" name="region" value="<?php echo $tour_info["region_id"] ?>"><?php
}

if (!empty($tour_info["region"])) {
    ?><input type="hidden" name="region_name" value="<?php echo $tour_info["region"] ?>"><?php
}

if (!empty($tour_info["from_city_id"])) {
    ?><input type="hidden" name="from_city" value="<?php echo $tour_info["from_city_id"] ?>"><?php
}

if (!empty($tour_info["meal_type"])) {
    ?><input type="hidden" name="meal_type_short" value="<?php echo $tour_info["meal_type"] ?>"><?php
}

if (!empty($tour_info["meal_type_full"])) {
    ?><input type="hidden" name="meal_type_name" value="<?php echo $tour_info["meal_type_full"] ?>"><?php
}

if (!empty($tour_info["adult_amount"])) {
    ?><input type="hidden" name="adult_amount" value="<?php echo $tour_info["adult_amount"] ?>"><?php
}

if (!empty($tour_info["duration"])) {
    ?><input type="hidden" name="night_from" value="<?php echo $tour_info["duration"] ?>"><?php
}

if (!empty($tour_info["transport_type"])) {
    ?><input type="hidden" name="transport_type" value="<?php echo $tour_info["transport_type"] ?>"><?php
}

if (!empty($tour_info["date_from"])) {
    ?><input type="hidden" name="date_from" value="<?php echo $tour_info["date_from"] ?>"><?php
}

if (!empty($tour_info["prices"]['2'])) {
    ?><input id="price_uah" type="hidden" name="price_uah" value="<?php echo $tour_info["prices"]['2'] ?>"><?php
}

if (!empty($tour_info["prices"]['1'])) {
    ?><input id="price_usd" type="hidden" name="price_usd" value="<?php echo $tour_info["prices"]['1'] ?>"><?php
}

if (!empty($tour_info["prices"]['10'])) {
    ?><input id="price_euro" type="hidden" name="price_euro" value="<?php echo $tour_info["prices"]['10'] ?>"><?php
}
?>