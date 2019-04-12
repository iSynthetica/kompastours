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
$map_markers = array();
$map_markers[] = array(
    'marker' => array(
        'lat' => $hotel_info['lat'],
        'lng' => $hotel_info['lng'],
    ),
    'title' => $hotel_info['address'],
    'info'  => ''
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