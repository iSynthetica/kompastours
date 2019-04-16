<?php
/**
 * Hotel Calendar Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.8
 * @since 0.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$month_period = 12;

$month = date("n");
$year = date("Y");

$month_select_current = $month;
$year_select_current = $year;
$month_select = array();
$month_select[] = '<option value="'.$month.'.'.$year.'">'.date("F Y").'</option>';

for ($i = 0; $i < $month_period; $i++) {
    if ($month_select_current == 12) {
        $year_select_current++;
        $month_select_current = 1;
    } else {
        $month_select_current++;
    }

    $month_select[] = '<option value="'.$month_select_current.'.'.$year_select_current.'">'.date("F Y", mktime(12, 0, 0, $month_select_current, 1, $year_select_current)).'</option>';

}

$params_obj = ittour_params();
$params = $params_obj->getCountry($country_id);
?>
<h3><?php echo date("F Y"); ?></h3>

<div id="tools">
    <div class="row">
        <div class="col-md-2 col-sm-3 col-4">
            <div class="styled-select-filters">
                <select name="from_city" id="from_city">
                    <?php
                    foreach ($params['from_cities'] as $from_city) {
                        ?>
                        <option value="<?php echo $from_city['id'] ?>"<?php echo '2014' === $from_city['id'] ? ' selected' : ''; ?>><?php echo $from_city['name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-2 col-sm-3 col-4">
            <div class="styled-select-filters">
                <select name="month" id="month">
                    <?php
                    foreach ($month_select as $month_option) {
                        echo $month_option;
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-2 col-sm-3 col-4">
            <div class="styled-select-filters">
                <select name="adults_amount" id="adults_amount">
                    <option value="1"><?php echo __('1 adult', 'snthwp'); ?></option>
                    <option value="2" selected><?php echo __('2 adults', 'snthwp'); ?></option>
                    <option value="3"><?php echo __('3 adults', 'snthwp'); ?></option>
                    <option value="4"><?php echo __('4 adults', 'snthwp'); ?></option>
                </select>
            </div>
        </div>
    </div>
</div>

<section
    id="hotel-tour-calendar__section"
    data-month="<?php echo 7; ?>"
    data-year="<?php echo $year; ?>"
    data-country="<?php echo $country_id; ?>"
    data-hotel-id="<?php echo $hotel_id; ?>"
    data-hotel-rating="<?php echo $hotel_rating; ?>"
></section>