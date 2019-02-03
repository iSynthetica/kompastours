<!-- Header
		============================================= -->
<header id="masthead" class="site-header" role="banner">
    <div id="header-wrap">
        <?php snth_show_template( 'header/top-line.php' ); ?>

        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div id="logo">
                        <a href="index.html">
                            <img src="<?php echo SNTH_IMAGES_URL ?>/samples/logo.png" width="160"
                                                  height="34" alt="City tours" data-retina="true"
                                                  class="logo_normal">
                        </a>

                        <a href="index.html">
                            <img src="<?php echo SNTH_IMAGES_URL ?>/samples/logo_sticky.png"
                                                  width="160" height="34" alt="City tours" data-retina="true"
                                                  class="logo_sticky">
                        </a>
                    </div>
                </div>

                <div class="col-9">
                    <nav>
                        <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>

                        <div class="main-menu">
                            <div id="header_menu">
                                <img src="img/logo_sticky.png" width="160" height="34" alt="City tours" data-retina="true">
                            </div>

                            <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>

                            <?php snth_main_nav(); ?>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header><!-- #header end -->