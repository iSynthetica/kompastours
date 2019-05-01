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
if (!$from_city) $tours_table_data .= ' data-from-city="'.$from_city.'"';
if (!empty($region)) $tours_table_data .= ' data-region="'.$region.'"';
?>

<div id="tours-table-ajax__container"<?php echo $tours_table_data; ?>>

</div>
