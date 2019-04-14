<?php
/**
 * Display API Params Page
 *
 * @package Magiccompass/IttourTemplates/Admin
 * @version 0.0.7
 * @since 0.0.7
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$countries_site_by_ittour_id = ittour_get_destination_by_ittour_id('country');

$params_obj = ittour_params('ru');
$params = $params_obj->get();

$params_obj_en = ittour_params('en');
$params_en = $params_obj_en->get();
$regions_en = $params_en['regions'];
?>
<h3>Регионы (<?php echo count($params['regions']) ?>)</h3>

<table class="mc-table">
    <thead>
    <tr>
        <th>
            Add all <br>
            <input type="checkbox" id="region_add_all">
        </th>
        <th>
            Update all <br>
            <input type="checkbox" id="region_update_all">
        </th>
        <th>itTour ID / Post ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Type</th>
        <th>Country</th>
        <th>Parent</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($params['regions'] as $destination) {
        $destination_id = $destination['id'];
        $destination_name = $destination['name'];
        $destination_type = $destination['type_id'];
        $destination_country = $destination['country_id'];
        $destination_parent = $destination['parent_id'] * 1 > 0 ? $destination['parent_id'] : '-';
        $destination_name_en = '';
        $destination_slug = '';

        foreach ($regions_en as $key => $destination_en) {
            if ($destination_en['id'] === $destination_id) {
                $destination_slug = snth_get_slug_lat($destination_en['name']);

                unset($regions_en[$key]);
            }
        }

        if (0 < $destination_id * 1) {
            ?>
            <tr>
                <th>
                    <input
                            type="checkbox"
                            id="region_add_<?php echo $destination_id ?>"
                            name="region_add_<?php echo $destination_id ?>"
                            value="<?php echo $destination_id ?>"
                    >
                </th>
                <th>
                    <input
                            type="checkbox"
                            id="region_update_<?php echo $destination_id ?>"
                            name="region_update_<?php echo $destination_id ?>"
                            value="<?php echo $destination_id ?>"
                    >
                </th>
                <th><?php echo $destination_id; ?></th>
                <td><?php echo $destination_name; ?></td>
                <td><?php echo $destination_slug; ?></td>
                <td><?php echo $destination_type; ?></td>
                <td><?php echo $destination_country; ?></td>
                <td><?php echo $destination_parent; ?></td>
                <td>
                    <button class="button-primary button-small">
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

