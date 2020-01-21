<?php
/**
 * Country Content Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.9
 * @since 0.0.8
 *
 * @var $country_id
 * @var $region_id
 */

global $ittour_global_form_args;

if ( ! defined( 'ABSPATH' ) ) exit;

$template_args = array(
    'type' => 1,
    'items_per_page' => 12,
);
?>

<section id="search-form__section" class="pt-10 pb-10 ptb-md-0 ">
    <div class="container">
        <?php ittour_show_template('form/section-search.php', $ittour_global_form_args); ?>
    </div>
</section>

<?php snth_show_template('breadcrumbs.php'); ?>

<?php ittour_show_template('general/tours-list-ajax.php', array_merge($ittour_global_form_args, $template_args)); ?>
