<?php
/**
 * Hotel Calendar Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/General
 * @version 0.0.9
 * @since 0.0.9
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$country = !empty($country) ? $country : false;
$from_city = !empty($from_city) ? $from_city : false;

if (!$country) {
    ?>
    <div id="tours-table-empty__container">
        <h2><?php echo __('No tours found', 'snthwp') ?></h2>
    </div>
    <?php

    return;
}

$tours_table_data = '';
$tours_table_data .= ' data-country="'.$country.'"';

if (!empty($from_city)) $tours_table_data .= ' data-from-city="'.$from_city.'"';
if (!empty($region)) $tours_table_data .= ' data-region="'.$region.'"';
if (!empty($hotel)) $tours_table_data .= ' data-hotel="'.$hotel.'"';
if (!empty($hotel_rating)) $tours_table_data .= ' data-hotel-rating="'.$hotel_rating.'"';
if (!empty($type)) $tours_table_data .= ' data-tour-type="'.$type.'"';
if (!empty($kind)) $tours_table_data .= ' data-tour-kind="'.$kind.'"';
if (!empty($date_from)) $tours_table_data .= ' data-date-from="'.$date_from.'"';
if (!empty($date_till)) $tours_table_data .= ' data-date-till="'.$date_till.'"';
?>

<div id="tours-table-ajax__container"<?php echo $tours_table_data; ?>>
    <div class="progress-bar__container" style="padding:10px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="progress" style="height: 40px;">
                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        <span style="font-size:19px;font-weight:700;"><?php echo __('Loading more tours...', 'snthwp'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
