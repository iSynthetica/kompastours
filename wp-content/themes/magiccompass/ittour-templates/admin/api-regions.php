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

$cyr = [
    'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
    'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
    'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
    'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
];
$lat = [
    'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
    'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
    'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
    'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
];
?>
<h3>Регионы (<?php echo count($params['regions']) ?>)</h3>

<table class="mc-table">
    <thead>
    <tr>
        <th></th>
        <th>ID</th>
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
                $destination_name_en = $textlat = str_replace($cyr, $lat, $destination_en['name']);
                $destination_slug = sanitize_title( $destination_name_en );

                unset($regions_en[$key]);
            }
        }

        if (0 < $destination_id * 1) {
            ?>
            <tr>
                <td>
                    <input
                            type="checkbox"
                            id="region_<?php echo $destination_id ?>"
                            name="region_<?php echo $destination_id ?>"
                            value="<?php echo $destination_id ?>"
                    >
                </td>
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

