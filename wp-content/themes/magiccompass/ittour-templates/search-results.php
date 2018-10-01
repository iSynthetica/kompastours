<?php

if (empty($_GET['country'])) {
    ittour_show_template('search/no-parameters.php');
} else {

    $args = $_GET;

    $country_id = $_GET['country'];

    unset($_GET['country']);

    $search = ittour_search('ru');
    $search_result = $search->get($country_id, $args);

    if ( !is_array( $search_result ) ) {
        return;
    }

    ittour_show_template('search/result.php', array('result' => $search_result));
}