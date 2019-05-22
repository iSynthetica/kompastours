<?php
/**
 * Footer Sidebars Container template
 *
 * @package Magiccompass/Parts/Sidebar
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="row">
    <div class="col-lg-3 col-md-6 mb-20 mb-lg-0">
        <?php dynamic_sidebar( 'footer1' ); ?>
    </div>

    <div class="col-lg-3 col-md-6 mb-20 mb-lg-0">
        <?php dynamic_sidebar( 'footer2' ); ?>
    </div>

    <div class="col-lg-3 col-md-6 mb-20 mb-md-0">
        <?php dynamic_sidebar( 'footer3' ); ?>
    </div>

    <div class="col-lg-3 col-md-6">
        <?php dynamic_sidebar( 'footer4' ); ?>
    </div>
</div>
