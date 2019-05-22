<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 22.05.19
 * Time: 20:26
 */

$social = get_field('social', 'options');
?>

<footer id="colophon" class="footer-classic pb-20 pb-md-40">
    <div class="bg-gray-5-color ptb-20 ptb-md-40">
        <div class="container">
            <div class="row align-items-center">
                <!-- start slogan -->
                <div class="col-lg-4 col-md-5 text-center font-alt font-weight-900 mb-20 mb-md-0">
                    London based highly creative studio
                </div>
                <!-- end slogan -->
                <!-- start logo -->
                <div class="col-lg-4 col-md-2 text-center sm-margin-10px-bottom">
                    <a href="/">
                        <img class="footer-logo" src="<?php echo SNTH_IMAGES_URL ?>/newlogo.png" data-rjs="images/logo@2x.png" alt="">
                    </a>
                </div>
                <!-- end logo -->
                <!-- start social media -->
                <div class="col-lg-4 col-md-5 text-center mt-10 mt-md-0">
                    <span class="font-alt mr-20 font-weight-900"><?php echo __('On social networks', 'snthwp'); ?></span>
                    <div class="social-icon-style-8 display-inline-block vertical-align-middle">
                        <ul class="small-icon mb-0">
                            <?php
                            foreach ($social as $item) {
                                ?>
                                <li class="display-on-<?php echo $item['use_on'] ?>"><a class="icon type-bg size-xs bg-<?php echo $item['icon'] ?>-color mb-0" href="<?php echo $item['link'] ?>" title="<?php echo $item['label'] ?>"><i class="fab fa-<?php echo $item['icon'] ?>"></i></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- end social media -->
            </div>
        </div>
    </div>
    <div class="footer-widget-area light ptb-20 ptb-md-40">
        <div class="container">
            <?php snth_show_template('sidebar/footer-sidebar-1.php'); ?>
        </div>
    </div>
    <div class="container">
        <div class="footer-bottom border-color-extra-light-gray border-top pt-10 pt-md-20">
            <div class="row">
                <!-- start copyright -->
                <div class="col-lg-6 col-md-6 text-md-left text-small text-center">POFO - Portfolio Concept Theme</div>
                <div class="col-lg-6 col-md-6 text-md-right text-small text-center">&COPY; 2019 POFO is Proudly Powered by <a href="http://www.themezaa.com" target="_blank" title="ThemeZaa">ThemeZaa</a></div>
                <!-- end copyright -->
            </div>
        </div>
    </div>
</footer>
