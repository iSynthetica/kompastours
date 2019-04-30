<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 17.09.18
 * Time: 19:37
 */

function ittour_api_init() {
    include_once ITTOUR_DIR . '/class.ittourApi.php';
}

function ittour_params($lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourParamsApi.php';

    return new ittourParamsApi($lang);
}

function ittour_search($lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourSearchApi.php';

    return new ittourSearchApi($lang);
}

function ittour_tour($key, $lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourTourApi.php';

    return new ittourTourApi($key, $lang);
}