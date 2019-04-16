<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 16:36
 */

$map = array(
    'lat' => $hotel_info['lat'],
    'lng' => $hotel_info['lng']
);



ob_start();
?>
<div class="location-info">
    <div class="location-info__inner">
        <div class="location-info__header">
            <h3><?php echo $hotel_title ?></h3>
        </div>

        <div class="location-info__body">
            <p>
                <strong><?php echo __('Address', 'snthwp') ?>:</strong>
            </p>

            <p>
            </p>

            <p>
                <strong><?php echo __('Phone', 'snthwp') ?>:</strong>
            </p>

            <p>
                <strong><?php echo __('Schedule', 'snthwp') ?>:</strong>
            </p>
        </div>

        <div class="location-info__footer">

        </div>
    </div>
</div>
<?php
$info = ob_get_clean();

$map_markers = array();
$map_markers[] = array(
    'marker' => array(
        'lat' => $hotel_info['lat'],
        'lng' => $hotel_info['lng'],
    ),
    'title' => $hotel_title,
    'info'  => $info
);

$icon = SNTH_IMAGES_URL . '/map-marker.png';

wp_enqueue_script('gmapLocations');

wp_localize_script('gmapLocations', 'jointsMapObj', array(
    'markers'   => $map_markers,
    'icon'      =>  $icon,
    'center'    => $map,
    'zoom'      =>  17,
));
?>

<div id="map-canvas"></div>