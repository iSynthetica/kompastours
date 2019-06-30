<?php
/**
 * The Header Pofo Black
 *
 * @package WordPress
 * @subpackage Magiccompass
 * @version 0.0.10
 * @since 0.0.10
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!-- start header -->
<header id="masthead" class="site-header" role="banner">
    <?php // snth_show_template('header/topbar.php'); ?>
    <!-- start navigation -->
    <nav class="navbar navbar-default bootsnav bg-black-color header-dark white-link navbar-top navbar-expand-lg">
        <div class="container nav-header-container">
            <!-- start logo -->
            <div class="col-auto pl-lg-0">
                <a href="/" class="logo">
                    <img src="<?php echo SNTH_IMAGES_URL ?>/logo-new-color-hd.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/logo-new-color-hd.png" class="logo-dark default">
                    <img src="<?php echo SNTH_IMAGES_URL ?>/logo-new-white-hd.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/logo-new-white-hd.png" class="logo-light">
                </a>
            </div>
            <!-- end logo -->
            <div class="col accordion-menu pr-0 pr-md-3">
                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-collapse-toggle-1">
                    <span class="sr-only">toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-collapse collapse justify-content-end" id="navbar-collapse-toggle-1">
                    <?php snth_show_template('nav/pofo-main.php'); ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>
<!-- end header -->
