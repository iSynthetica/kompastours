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
    <!-- start navigation -->
    <nav class="navbar navbar-default bootsnav bg-black-color header-dark white-link navbar-top navbar-expand-lg">
        <div class="container nav-header-container">
            <!-- start logo -->
            <div class="col-auto pl-lg-0">
                <a href="index.html" title="Pofo" class="logo"><img src="<?php echo SNTH_IMAGES_URL ?>/samples/logo.png" data-rjs="images/logo@2x.png" class="logo-dark" alt="Pofo"><img src="<?php echo SNTH_IMAGES_URL ?>/samples/logo.png" data-rjs="images/logo-white@2x.png" alt="Pofo" class="logo-light default"></a>
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
            <div class="col-auto pr-lg-0">
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
                <div class="header-social-icon d-none d-md-inline-block">
                    <a href="https://www.facebook.com/" title="Facebook" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="https://twitter.com/" title="Twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://dribbble.com/" title="Dribbble" target="_blank"><i class="fab fa-dribbble"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>
<!-- end header -->
