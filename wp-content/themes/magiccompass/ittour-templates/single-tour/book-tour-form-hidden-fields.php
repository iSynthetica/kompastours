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

if (!empty($tour_info["key"])) {
    ?><input type="hidden" name="key" value="<?php echo $tour_info["key"] ?>"><?php
}

if (!empty($tour_info["id"])) {
    ?><input type="hidden" name="id" value="<?php echo $tour_info["id"] ?>"><?php
}

if (!empty($tour_info["tour_id"])) {
    ?><input type="hidden" name="tour_id" value="<?php echo $tour_info["tour_id"] ?>"><?php
}

if (!empty($tour_info["spo"])) {
    ?><input type="hidden" name="spo" value="<?php echo $tour_info["spo"] ?>"><?php
}

if (!empty($tour_info["type"])) {
    ?><input type="hidden" name="type" value="<?php echo $tour_info["type"] ?>"><?php
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

if (!empty($tour_info["hotel_id"])) {
    ?><input type="hidden" name="hotel" value="<?php echo $tour_info["hotel_id"] ?>"><?php
}

if (!empty($tour_info["hotel"])) {
    ?><input type="hidden" name="hotel_name" value="<?php echo $tour_info["hotel"] ?>"><?php
}

if (!empty($tour_info["hotel_rating"])) {
    ?><input type="hidden" name="hotel_rating" value="<?php echo $tour_info["hotel_rating"] ?>"><?php
}

if (!empty($tour_info["from_city_id"])) {
    ?><input type="hidden" name="from_city" value="<?php echo $tour_info["from_city_id"] ?>"><?php
}

if (!empty($tour_info["from_city"])) {
    ?><input type="hidden" name="from_city_name" value="<?php echo $tour_info["from_city"] ?>"><?php
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

if (!empty($tour_info["child_amount"])) {
    ?><input type="hidden" name="child_amount" value="<?php echo $tour_info["child_amount"] ?>"><?php


    if (!empty($tour_info["child_age"])) {
        ?><input type="hidden" name="child_age" value="<?php echo $tour_info["child_age"] ?>"><?php
    }
}

if (!empty($tour_info["duration"])) {
    ?><input type="hidden" name="night_from" value="<?php echo $tour_info["duration"] ?>"><?php
}

if (!empty($tour_info["transport_type"])) {
    if ('flight' === $tour_info["transport_type"]) {
        ?><input type="hidden" name="kind" value="1"><?php
    } elseif ('bus' === $tour_info["transport_type"]) {
        ?><input type="hidden" name="kind" value="2"><?php
    }

}

if (!empty($tour_info["date_from"])) {
    ?><input type="hidden" name="date_from" value="<?php echo $tour_info["date_from"] ?>"><?php
}

if (!empty($tour_info["room_type"])) {
    ?><input type="hidden" name="room_type" value="<?php echo $tour_info["room_type"] ?>"><?php
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

if (!empty($tour_info["flights"]["from"]) || !empty($tour_info["flights"]["to"])) {
    $tour_info_flights_structured_data = ittour_get_flights_structured_data($tour_info["flights"]);

    if (!empty($tour_info_flights_structured_data['from'][0])) {
        ?>
        <input id="flightThere_val" type="hidden" name="flight_from" value="<?php echo $tour_info_flights_structured_data['from'][0]['txt_val'] ?>">
        <input id="flightThere_val" type="hidden" name="flight_from_json" value='<?php echo $tour_info_flights_structured_data['from'][0]['json_val'] ?>'>
        <input id="flightThere_structured" type="hidden" name="flight_from_structured" value="<?php echo $tour_info_flights_structured_data['from'][0]['structured_val'] ?>">
        <?php
    }

    if (!empty($tour_info_flights_structured_data['to'][0])) {
        ?>
        <input id="flightBack_val" type="hidden" name="flight_to" value="<?php echo $tour_info_flights_structured_data['to'][0]['txt_val'] ?>">
        <input id="flightBack_val" type="hidden" name="flight_to_json" value='<?php echo $tour_info_flights_structured_data['to'][0]['json_val'] ?>'>
        <input id="flightBack_structured" type="hidden" name="flight_to_structured" value="<?php echo $tour_info_flights_structured_data['to'][0]['structured_val'] ?>">
        <?php
    }
}
?>