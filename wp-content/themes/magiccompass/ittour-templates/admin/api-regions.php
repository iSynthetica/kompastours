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
$regions_site_by_ittour_id = ittour_get_destination_by_ittour_id('region');

$params_obj = ittour_params('ru');
$params = $params_obj->get();
$countries = $params['countries'];
$countries_by_id = array();

foreach ($countries as $key => $country) {
    $countries_by_id[$country['id']] = array(
        'name' => $country['name'],
    );

    if (!empty($countries_site_by_ittour_id[$country['id']]['ID'])) {
        $countries_by_id[$country['id']]['parent_id'] = $countries_site_by_ittour_id[$country['id']]['ID'];
    }

    unset($countries[$key]);
}

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
        <th>Modified</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($params['regions'] as $destination) {
        $destination_id = $destination['id'];
        $destination_name = $destination['name'];
        $destination_type = $destination['type_id'];
        $destination_country_id = $destination['country_id'];
        $destination_country = '';
        $parent_post_ID = '';

        if (!empty($countries_by_id[$destination_country_id])) {
            $destination_country = $countries_by_id[$destination_country_id]['name'];
        }

        if (!empty($countries_by_id[$destination_country_id])) {
            $parent_post_ID = $countries_by_id[$destination_country_id]['parent_id'];
        }

        $destination_site_id = '';
        $destination_site_modified = '';

        if (!empty($regions_site_by_ittour_id[$destination_id])) {
            $destination_site_id = $regions_site_by_ittour_id[$destination_id]['ID'];
            $destination_site_modified = $regions_site_by_ittour_id[$destination_id]['modified'];

            unset ($regions_site_by_ittour_id[$destination_id]);
        }

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
                    <?php
                    if (!empty($parent_post_ID) && empty($destination_site_modified)) {
                        ?>
                        <input
                                type="checkbox"
                                id="region_add_<?php echo $destination_id ?>"
                                name="region_add_<?php echo $destination_id ?>"
                                value="<?php echo $destination_id ?>"
                        >
                        <?php
                    }
                    ?>
                </th>
                <th>
                    <?php
                    if (!empty($parent_post_ID) && !empty($destination_site_modified)) {
                        ?>
                        <input
                                type="checkbox"
                                id="region_update_<?php echo $destination_id ?>"
                                name="region_update_<?php echo $destination_id ?>"
                                value="<?php echo $destination_id ?>"
                        >
                        <?php
                    }
                    ?>
                </th>
                <th>
                    <?php echo $destination_id; ?>
                    <?php
                    if (!empty($destination_site_id)) {
                        ?>/ <?php echo $destination_site_id; ?><?php
                    }
                    ?>
                </th>
                <td><?php echo $destination_name; ?></td>
                <td><?php echo $destination_slug; ?></td>
                <td><?php echo $destination_type; ?></td>
                <td><?php echo $destination_country; ?> (<?php echo $destination_country_id; ?>)</td>
                <td><?php echo $destination_parent; ?></td>
                <td><?php echo $destination_site_modified; ?></td>
                <td>
                    <?php
                    if (!empty($parent_post_ID)) {
                        if (!empty($destination_site_modified)) {
                            ?>
                            <button
                                    class="button-primary button-small ittour-update-region"
                                    data-parent-id="<?php echo $parent_post_ID ?>"
                                    data-ittour-id="<?php echo $destination_id ?>"
                                    data-ittour-name="<?php echo $destination_name ?>"
                                    data-ittour-country-id="<?php echo $destination_country_id ?>"
                                    data-ittour-slug="<?php echo $destination_slug ?>"
                                    data-ittour-type="<?php echo $destination_type ?>"
                            >
                                <?php echo __('Update', 'snthwp'); ?>
                            </button>
                            <?php
                        } else {
                            ?>
                            <button
                                    class="button-primary button-small ittour-add-region"
                                    data-parent-id="<?php echo $parent_post_ID ?>"
                                    data-ittour-id="<?php echo $destination_id ?>"
                                    data-ittour-name="<?php echo $destination_name ?>"
                                    data-ittour-country-id="<?php echo $destination_country_id ?>"
                                    data-ittour-slug="<?php echo $destination_slug ?>"
                                    data-ittour-type="<?php echo $destination_type ?>"
                            >
                                <?php echo __('Add', 'snthwp'); ?>
                            </button>
                            <?php
                        }
                        ?>
                        <?php
                    } else {
                        ?>Please, add country first<?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>

<h3>Регионы</h3>

