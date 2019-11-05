<?php
/**
 * @var $tours
 */

if ( ! defined( 'ABSPATH' ) ) exit;



foreach ($tours as $tour) {
    $template_args = array(
        'main_currency_label' => $main_currency_label,
        'main_currency' => $main_currency,
        'tour' => $tour
    );

    ittour_show_template('loop-hotel/excursion-tour-list-default.php', $template_args);
}