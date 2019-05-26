<?php
/**
 * The Header Pofo Transparent
 *
 * @package WordPress
 * @subpackage Magiccompass
 * @version 0.0.10
 * @since 0.0.10
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!-- start header -->
<header id="masthead" class="site-header header-with-topbar" role="banner">
    <?php snth_show_template('header/topbar.php'); ?>
    <!-- start navigation -->
    <nav class="navbar navbar-default bootsnav navbar-top header-light background-transparent nav-box-width white-link navbar-expand-lg">
        <div class="container-fluid nav-header-container">
            <!-- start logo -->
            <div class="col-auto pl-0">
                <a href="/" title="Pofo" class="logo">
                    <img src="<?php echo SNTH_IMAGES_URL ?>/newlogo.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/newlogo.png" class="logo-dark">
                    <img src="<?php echo SNTH_IMAGES_URL ?>/logo-white.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/logo-white.png" class="logo-light default">
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
            <div class="col-auto pr-0">
                <div class="header-searchbar">
                    <a href="#search-header" class="header-search-form"><i class="fas fa-search search-button"></i></a>
                    <!-- search input-->
                    <form id="search-header" method="post" action="search-result.html" name="search-header" class="mfp-hide search-form-result">
                        <div class="search-form position-relative">
                            <button type="submit" class="fas fa-search close-search search-button"></button>
                            <input type="text" name="search" class="search-input" placeholder="Enter your keywords..." autocomplete="off">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>
<!-- end header -->
