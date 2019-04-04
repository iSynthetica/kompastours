<?php
/**
 * Footer Sidebars Container template
 *
 * @package Magiccompass/Parts/Sidebar
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="row">
    <div class="col-lg-4 col-md-4">
        <?php dynamic_sidebar( 'footer1' ); ?>
    </div>

    <div class="col-lg-2 col-md-3 ml-md-auto">
        <?php dynamic_sidebar( 'footer2' ); ?>
    </div>

    <div class="col-lg-3 col-md-4">
        <?php dynamic_sidebar( 'footer3' ); ?>
    </div>

    <div class="col-lg-2 ml-lg-auto">
        <?php dynamic_sidebar( 'footer4' ); ?>
    </div>
</div>
