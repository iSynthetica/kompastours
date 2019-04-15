<?php
/**
 * Display API Params Page
 *
 * @package Magiccompass/IttourTemplates/Admin
 * @version 0.0.7
 * @since 0.0.7
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$params_obj = ittour_params('ru');
$params = $params_obj->get();

$params_obj_en = ittour_params('en');
$params_en = $params_obj_en->get();
$regions_en = $params_en['regions'];
?>
<h3>Select country</h3>
<?php

foreach ($params['countries'] as $country) {
    ?>
    <a href="/wp-admin/admin.php?page=ittour-hotels&country=<?php echo $country['id']; ?>" class="button-primary button-primary" style="margin-bottom: 5px;"><?php echo $country['name'] ?></a>
    <?php
}

if (empty($_GET['country'])) {
    ?>
    <p>
        Select country first
    </p>
    <?php
    return;
}

$destination_country_id = $_GET['country'];
$hotels = $params_obj->getCountry($destination_country_id, array('entity' => 'hotel'))['hotels'];

$countries_by_id = array();

foreach ($params['countries'] as $key => $country) {
    $countries_by_id[$country['id']] = array(
        'name' => $country['name'],
    );
}

$destination_country = '';

if (!empty($countries_by_id[$destination_country_id])) {
    $destination_country = $countries_by_id[$destination_country_id]['name'];
}

$regions_by_id = array();

foreach ($params['regions'] as $key => $region) {
    $regions_by_id[$region['id']] = array(
        'name' => $region['name'],
    );
}
?>
<h3>Отели (<?php echo count($hotels) ?>)</h3>

<table class="mc-table">
    <thead>
    <tr>
        <th>
            Add all <br>
            <input type="checkbox" id="country_add_all">
        </th>
        <th>
            Update all <br>
            <input type="checkbox" id="country_update_all">
        </th>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Location</th>
        <th>Type</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($hotels as $destination) {
        $destination_id = $destination['id'];
        $destination_rating = $destination['hotel_rating_id'];
        $destination_name = $destination['name'] . ' ' . ittour_get_hotel_number_rating_by_id($destination_rating);
        $destination_type = $destination['type_id'];
        $destination_name_en = '';
        $destination_slug = snth_get_slug_lat($destination_name);
        $destination_region_id_array = array_map('trim',explode(',', $destination['region_id']));
        $destination_region_id = end($destination_region_id_array);
        $destination_region = '';

        if (!empty($regions_by_id[$destination_region_id])) {
            $destination_region = $regions_by_id[$destination_region_id]['name'];
        }

        if (0 < $destination_id * 1) {
            ?>
            <tr>
                <th>
                    <input
                        type="checkbox"
                        id="hotel_add_<?php echo $destination_id ?>"
                        name="hotel_add_<?php echo $destination_id ?>"
                        value="<?php echo $destination_id ?>"
                    >
                </th>
                <th>
                    <input
                        type="checkbox"
                        id="hotel_update_<?php echo $destination_id ?>"
                        name="hotel_update_<?php echo $destination_id ?>"
                        value="<?php echo $destination_id ?>"
                    >
                </th>
                <th><?php echo $destination_id; ?></th>
                <td><?php echo $destination_name; ?></td>
                <td><?php echo $destination_slug; ?></td>
                <td><?php echo $destination_country; ?> (<?php echo $destination_country_id; ?>), <?php echo $destination_region; ?> (<?php echo $destination_region_id; ?>)</td>
                <td><?php echo $destination_type; ?></td>
                <td>
                    <button
                        class="button-primary button-small"
                        data-ittour-id="<?php echo $destination_id ?>"
                        data-ittour-name="<?php echo $destination_name ?>"
                        data-ittour-country="<?php echo $destination_country_id ?>"
                        data-ittour-region="<?php echo $destination_region_id ?>"
                        data-ittour-slug="<?php echo $destination_slug ?>"
                        data-ittour-type="<?php echo $destination_type ?>"
                    >
                        <?php echo __('Add', 'snthwp'); ?>
                    </button>
                </td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>

<h3>Регионы</h3>

