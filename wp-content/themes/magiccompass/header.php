<?php
/**
 * The Header for our theme
 *
 * @package Hooka
 */

if ( ! defined( 'ABSPATH' ) ) exit;

snth_show_template('head.php'); ?>

<body <?php body_class('ct-body'); ?>>

<!--    <div id="preloader">-->
<!--        <div class="sk-spinner sk-spinner-wave">-->
<!--            <div class="sk-rect1"></div>-->
<!--            <div class="sk-rect2"></div>-->
<!--            <div class="sk-rect3"></div>-->
<!--            <div class="sk-rect4"></div>-->
<!--            <div class="sk-rect5"></div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="layer"></div>-->

    <?php snth_show_template('header/default.php'); ?>