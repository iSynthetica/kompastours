<?php
/**
 * Display API Params Page
 *
 * @package Magiccompass/IttourTemplates/Admin
 * @version 0.0.7
 * @since 0.0.7
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$args = array(
    'numberposts' => '-1',
    'post_type'   => 'destination',
    'tax_query' => array(
        array(
            'taxonomy' => 'destination_type',
            'field'    => 'slug',
            'terms'    => 'country'
        )
    )
);
$countries_site = get_posts($args);
$countries_site_by_ittour_id = array();

foreach ($countries_site as $country_site) {
    $ittour_id = get_field('ittour_id', $country_site->ID);

    if (!empty($ittour_id)) {
        $countries_site_by_ittour_id[$ittour_id] = array(
            'name'  => $country_site->post_title,
            'modified' => $country_site->post_modified
        );
    }
}

wp_reset_postdata();

$params_obj = ittour_params('ru');
$params = $params_obj->get();

$params_obj_en = ittour_params('en');
$params_en = $params_obj_en->get();
$countries_en = $params_en['countries'];
?>

<h3>Страны (<?php echo count($params['countries']) ?>)</h3>

<table class="mc-table">
    <thead>
    <tr>
        <th></th>
        <th>itTour ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>ISO</th>
        <th>Type</th>
        <th>Transport</th>
        <th>Group</th>
        <th>Modified</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($params['countries'] as $country) {
        $country_id = $country['id'];
        $country_name = $country['name'];
        $country_name_en = '';
        $country_slug = '';
        foreach ($countries_en as $key => $country_en) {
            if ($country_en['id'] === $country_id) {
                $country_name_en = $country_en['name'];
                $country_name_en_array = explode(',', $country_name_en);
                $countries_en_count = count($country_name_en_array) - 1;
                $country_slug = sanitize_title( $country_name_en_array[$countries_en_count] );

                unset($countries_en[$key]);
            }
        }

        $country_site_modified = '';

        if (!empty($countries_site_by_ittour_id[$country_id])) {
            $country_site_modified = $countries_site_by_ittour_id[$country_id]['modified'];

            unset ($countries_site_by_ittour_id[$country_id]);
        }
        ?>
        <tr>
            <td>
                <input
                    type="checkbox"
                    id="country_<?php echo $country_id ?>"
                    name="country_<?php echo $country_id ?>"
                    value="<?php echo $country_id ?>"
                >
            </td>
            <th><?php echo $country_id ?></th>
            <td><?php echo $country_name ?> (<?php echo $country_name_en ?>)</td>
            <td><?php echo $country_slug; ?></td>
            <td><?php echo strtoupper($country['iso']) ?></td>
            <td><?php echo $country['type_id'] ?></td>
            <td><?php echo $country['transport_type_id'] ?></td>
            <td>
                <?php
                $display = '';

                foreach ($params['country_groups'] as $key => $country_group) {
                    if ($country_group['id'] === $country['group_id']) {
                        $display .= $params['country_groups'][$key]['name'];
                    }
                }

                $display .= ' (id <strong>' . $country['group_id'] . '</strong>)';

                echo $display;
                ?>
            </td>
            <td><?php echo $country_site_modified; ?></td>
            <td>
                <?php
                if ($country_site_modified) {
                    ?>
                    <button
                            class="button-primary button-small ittour-update-country"
                            data-ittour-id="<?php echo $country_id ?>"
                            data-ittour-name="<?php echo $country_name ?>"
                            data-ittour-slug="<?php echo $country_slug ?>"
                            data-ittour-iso="<?php echo $country['iso'] ?>"
                            data-ittour-group="<?php echo $country['group_id'] ?>"
                            data-ittour-type="<?php echo $country['type_id'] ?>"
                            data-ittour-transport="<?php echo $country['transport_type_id'] ?>"
                    >
                        <?php echo __('Update', 'snthwp'); ?>
                    </button>
                    <?php
                } else {
                    ?>
                    <button
                            class="button-primary button-small ittour-add-country"
                            data-ittour-id="<?php echo $country_id ?>"
                            data-ittour-name="<?php echo $country_name ?>"
                            data-ittour-slug="<?php echo $country_slug ?>"
                            data-ittour-iso="<?php echo $country['iso'] ?>"
                            data-ittour-group="<?php echo $country['group_id'] ?>"
                            data-ittour-type="<?php echo $country['type_id'] ?>"
                            data-ittour-transport="<?php echo $country['transport_type_id'] ?>"
                    >
                        <?php echo __('Add', 'snthwp'); ?>
                    </button>
                    <?php
                }
                ?>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<h3>Регионы</h3>

<h3>Отели</h3>

