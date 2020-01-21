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
?>


<div id="search-result" class="search-result">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row common-height clearfix">
                <?php ittour_show_template('search/pagination.php', array('result' => $result, 'url' => $url, 'type' => 'excursion-search')); ?>
            </div>
        </div>
    </div>
</div>
