<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 15:55
 */

define ('ITTOUR_VERSION', '0.0.1');
define ('ITTOUR_LANG', 'ru');
define ('ITTOUR_DIR', get_template_directory() . '/includes/ittourAPI');
define ('ITTOUR_SESSION', 'wp_ittour_session_' . COOKIEHASH);

include_once SNTH_INCLUDES.'/ittour-session.php';
include_once SNTH_INCLUDES.'/ittour-core.php';
include_once SNTH_INCLUDES.'/ittour-api.php';
include_once SNTH_INCLUDES.'/ittour-destinations.php';
include_once SNTH_INCLUDES.'/ittour-ajax.php';
include_once SNTH_INCLUDES.'/ittour-helpers.php';
include_once SNTH_INCLUDES.'/ittour-template-functions.php';
include_once SNTH_INCLUDES.'/ittour-rest.php';