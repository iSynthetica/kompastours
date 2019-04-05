<!-- Footer
============================================= -->
<footer id="colophon" class="site-footer" role="contentinfo">
    <div id="footer-sidebar__container" class="container">
        <?php snth_show_template('sidebar/footer-sidebar-1.php'); ?>
    </div>

    <?php
    $social = get_field('social', 'options');

    if (!empty($social)) {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="social_footer">
                        <ul>
                            <?php
                            foreach ($social as $item) {
                                ?>
                                <li class="display-on-<?php echo $item['use_on'] ?>"><a href="<?php echo $item['link'] ?>" title="<?php echo $item['label'] ?>"><i class="fab fa-<?php echo $item['icon'] ?>"></i></a></li>
                                <?php
                            }
                            ?>
                        </ul>

                        <p>© MagicCompass 2008 - <?php echo date('Y'); ?></>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</footer><!-- #footer end -->