<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 22.05.19
 * Time: 20:26
 */

/**
 * @var $social
 */
?>

<footer id="colophon" class="footer-classic">
    <div class="footer-widget-area light ptb-20 ptb-md-40">
        <div class="container">
            <?php snth_show_template('sidebar/footer-sidebar-1.php'); ?>
        </div>
    </div>
    <div class="container">
        <div class="footer-bottom border-color-extra-light-gray border-top ptb-10 ptb-md-20">
            <div class="row">
                <!-- start copyright -->
                <div class="col-lg-8 col-md-7 text-small text-center text-md-left font-alt font-weight-900" style="line-height: 32px">
                    © MagicCompass 2008 - <?php echo date('Y'); ?>
                </div>
                <!-- end copyright -->

                <!-- start social media -->
                <div class="col-lg-4 col-md-5 text-center text-md-right mt-10 mt-md-0">
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
</footer>
