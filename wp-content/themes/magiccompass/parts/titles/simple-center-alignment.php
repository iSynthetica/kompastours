<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Titles
 * @version 0.0.10
 * @since 0.0.10
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!-- start page title section -->
<section class="bg-light-gray-color ptb-lg-120 ptb-md-60 ptb-30 top-space">
    <div class="container">
        <div class="row">
            <div class="col-12 page-title-medium text-center d-flex flex-column justify-content-center">
                <!-- start page title -->
                <h1 class="txt-black-color"><?php the_title(); ?></h1>
                <!-- end page title -->
                <!-- start sub title -->
                <span class="txt-black-color">We provide innovative solutions to expand your business</span>
                <!-- end sub title -->
            </div>
        </div>
    </div>
</section>
<!-- end page title section -->
