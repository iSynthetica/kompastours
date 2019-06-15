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

$form_data = '';

if (!empty($country)) $form_data        .= ' data-country="'.$country.'"';
if (!empty($region)) $form_data         .= ' data-region="'.$region.'"';
if (!empty($hotel)) $form_data          .= ' data-hotel="'.$hotel.'"';
if (!empty($hotel_rating)) $form_data   .= ' data-hotel-rating="'.$hotel_rating.'"';
if (!empty($from_city)) $form_data      .= ' data-from-city="'.$from_city.'"';
if (!empty($date_from)) $form_data      .= ' data-date-from="'.$date_from.'"';
if (!empty($date_till)) $form_data      .= ' data-date-till="'.$date_till.'"';
if (!empty($night_from)) $form_data     .= ' data-night-from="'.$night_from.'"';
if (!empty($night_till)) $form_data     .= ' data-night-till="'.$night_till.'"';
if (!empty($adult_amount)) $form_data   .= ' data-adult-amount="'.$adult_amount.'"';
if (!empty($child_amount)) $form_data   .= ' data-child-amount="'.$child_amount.'"';
if (!empty($child_age)) $form_data      .= ' data-child-age="'.$child_age.'"';
if (!empty($price_limit)) $form_data    .= ' data-price-limit="'.$price_limit.'"';
if (!empty($tour_type)) $form_data      .= ' data-tour-type="'.$tour_type.'"';
if (!empty($tour_kind)) $form_data      .= ' data-tour-kind="'.$tour_kind.'"';
if (!empty($meal_type)) $form_data      .= ' data-meal-type="'.$meal_type.'"';
?>


<div class="search-form_ajax"<?php echo $form_data; ?>>
    <?php // ittour_show_template('form/search-tab.php'); ?>
</div>
