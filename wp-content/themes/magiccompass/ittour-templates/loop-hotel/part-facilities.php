<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 18:13
 */

if (!$facilities) {
    return;
}

$facilities_by_cat = array();
foreach ($facilities as $facility) {
    $price = $facility['is_paid'] === 0 ? '' : ' - Paid';
    // $facilities_by_cat[$facility['category_id']][] = $facility['name'] . $price;
    $facilities_by_cat[$facility['category']][] = $facility['name'] . $price;
}
?>

<h4><?php echo __('Hotel Facilities', 'snthwp'); ?></h4>

<div class="tour_hotel-facilities">

</div>
<?php // var_dump($facilities_by_cat) ?>
<?php // var_dump($facilities) ?>