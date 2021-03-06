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

?>
    <input type="hidden" name="requestTypeName" value="<?php echo __('Excursion Tour Request', 'snthwp'); ?>">
    <input type="hidden" name="requestType" value="excursion_tour">
<?php

if (!empty($tour_info["tour_id"])) {
    ?>
    <input type="hidden" name="tour_id" value="<?php echo $tour_info["tour_id"] ?>">
    <input type="hidden" name="tour_url" value="<?php echo get_site_url(); ?>/excursion-tour/<?php echo $tour_info["tour_id"] ?>">
    <?php
}

if (!empty($tour_info["name"])) {
    ?><input type="hidden" name="tour_name" value="<?php echo $tour_info["name"] ?>"><?php
}

if (!empty($tour_info["from_city"])) {
    ?><input type="hidden" name="from_city_name" value="<?php echo $tour_info["from_city"] ?>"><?php
}

if (!empty($tour_info["country_name_list"])) {
        ?><input type="hidden" name="country_name_list" value="<?php echo $tour_info["country_name_list"] ?>"><?php
}

if (!empty($tour_info["country_id_list"])) {
        ?><input type="hidden" name="country_id_list" value="<?php echo $tour_info["country_id_list"] ?>"><?php
}

if (!empty($tour_info["city_name_list"])) {
        ?><input type="hidden" name="city_name_list" value="<?php echo $tour_info["city_name_list"] ?>"><?php
}

if (!empty($tour_info["city_id_list"])) {
        ?><input type="hidden" name="city_id_list" value="<?php echo $tour_info["city_id_list"] ?>"><?php
}

?>

<?php

if (!empty($tour_info["meal_type"]) || $tour_info["meal_type_full"]) {
    $meal_type = '';
    if (!empty($tour_info["meal_type"])) $meal_type .= $tour_info["meal_type"];
    if (!empty($tour_info["meal_type_full"])) $meal_type .= ' ' . $tour_info["meal_type_full"];

    ?><input type="hidden" name="meal_type" value="<?php echo trim($meal_type) ?>"><?php
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
?>